<div class="row margin-bottom-40">
  <div class="sidebar col-md-3 col-sm-4" style="    width: 100%;
    text-align: center;">
    <ul class="list-group margin-bottom-25 sidebar-menu">
      @foreach ($categories as $category)
      <li class="list-group-item category-item clearfix">
        @php
        $url = url(str_replace(' ', '', $category->category_name));
        @endphp
        <a href="{{ $url }}">
          <i class="fa fa-angle-right"></i> {{ $category->category_name }}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
