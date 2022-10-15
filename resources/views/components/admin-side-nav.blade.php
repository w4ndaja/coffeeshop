<div>
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if($user->role == 'Admin')
                <a href="{{route('admin.dashboard')}}" class="sb-sidenav-menu-heading">Dashboard</a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                    Kasir
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Admin
                </a>
                @endif
                <div class="sb-sidenav-menu-heading">Order</div>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                    Waiting Payment
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
                    Queue
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-x-mark"></i></div>
                    Cancel Order
                </a>
                <a class="nav-link {{Route::is('admin.users.index') && request('role') == 'User' ? 'active' : ''}}" href="{{route('admin.users.index', ['role' => 'User'])}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Customer
                </a>
                <div class="sb-sidenav-menu-heading">Master</div>
                <a class="nav-link {{Route::is('admin.users.index') && request('role') != 'User' ? '' : 'collapsed'}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{Route::is('admin.users.index') && request('role') != 'User' ? 'show' : ''}}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{Route::is('admin.users.index') && request('role') == 'Kasir' ? 'active' : ''}}" href="{{route('admin.users.index', ['role' => 'Kasir'])}}">Kasir</a>
                        <a class="nav-link {{Route::is('admin.users.index') && request('role') == 'Admin' ? 'active' : ''}}" href="{{route('admin.users.index', ['role' => 'Admin'])}}">Admin</a>
                    </nav>
                </div>
                <a class="nav-link {{Route::is('admin.menu-categories.index') || Route::is('admin.menus.index') ? '' : 'collapsed'}}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Menu
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{Route::is('admin.menu-categories.index') || Route::is('admin.menus.index') ? 'show' : ''}}" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link {{Route::is('admin.menu-categories.index') ? 'active' : ''}}" href="{{route('admin.menu-categories.index')}}"> Menu Categories </a>
                        <a class="nav-link {{Route::is('admin.menus.index') ? 'active' : ''}}" href="{{route('admin.menus.index')}}"> Menus </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{$user->name}}
        </div>
    </nav>

</div>
