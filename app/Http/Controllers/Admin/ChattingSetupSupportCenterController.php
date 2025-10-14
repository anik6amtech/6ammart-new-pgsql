<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use App\Models\SupportSavedReply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;

class ChattingSetupSupportCenterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        SupportSavedReply::create([
            'topic' => $request->topic,
            'answer' => $request->answer,
            'is_active' => 1,
        ]);
        Toastr::success(translate('Support saved reply stored successfully'));
        return redirect()->back();
    }

    public function update($id, Request $request): RedirectResponse
    {
        $supportSavedReply = SupportSavedReply::find($id);
        if (!$supportSavedReply) {
            Toastr::error(translate('Support saved reply not found'));
            return redirect()->back();
        }
        $supportSavedReply->update([
            'topic' => $request->topic,
            'answer' => $request->answer,
        ]);
        Toastr::success(translate('Support saved reply updated successfully'));
        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $supportSavedReply = SupportSavedReply::find($id);
        if (!$supportSavedReply) {
            Toastr::error(translate('Support saved reply not found'));
            return redirect()->back();
        }
        $supportSavedReply->delete();
        Toastr::success(translate('Support saved reply deleted successfully'));
        return redirect()->back();
    }


    public function status(Request $request): RedirectResponse
    {
        SupportSavedReply::where('id', $request->id)->update([
            'is_active' => $request->status ?? 0
        ]);
        Toastr::success(translate('messages.status_updated'));
        return back();
    }
}
