<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.navbar')

        <!-- Main Sidebar Container -->
        @include('admin.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <h1 style="text-align: center;font-weight: bold;margin-bottom: 10px;">Orders</h1>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="{{ url('orders') }}">
                                @csrf
                                @if (count($order) > 0)
                                    @foreach ($order as $orders)
                                        <tr>
                                            <td>{{ $orders->name }}</td>
                                            <td>{{ $orders->phone }}</td>
                                            <td>{{ $orders->address }}</td>
                                            <td>{{ $orders->product_title }}</td>
                                            <td>{{ $orders->price }} EGP</td>
                                            <td style="color: {{ $orders->status == 'Delivered' ? 'green' : 'red' }}">
                                                {{ $orders->status }}
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{ url('updatestatus', $orders->id) }}">Delivered</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('admin.footer')
    </div>
    <!-- ./wrapper -->
    @include('admin.js')
</body>
</html>
