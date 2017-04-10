<!-- MENU ALINEADO A LA DERECHA -->
<ul class="nav navbar-nav">

	
    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Movimientos <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('movimientos.index') }}"><span class="fa fa-list"></span> Listar</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('movimientos.create') }}"><span class="fa fa-plus"></span> Agregar</a></li>
                    </ul>
                </li>
				
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Categorias <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('categorias.index') }}"><span class="fa fa-list"></span> Listar</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('categorias.create') }}"><span class="fa fa-plus"></span> Agregar</a></li>
                    </ul>
                </li>
</ul>
