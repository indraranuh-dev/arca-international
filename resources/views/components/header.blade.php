<nav class="navbar">
    <a href="javascript:void(0);" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="profileDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{auth()->user() ? auth()->user()->name : '-'}}k&rounded=true&format=svg"
                        alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="https://ui-avatars.com/api/?name={{auth()->user() ? auth()->user()->name : '-'}}k&rounded=true&format=svg"
                                alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{auth()->user() ? auth()->user()->name : '-'}}</p>
                            <p class="email text-muted mb-3">{{auth()->user() ? auth()->user()->email : '-'}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{route('adm.contact.index')}}" class="nav-link">
                                    <i data-feather="book"></i>
                                    <span>Kontak</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>