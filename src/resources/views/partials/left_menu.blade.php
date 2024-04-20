
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Events</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Все события
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{ $events_all->count() }}</span>
                        </p>
                    </a>
                    @if ($events_all->count() > 0)
                        <ul class="nav nav-treeview">
                        @foreach ($events_all as $event)
                            <li class="nav-item">
                                <a href="{{ route('admin.events.show', $event) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ Str::limit($event->title, 45, '') }}</p>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Мои события
                            <i class="right fas fa-angle-left"></i>
                            <span class="badge badge-info right">{{ $events_creator->count() }}</span>
                        </p>
                    </a>
                    @if ($events_creator->count() > 0)
                        <ul class="nav nav-treeview">
                        @foreach ($events_creator as $event)
                            <li class="nav-item">
                                <a href="{{ route('admin.events.show', $event) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $event->title }}</p>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
</aside>