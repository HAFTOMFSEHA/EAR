@extends('admin.layouts.master')


@section('container')
<div class="wrapper" style="overflow:hidden">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header" style="padding-bottom:0px;">
            <div class="brand-logo text-center" style="margin:0px;">
                <img alt="logo-brand" src="{{ asset('images/radio_icon.png') }}" style="width:80px;border-radius: 15px;">
            </div>
            <h3 style="text-align:center;">Admin Panel</h3>
        </div>
        <hr>
        @include('admin.navbar.header')
    </nav>

    <!-- Page Content  -->
    <div id="content">
        <!-- side nav -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="fa fa-bars"></i>
                </button>

                <div>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="fa fa-user pr-2"></i>Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--  main body -->
        <div class="panel panel-@yield('panel-color', 'primary')">
            @include('admin.common.sessionFlash')
            @include('admin.common.errors')
            <div class="panel-heading"><strong>@yield('header')</strong> <span style="color:gray;"> @yield('seconday-header') </span> </div>

            @yield('content')
        </div>
    </div>
</div>
@stop