@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}"
                         class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <!-- ================================================ -->
                <!-- ==== Recommended place for admin menu items ==== -->
                <!-- ================================================ -->
{{--                <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>--}}

                <li class="header">Каталог</li>
                <li><a href="{{ url('admin/category') }}"><i class="fa fa-bookmark"></i> <span>Категории</span></a></li>
                <li><a href="{{ url('admin/brand') }}"><i class="fa fa-sun-o"></i> <span>Бренды</span></a></li>
                <li><a href="{{ url('admin/param') }}"><i class="fa fa-hand-spock-o"></i> <span>Параметры</span></a></li>
                <li><a href="{{ url('admin/value_param') }}"><i class="fa fa-hand-pointer-o"></i> <span>Значения параметров</span></a></li>
                <li><a href="{{ url('admin/product') }}"><i class="fa fa-cubes"></i> <span>Товары</span></a></li>

                <li class="header">Формы</li>
                <li><a href="{{ url('admin/sellform') }}"><i class="fa fa-shopping-cart"></i> <span>Формы заказа</span></a></li>
                <li><a href="{{ url('admin/contactform') }}"><i class="fa fa-phone"></i> <span>Формы обратного звонока</span></a></li>

                <li class="header">Прочее</li>
                <li><a href="{{ url('admin/chunk') }}"><i class="fa fa-font"></i> <span>Чанки</span></a></li>
{{--                <li><a href="{{ url('admin/user') }}"><i class="fa fa-group"></i> <span>Пользователи</span></a></li>--}}
                {{--<li class="treeview">--}}
                    {{--<a href=""><i class="fa fa-group"></i><span>Пользователи</span><i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>--}}
                        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>--}}
                        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cog"></i> <span>Настройки</span></a></li>
                @if (env('APP_DEBUG'))
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language') }}"><i class="fa fa-flag-o"></i> <span>Языки</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language/texts') }}"><i class="fa fa-language"></i> <span>Языковые файлы</span></a></li>
                @endif

                <li class="header">Сервер</li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-file-text-o"></i> <span>Логи</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-folder-open-o"></i> <span>Проводник</span></a></li>
            </ul>
        </section>
    </aside>
@endif
