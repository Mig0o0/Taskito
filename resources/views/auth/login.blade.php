@extends('layout.app')

@section('content')
    <div class="main flex flex-col flex-grow p-5 bg-white m-4 rounded text-center" id="no_hints">
        <form action="{{ route('web.auth.login') }}" method="post">
            @csrf
            <table class="row-span-1 text-sm text-gray-500 rounded dark:text-gray-400 text-center">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email" name="email" autocomplete="false">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password" name="password" autocomplete="false">
                </div>

                <button class="bg-blue-500 float-right hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Login
                </button>
            </table>
        </form>
    </div>
@endsection
