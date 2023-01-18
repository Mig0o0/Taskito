@extends('layout.app')

@section('content')
    <table class="row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center">

        <tr>
            <th scope="col" class="py-3 px-6 text-left">{{ $task->title }}</th>
            <td scope="col" class="py-3 px-6 text-right">
                <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                    <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    {{ round((strtotime(now()) - strtotime($task->created_at)) / (60 * 60 * 24)) }} days ago
                  </span>
            </td>
        </tr>
        <tr>
            <th scope="col" class="py-3 px-6 text-left">Current Points</th>
            <td scope="col" class="py-3 px-6 text-right">{{ $task->points + (-1 * ( $task->hints->where('is_opened', true)->sum('subtracted_points') )) }}</td>
        </tr>
        <tr>
            <th scope="col" class="py-3 px-6 text-left">Assigned To</th>
            <td scope="col" class="py-3 px-6 text-right">{{ $task->user->name }}</td>
        </tr>
        <tr>
            <th scope="col" class="py-3 px-6 text-left">Progress Status</th>
            <td scope="col" class="py-3 px-6 text-right">
                @if($task->status == "in_progress")
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">In Progress</span>
                @elseif($task->status == "extended")
                    <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Extended</span>
                @else
                    <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Completed</span>
                @endif
            </td>
        </tr>
        <tr>
            <th scope="col" class="py-3 px-6 text-left">Confirm Status</th>
            <td scope="col" class="py-3 px-6 text-right">
                @if(!$task->is_confirmed)
                    <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Unconfirmed</span>
                @else
                    <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Confirmed</span>
                @endif
            </td>
        </tr>
      </table>
        <div id="task_hints">
            @if($task->hints->count() > 0)
                @foreach ($task->hints as $hint)
                    <div class="main flex flex-col flex-grow p-5 bg-white m-4 rounded hint_content" id="hint_{{$hint->id}}">
                        <table class="row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-left">
                                    {{ $hint->content }}
                                </th>
                                <td scope="col" class="py-3 px-6 text-right">
                                    @if(!$hint->is_opened)
                                        <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Tied</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Opened</span>
                                    @endif

                                    <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">- {{ $hint->subtracted_points }} Point</span>

                                    <button onclick="deleteHint({{$hint->id}})"><i class="fa-regular fa-trash-can" style="font-size: 18px;"></i></button>

                                </td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            @else
                <div class="main flex flex-col flex-grow p-5 bg-white m-4 rounded text-center" id="no_hints">
                    No Hints For This Task
                </div>
            @endif
        </div>
        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded p-5 m-4" id="add_hint_button">
            Add Hint
        </button>
@endsection
@push('script')
    <script>
        function addHint(taskId){
            $.post(
                "{{route('web.task.hints.create')}}",
                {
                    content: $('input[name="content"]').val(),
                    subtracted_points: $('input[name="subtracted_points"]').val(),
                    task_id: taskId,
                    _token: '{{ csrf_token() }}'
                },
                function (data, textStatus, jqXHR) {
                   if(data.success){
                        var hint = data.hint;
                        $("#hintAdder").remove();
                        addHintContent(hint.content, hint.id, hint.subtracted_points, hint.is_opened);
                   }
                },
            );
        }

        function deleteHint(hintId){
            $.post(
                "/tasks/hints/"+hintId+"/delete",
                {
                    _token: '{{ csrf_token() }}'
                },
                function (data, textStatus, jqXHR) {
                    if(data.is_deleted){
                        $("#hint_"+hintId).remove();
                        if($(".hint_content").length == 0){
                            $("#task_hints").append(
                                $(
                                    "<div/>",
                                    {
                                        "class": "main flex flex-col flex-grow p-5 bg-white m-4 rounded text-center",
                                        "id": "no_hints"
                                    }
                                ).text("No Hints For This Task")
                            );
                        }
                    }
                },
            );
        }

        function addHintContent(hintTitle, hintId, hintPoints, isOpened){
            $("#task_hints").append(
                $(
                    '<div/>',
                    {
                        "class": "main flex flex-col flex-grow p-5 bg-white m-4 rounded hint_content",
                        "id": "hint_"+hintId
                    }
                ).append(
                    $(
                        '<table/>',
                        {
                            "class": "row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center"
                        }
                    ).append(
                        $(
                            '<tr/>'
                        ).append(
                            $(
                                "<th/>",
                                {
                                    "class": "py-3 px-6 text-left",
                                    "scope": "col"
                                }
                            ).text(hintTitle)
                        ).append(
                            $(
                                "<td/>",
                                {
                                    "class": "py-3 px-6 text-right",
                                    "scope": "col"
                                }
                            ).append(
                                !isOpened ?
                                $(
                                    "<span/>",
                                    {
                                        "class": "bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                    }
                                ).text("Tied")
                                :
                                $(
                                    "<span/>",
                                    {
                                        "class": "bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                                    }
                                ).text("Opened")
                            ).append(
                                $(
                                    "<span/>",
                                    {
                                        "class":"bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                    }
                                ).text("-"+hintPoints+" Points")
                            ).append(
                                $(
                                    "<button/>",
                                    {
                                        "onclick": "deleteHint("+hintId+")"
                                    }
                                ).append(
                                    $(
                                        "<i/>",
                                        {
                                            "class":"fa-regular fa-trash-can",
                                            "style":"font-size: 18px;"
                                        }
                                    )
                                )
                            )
                        )
                    )
                )
            );
        }
        $('#add_hint_button').click(function(){
            $("#no_hints").remove();
            var hintsDiv = $("#task_hints");
            var card = hintsDiv.append(
                $(
                    '<div/>',
                    {
                        'class': 'main flex flex-col flex-grow p-5 bg-white m-4 rounded text-center',
                        'id': "hintAdder"
                    }
                ).append(
                    $(
                        '<div/>',
                        {
                            'class': 'grid grid-cols-11',
                        }
                    ).append(
                        $(
                            "<input/>",
                            {
                                "placeholder": "Hint Title",
                                "class": "col-span-5 border-none bg-gray-100 p-4 m-2 rounded-lg focus:outline-0",
                                "name": "content"
                            }
                        )
                    ).append(
                        $(
                            "<input/>",
                            {
                                "placeholder": "Subtracted Points",
                                "class": "col-span-5 border-none bg-gray-100 p-4 m-2 rounded-lg focus:outline-0",
                                "name": "subtracted_points"
                            }
                        )
                    ).append(
                        $(
                            "<button/>",
                            {
                                "class": "bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded p-5 m-4 col-span-1",
                                "onclick": "addHint({{ $task->id }})"
                            }
                        ).text("Add")
                    )
                )
            );
        });
    </script>
@endpush
