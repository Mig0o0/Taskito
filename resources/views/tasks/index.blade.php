@extends('layout.app')

@section('content')
@if(count($tasks) > 0)
<table class="row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">Task Title</th>
            <th scope="col" class="py-3 px-6">User</th>
            <th scope="col" class="py-3 px-6">Points</th>
            <th scope="col" class="py-3 px-6">Progress Status</th>
            <th scope="col" class="py-3 px-6">Confirm Status</th>
            <th scope="col" class="py-3 px-6">Task Announced</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('web.tasks.show', $task->id) }}">{{ $task->title }}</a>
                </th>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->points }}</td>
                <td>
                    @if($task->status == "in_progress")
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">In Progress</span>
                    @elseif($task->status == "extended")
                        <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Extended</span>
                    @else
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Completed</span>
                    @endif
                </td>
                <td id="task_{{ $task->id }}_confirmation_status">
                    @if(!$task->is_confirmed)
                        <span id="task_{{ $task->id }}_non" class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Unconfirmed</span>
                    @else
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Confirmed</span>
                    @endif
                </td>
                <td>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                        <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                        {{ round((strtotime(now()) - strtotime($task->created_at)) / (60 * 60 * 24)) }} days ago
                        </span>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @else
        <div class="main flex flex-col flex-grow p-5 bg-white m-4 rounded text-center" id="no_hints">
            No Open Tasks
        </div>
    @endif
@endsection
