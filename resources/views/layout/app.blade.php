@include('includes.header')

<div class="flex flex-row">
    @guest('web')
        <br>
    @else
        @include('includes.sidebar')
    @endguest

    <div class="main flex flex-col flex-grow p-5 bg-gray-50 m-4 rounded h-fit">
        @yield('content')
    </div>
</div>

@include('includes.footer')
