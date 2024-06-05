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
                    <h1>Edit Product</h1>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title">Product Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $product->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </form>
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
