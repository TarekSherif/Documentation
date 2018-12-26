<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"> @lang('messages.Mname')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> @lang('messages.Mname')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    @include('layouts.inc.menu')

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/')}}/Template/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                {{Auth::user()->email}}
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" class="form-control"  placeholder="@lang(" messages.Search ")...">
                        <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form>
                <!-- /.search form -->

http://127.0.0.1:8000/Order/create

            </li> --}}
      
            <li class="{{ $view_name == "Order.create" ? "active" : "" }} ">
                <a href="{{url('/')}}/Order/create" >
                        <i class="fa fa-plus sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">
                                @lang('messages.Order')
                        </span>
                    </a>


            </li>
           
            <li class="{{ $view_name == "OnlinePayment.Create" ? "active" : "" }} ">
                <a href="{{url('/')}}/OnlinePayment/create" >
                        <i class="fa fa-credit-card sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">
                                @lang('messages.OnlinePayment')
                        </span>
                    </a>
            </li>
            <li class="{{ $view_name == "CompanyReport" ? "active" : "" }} ">
                <a href="{{url('/')}}/CompanyReport" >
                        <i class=" fa fa-print sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">
                                @lang('messages.CompanyReport')
                        </span>
                    </a>
            </li>
            <li class="treeview ">
                <a href="#">
            <i class="fa fa-cog"></i>
            <span> @lang('messages.Settings')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
       
          
                <ul class="treeview-menu">

                    @foreach ($RoleMenu as $item)
                       <li class="{{ $view_name == $item["ViewName"]  ? "active" : "" }}">
                            <a href="{{url('/')}}/{{$item["ViewName"]}}" >
                                    <i class="{{$item["ViewIcon"]}}"  aria-hidden="true"></i>
                                    @lang('messages.'.$item["ViewName"])
                            </a>
                        </li>
                    @endforeach
                


                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>