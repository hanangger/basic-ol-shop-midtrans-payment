@section('header')
<nav class="navbar navbar-default">
<div class="container-fluid">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">Dummy Online Shop&nbsp;<span class="glyphicon glyphicon-tags"></span></a>
  </div>
  <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li><a href="#"></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li ><a href="{{url('catalog/cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;My Cart</a></li>
    </ul>
  </div><!--/.nav-collapse -->
</div><!--/.container-fluid -->
</nav>

@stop