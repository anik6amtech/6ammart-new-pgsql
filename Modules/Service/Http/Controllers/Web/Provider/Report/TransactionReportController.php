<?php

namespace Modules\Service\Http\Controllers\Web\Provider\Report;

use App\CentralLogics\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Zone;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Entities\TransactionModule\Transaction;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function pagination_limit;
use function view;
use function with_currency_symbol;

class TransactionReportController extends Controller
{
    protected Zone $zone;
    protected Provider $provider;
    protected Category $categories;
    protected Booking $booking;

    protected UserAccount $account;
    protected Service $service;
    protected User $user;
    protected Transaction $transaction;
    private BookingDetailsAmount $booking_details_amount;

    public function __construct(Zone $zone, Provider $provider, Category $categories, Service $service, Booking $booking, UserAccount $account, User $user, Transaction $transaction, BookingDetailsAmount $booking_details_amount)
    {
        $this->zone = $zone;
        $this->provider = $provider;
        $this->categories = $categories;
        $this->booking = $booking;

        $this->service = $service;
        $this->account = $account;
        $this->user = $user;
        $this->transaction = $transaction;
        $this->booking_details_amount = $booking_details_amount;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function getTransactionReport(Request $request): Renderable
    {
        Validator::make($request->all(), [
            'date_range' => 'in:all_time, this_week, last_week, this_month, last_month, last_15_days, this_year, last_year, last_6_month, this_year_1st_quarter, this_year_2nd_quarter, this_year_3rd_quarter, this_year_4th_quarter, custom_date',
            'from' => $request['date_range'] == 'custom_date' ? 'required' : '',
            'to' => $request['date_range'] == 'custom_date' ? 'required' : '',

            'transaction_type' => 'in:all,debit,credit'
        ]);

        //Dropdown data
        $zones = $this->zone->select('id', 'name')->get();

        //params
        $queryParams = ['transaction_type' => $request->input('transaction_type', 'all')];
        $queryParams += $request->only(['search', 'zone_ids', 'date_range']);
        if ($request['date_range'] === 'custom_date') {
            $queryParams['from'] = $request['from'];
            $queryParams['to'] = $request['to'];
        }

        $filteredTransactions = $this->transaction
            ->with(['booking', 'from_provider', 'to_provider'])
            ->search($request['search'], ['id'])
            ->filterDateRange($request['date_range'], $request['from'], $request['to'])
            ->when($request->has('transaction_type') && $request->transaction_type != 'all', function ($query) use($request) {
                if ($request->transaction_type == 'debit') {
                    $query->where('debit', '!=', 0);
                } elseif ($request->transaction_type == 'credit') {
                    $query->where('credit', '!=', 0);
                }
            })
            ->where(function ($query) {
                $query->where('to_user_id', Helpers::get_provider_id())->orWhere('from_user_id', Helpers::get_provider_id());
            })
            ->latest()
            ->paginate(pagination_limit())
            ->appends($queryParams);

        $account_info = getUserAccount(Helpers::get_provider_id(), PROVIDER);
        return view('service::provider.report.transaction', compact('zones', 'filteredTransactions', 'account_info', 'queryParams'));
    }


    /**
     * @param Request $request
     * @return StreamedResponse|string
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
     */
    public function downloadTransactionReport(Request $request): StreamedResponse|string
    {
        Validator::make($request->all(), [
            'date_range' => 'in:all_time, this_week, last_week, this_month, last_month, last_15_days, this_year, last_year, last_6_month, this_year_1st_quarter, this_year_2nd_quarter, this_year_3rd_quarter, this_year_4th_quarter, custom_date',
            'from' => $request['date_range'] == 'custom_date' ? 'required' : '',
            'to' => $request['date_range'] == 'custom_date' ? 'required' : '',

            'transaction_type' => 'in:all,debit,credit'
        ]);

        $filteredTransactions = $this->transaction
            ->with(['booking', 'from_provider', 'to_provider'])
            ->search($request['search'], ['id'])
            ->filterDateRange($request['date_range'], $request['from'], $request['to'])
            ->when($request->has('transaction_type') && $request->transaction_type != 'all', function ($query) use($request) {
                if ($request->transaction_type == 'debit') {
                    $query->where('debit', '!=', 0);
                } elseif ($request->transaction_type == 'credit') {
                    $query->where('credit', '!=', 0);
                }
            })
            ->where(function ($query) {
                $query->where('to_user_id', Helpers::get_provider_id())->orWhere('from_user_id', Helpers::get_provider_id());
            })
            ->latest()
            ->get();

        return (new FastExcel($filteredTransactions))->download(time().'-provider-report.xlsx', function ($transaction) {
            return [
                'Transaction ID' => $transaction->id,
                'Transaction Date' => date('d-M-Y h:ia',strtotime($transaction->created_at)),
                'Transaction To (full name)' => isset($transaction->to_user) ? $transaction->to_user->first_name.' '.$transaction->to_user->last_name : null,
                'Transaction To (phone)' => isset($transaction->to_user) ? $transaction->to_user->phone : null,
                'Transaction To (email)' => isset($transaction->to_user) ? $transaction->to_user->email : null,
                'Debit' => Helpers::format_currency($transaction->debit),
                'Credit' => Helpers::format_currency($transaction->credit),
                'Transactional Balance' => Helpers::format_currency($transaction->balance),
            ];
        });
    }

}
