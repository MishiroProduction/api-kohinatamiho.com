<div class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('top_page') }}" class="brand-link">
        <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">管理画面</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'AdminUser' ? 'active' : '' }}" href="{{ route('admin_users.index') }}">
                        <i class="oi oi-person"></i>
                        <p>Admin Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'News' ? 'active' : '' }}" href="{{ route('news.index') }}">
                        <i class="oi oi-share-boxed"></i>
                        <p>News</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
