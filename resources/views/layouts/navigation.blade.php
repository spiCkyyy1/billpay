<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
{{--            <i class="fas fa-laugh-wink"></i>--}}
        </div>
        <div class="sidebar-brand-text mx-3">Pay Bill</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li @if(Route::currentRouteName() == 'home') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    @can('acl-nav-view')
    <li @if(Route::currentRouteName() == 'users') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('users')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>


    <li @if(Route::currentRouteName() == 'admin.permissions') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('admin.permissions')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Permissions</span>
        </a>
    </li>

    <li @if(Route::currentRouteName() == 'admin.roles') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('admin.roles')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Roles</span>
        </a>
    </li>
    @endcan


    <!-- Nav Item - Utilities Collapse Menu -->
    @can('categories-nav-view')
    <li @if(Route::currentRouteName() == 'categories') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('categories')}}" >
            <i class="fas fa-fw fa-wrench"></i>
            <span>Categories</span>
        </a>
    </li>
    @endcan

    <!-- Nav Item - Pages Collapse Menu -->
    @can('companies-nav-view')
    <li class="nav-item" @if(Route::currentRouteName() == 'admin.companies') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('admin.companies')}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Companies</span>
        </a>
    </li>
    @endcan

    <!-- Nav Item - Charts -->
    @can('email-templates-nav-view')
    <li class="nav-item" @if(Route::currentRouteName() == 'email.template') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('email.template')}}">
            <i class="fas fa-fw fa-mail-bulk"></i>
            <span>Email Templates</span>
        </a>
    </li>
    @endcan

<!-- Nav Item - Charts -->
    @can('transactions-nav-view')
    <li class="nav-item" @if(Route::currentRouteName() == 'admin.transactions') class="nav-item active" @else class="nav-item" @endif>
        <a class="nav-link" href="{{route('admin.transactions')}}">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Transactions</span>
        </a>
    </li>
    @endcan

</ul>
<!-- End of Sidebar -->
