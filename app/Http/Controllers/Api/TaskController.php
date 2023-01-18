<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskConfirmationEvent;
use App\Http\Controllers\Controller;
use App\Models\ExtendRequest;
use App\Models\PullRequest;
use App\Models\Task;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->where('status', '!=', 'completed');
        $has_previous_tasks = $tasks->count() > 0;
        return [
            "tasks" => $tasks->with('hints')->get(),
            "is_there_old_tasks" => $has_previous_tasks
        ];
    }

    public function show(Task $task)
    {
        if($task->user->id != auth()->user()->id){
            return null;
        }
        return [
            "task" => $task,
        ];
    }

    public function complete(Request $request, Task $task): array
    {
        if($task->user->id != auth()->user()->id){
            return ["is_completed" => false];
        }

        try{
            $guzzle = new Client();
            $response = $guzzle->get(env('PROJECT_REPO') . "/issues/" . $request->code);
        }catch(ClientException $e){
            return [
                "is_completed" => false,
                "code" => "Code Is Wrong Yacta"
            ];
        }

        $pull_request = PullRequest::create([
            "task_id" => $task->id,
            "code" => $request->code,
        ]);

        return [
            "is_completed" => $task->complete() == 1,
            "is_there_opened_tasks" => auth()->user()->tasks->count() > 0
        ];
    }

    public function confirm(Task $task){
        if($task->user->id != auth()->user()->id){
            return ["is_confirmed" => false];
        }

        event(new TaskConfirmationEvent($task->id));

        return [
            "is_confirmed" => $task->confirm(),
        ];
    }


}
