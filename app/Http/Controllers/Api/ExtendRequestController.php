<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\ExtendLogRequest;
use App\Models\ExtendRequest;
use App\Models\ScoreHistory;
use App\Models\Task;
use App\Models\User;

class ExtendRequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtendLogRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $task = Task::find($request->task_id);

        if($user->extend_request($request->task_id)->count() >= 3){
            return [
                "isExtended" => false,
                "message_code" => 3
            ];
        }
        $extendRequest  = ExtendRequest::create($request->validated());
        $isTaskUpdated = $task->update([
            "status" => "extended",
            "last_date" => date("Y-m-d", strtotime($task->last_date)+( 24*60*60 ))
        ]);

        $log_score =  ScoreHistory::create([
            "user" => auth()->user()->id,
            "task" => $task->id,
            "value" => -1 * 20,
            "reason" => "time_extension"
        ]);

        return [
            "isExtended" => $extendRequest && $isTaskUpdated
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExtendRequest  $extendRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtendRequest $extendRequest)
    {
        return [
            "isDeleted" => $extendRequest->delete()
        ];
    }
}
