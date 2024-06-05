<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="assets/limitless_logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light" style="font-size: 17px; font-weight: bold !important; color: #eeee22;">Limitless Shopping Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/admin.jpg') }}" class="img-circle elevation-2" alt="admin Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ url('products') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Add Products</p>
                    </a>
                </li>

                    <li class="nav-item">
                    <a href="{{ url('products_table') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>View Products Table</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>View Orders</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
