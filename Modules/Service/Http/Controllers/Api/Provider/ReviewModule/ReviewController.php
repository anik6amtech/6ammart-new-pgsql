<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ReviewModule;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\Review\Review;
use Modules\Service\Entities\Review\ReviewReply;
use App\Models\Module;

class ReviewController extends Controller
{
    private $review;
    private $reviewReply;

    public function __construct(Review $review, ReviewReply $reviewReply)
    {
        $this->review = $review;
        $this->reviewReply = $reviewReply;
    }

    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:active,inactive,all'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $reviews = $this->review->where('provider_id', $request->user('provider')->id)
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })->latest()->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        $ratingGroupCount = DB::table('service_reviews')->where('provider_id', $request->user('provider')->id)
            ->select('review_rating', DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $ratingInfo = [
            'rating_count' => $request->user('provider')['rating_count'],
            'average_rating' => $request->user('provider')['avg_rating'],
            'rating_group_count' => $ratingGroupCount,
        ];

        if ($reviews->count() > 0) {
            return response()->json(response_formatter(DEFAULT_200, ['reviews' => $reviews, 'rating' => $ratingInfo]), 200);
        }

        return response()->json(response_formatter(DEFAULT_404), 200);
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'string' => 'required',
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:all,active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $keys = explode(' ', base64_decode($request['string']));
        $reviews = $this->review->where('provider_id', $request->user('provider')->id)
            ->where(function ($query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhere('booking_id', 'LIKE', '%' . $key . '%')
                        ->orWhere('provider_id', 'LIKE', '%' . $key . '%');
                }
            })->when($request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        if ($reviews->count() > 0) {
            return response()->json(response_formatter(DEFAULT_200, $reviews), 200);
        }
        return response()->json(response_formatter(DEFAULT_204, $reviews), 200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reviewReply(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'review_id' => 'required',
            'reply_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $providerUserId = $request->user('provider')->id;
        $review_id = $request->review_id;


        $reviewReply = $this->reviewReply
            ->where('review_id', 'like', "{$review_id}%")
            ->orderBy('id', 'desc')
            ->first();

        if (!$reviewReply) {
            $reviewReply = $this->reviewReply;
        }

        $reviewReply->module_id = $this->currentModule()?->id;
        $reviewReply->review_id = $review_id;
        $reviewReply->user_id = $providerUserId;
        $reviewReply->reply = $request->reply_content;
        $reviewReply->save();

        return response()->json(response_formatter(DEFAULT_200), 200);

    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param string $service_id
     * @return JsonResponse
     */
    public function serviceReview(Request $request, string $service_id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:active,inactive,all'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }
        $reviews = $this->review->with(['booking.detail','provider', 'customer','reviewReply','service'])
            ->where('service_id', $service_id)
            ->where('provider_id', $request->user('provider')->id)
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        $ratingGroupCount = DB::table('service_reviews')->where('service_id', $service_id)
            ->where('is_active', 1)
            ->select('review_rating', DB::raw('count(review_comment) as total_comment'), DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $activeReviews = DB::table('service_reviews')->where('service_id', $service_id)
            ->where('is_active', 1)
            ->select('review_rating', DB::raw('count(*) as total'))
            ->groupBy('review_rating')
            ->get();

        $totalRating = 0;
        $ratingCount = 0;
        $reviewCount = 0;

        foreach ($ratingGroupCount as $count) {
            $totalRating += round($count->review_rating * $count->total, 2);
            $ratingCount += $count->total;
            $reviewCount += $count->total_comment;
        }

        $totalActiveRating = 0;
        $activeRatingCount = 0;

        foreach ($activeReviews as $activeReview) {
            $totalActiveRating += round($activeReview->review_rating * $activeReview->total, 2);
            $activeRatingCount += $activeReview->total;
        }

        $ratingInfo = [
            'rating_count' => $ratingCount,
            'review_count' => $reviewCount,
            'average_rating' => $activeRatingCount > 0 ? round($totalActiveRating / $activeRatingCount, 2) : 0,
            'rating_group_count' => $ratingGroupCount,
        ];

        return response()->json(response_formatter(DEFAULT_200, ['reviews' => $reviews, 'rating' => $ratingInfo]), 200);

    }

}
