<!DOCTYPE html>
<html lang="en">

@include('admin.css')


<body class="hold-transition sidebar-mini">
<div class="wrapper" style="position: inherit !important; " >
  <!-- Navbar -->
  @include('admin.navbar')

    

  <!-- Main Sidebar Container -->
    @include('admin.sidebar')


    @include('admin.dashboard_content')


@include('admin.footer')
</div>
<!-- ./wrapper -->
@include('admin.js');
</body>
</html>
