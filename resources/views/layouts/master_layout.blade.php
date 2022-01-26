@include('includes.header')
@include('includes.flash-message')
@yield('styles')
<div id="app">
    <main class="py-2">
        @yield('content')
    </main>
</div>
@include('includes.footer')
