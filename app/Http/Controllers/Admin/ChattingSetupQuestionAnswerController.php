<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;

class ChattingSetupQuestionAnswerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        QuestionAnswer::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => 1,
        ]);
        Toastr::success(translate('Q & A stored successfully'));
        return redirect()->back();
    }

    public function update($id, Request $request): RedirectResponse
    {
        $questionAnswer = QuestionAnswer::find($id);
        if (!$questionAnswer) {
            Toastr::error(translate('Q & A not found'));
            return redirect()->back();
        }
        $questionAnswer->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        Toastr::success(translate('Q & A updated successfully'));
        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $questionAnswer = QuestionAnswer::find($id);
        if (!$questionAnswer) {
            Toastr::error(translate('Q & A not found'));
            return redirect()->back();
        }
        $questionAnswer->delete();
        Toastr::success(translate('Q & A deleted successfully'));
        return redirect()->back();
    }


    public function status(Request $request): RedirectResponse
    {
        QuestionAnswer::where('id', $request->id)->update([
            'is_active' => $request->status ?? 0
        ]);
        Toastr::success(translate('messages.status_updated'));
        return back();
    }
}
