<?php

namespace App\Traits;

use App\Models\MessageTemplate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait FilterDataTrait
{

    public function filterCommonData(Request $request, $viewName)
    {
        $query = User::with('wallet', 'kyc');

        if ($request->user_id != null)
            $query->where('id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $users = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        return  view($viewName, compact('users', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user'));
    }
}
