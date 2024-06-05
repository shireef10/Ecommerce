<!DOCTYPE html>
<html lang="en">
    @include('admin.css')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('admin.navbar')

            <!-- Main Sidebar Container -->
            @include('admin.sidebar')

            <div class="content-wrapper">
                <div class="content-header">
                    <h1>Products</h1>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Title</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->title }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td><img src="{{ asset('productImage/' . $product->image) }}" alt="{{ $product->title }}" width="100"></td>
<td>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.footer')
        </div>
        <!-- ./wrapper -->
        @include('admin.js')
    </body>
</html>
