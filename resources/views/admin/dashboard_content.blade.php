<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- ... -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-header border-0">
                            <!-- ... -->
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('admin/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                            {{ $product->name }}
                                        </td>
                                        <td>${{ $product->price }} EGP</td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ... -->
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="    margin-top: 300px;
">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Daily Statistics</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{ $dailyRevenue }} EGP</span>
                            <span>Total Revenue Today</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
