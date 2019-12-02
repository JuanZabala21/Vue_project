<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<style>
.col-md-8{
    -webkit-box-flex: 0;
            flex: 0 0 66.66666667%;
    max-width: 66.66666667%;
}
</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="active treeview menu-open">
          <a href="./home">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         
            <li><a href="./profile"><i class="fa fa-circle-o"></i>{{ Auth::user()->name }}</a></li>
            
             <li>  <a class="nav-link" href="{{route('logout')}}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="nav-icon fa fa-power-off red"></i>
                    <p>
                        {{__('Logout')}}
                    </p>
                 </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
            </form>
          </li>
         
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
