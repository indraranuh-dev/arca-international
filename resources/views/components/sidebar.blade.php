<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('main.index')}}" class="sidebar-brand">
            <img src="{{asset('images/arca_logo.png')}}" height="30" alt="Logo">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class('main.index') }}">
                <a href="{{ route('main.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">User Management</li>

            <li class="nav-item {{ active_class('main.user.*') }}">
                <a href="{{route('main.user.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User</span>
                </a>
            </li>

            <li class="nav-item {{ active_class('main.role.*') }}">
                <a href="{{route('main.role.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Role</span>
                </a>
            </li>

            <li class="nav-item nav-category">Konten</li>

            <li class="nav-item {{ active_class('main.item.*') }}">
                <a href="{{route('main.item.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="codepen"></i>
                    <span class="link-title">Barang</span>
                </a>
            </li>

            <li class="nav-item {{ active_class('main.invoice.*') }}">
                <a href="{{route('main.invoice.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Invoice</span>
                </a>
            </li>

        </ul>
    </div>
</nav>