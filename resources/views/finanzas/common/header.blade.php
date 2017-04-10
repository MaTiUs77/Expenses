<a href="{{ route('movimientos.index') }}" class="btn btn-info {{ Request::segment(count(Request::segments())) == 'movimientos' ? 'active' : '' }}" ><span class="fa fa-list fa-lg"></span> Lista</a>
<a href="{{ route('movimientos.create') }}" class="btn btn-info {{ Request::segment(count(Request::segments())) == 'create' ? 'active' : '' }}" ><span class="fa fa-plus fa-lg"></span> Movimiento</a>
<a href="{{ route('categorias.create') }}" class="btn btn-info"><span class="fa fa-plus fa-lg"></span> Categorias</a>


