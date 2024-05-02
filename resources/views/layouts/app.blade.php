<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    @include('layouts.links')
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.header')

        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- Main Footer -->
        @include('layouts.footer')

    </div>

    @include('layouts.script')
</body>

</html>