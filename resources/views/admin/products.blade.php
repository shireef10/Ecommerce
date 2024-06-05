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
            <h1>Add Products</h1>

            @if (session()->has('messages'))
                <div class="alert alert-success">
                    <button type="text" class="close" data-dismiss="alert">x</button>
                    {{ session()->get('messages') }}
                </div>
            @endif

            <form method="POST" action="{{ url('uploadProducts') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Product Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Product Title" required>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Price" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control" required>
        <option value="" disabled selected>Select a category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>
  </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="file" class="form-control-file">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @include('admin.footer')
</div>
<!-- ./wrapper -->
@include('admin.js')
</body>
</html>
