<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hint;
use App\Models\ScoreHistory;
use App\Models\Task;
use Illuminate\Http\Request;

class HintController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hint  $hint
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Hint $hint)
    {
        $log_score =  ScoreHistory::create([
            "user_id" => auth()->user()->id,
            "task_id" => $hint->task_id,
            "value" => -1 * $hint->subtracted_points,
            "reason" => "hint"
        ]);



        return [
            "is_opened" => $log_score != null && $hint->update(["is_opened" => true])
        ];
    }
}
