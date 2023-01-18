@extends('layout.app')

@section('content')
    <form action="{{ route('web.tasks.store') }}" method="post">
        @csrf
        <table class="row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Task Title" name="title">
            </div>

            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="mb-4 w-full md:w-1/2 px-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Points
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="points" type="number" max="250" min="100" value="100" placeholder="Task Points" name="points">
                </div>
                <div class="mb-4 w-full md:w-1/2 px-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Member
                    </label>
                    <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="user_id">
                            <option class="text-gray-400" value="" disabled selected>Choose a Member</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Deadline
                </label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker type="text" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" name="last_date">
                  </div>
            </div>
            <button class="bg-blue-500 float-right hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Add
            </button>
        </table>
    </form>
@endsection
