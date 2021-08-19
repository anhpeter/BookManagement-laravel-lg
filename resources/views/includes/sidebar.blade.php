@php
$controller = $controller ?? '';
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @php
        $manageUserClass = in_array($controller, ['user', 'group', 'profile']) ? 'show' : '';
        $manageProductClass = in_array($controller, ['category', 'book', 'order']) ? 'show' : '';
    @endphp
    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::user()->hasRole(['admin']))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Manage user</span>
            </a>
            <div id="collapseTwo" class="collapse {{ $manageUserClass }}" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ ViewHelper::getMenuItemClass($controller, 'group') }}"
                        href="/admin/groups">Group</a>
                    <a class="collapse-item {{ ViewHelper::getMenuItemClass($controller, 'user') }}"
                        href="{{ route('users.index') }}">User</a>
                </div>
            </div>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduct"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Manage product</span>
        </a>
        <div id="collapseproduct" class="collapse {{ $manageProductClass }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ ViewHelper::getMenuItemClass($controller, 'order') }}"
                    href="/admin/orders">Order</a>
                <a class="collapse-item {{ ViewHelper::getMenuItemClass($controller, 'category') }}"
                    href="/admin/categories">Category</a>
                <a class="collapse-item {{ ViewHelper::getMenuItemClass($controller, 'book') }}"
                    href="/admin/books">Book</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
