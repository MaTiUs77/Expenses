<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">Movimientos</li>

            <li><a href="{{ route('movimientos.index') }}"><span class="fa fa-list"></span> Listar</a></li>
            <li><a href="{{ route('movimientos.create') }}"><span class="fa fa-plus"></span> Agregar</a></li>

            <li class="header">Cuentas</li>
        </ul>

        <?php
                /*
        <ul class="nav nav-stacked">

            @foreach($cuentas as $cuenta)
                <?php
                $actual = (object) $cuenta->actual;
                ?>
                    <!-- Tipo de cuenta efectivo-->
                @if($cuenta->id_tipo_cuenta==1)
                    <li>
                        <a href="#"><i class="fa fa-circle-o" style="color: #{{ $cuenta->color }}"></i> {{ $cuenta->cuenta }} <span class="pull-right badge bg-green"> ${{ currency($actual->ingreso->balance) }}</span></a>
                    </li>
                @endif

                @if($cuenta->id_tipo_cuenta>1 && $cuenta->id_tipo_cuenta<4)
                    <li>
                        <a href="#"><i class="fa fa-circle-o" style="color: #{{ $cuenta->color }}"></i> {{ $cuenta->cuenta }} <span class="pull-right badge bg-red"> ${{ currency($actual->egreso->egreso) }}</span></a>
                    </li>
                @endif

            @endforeach

        </ul>
                */?>




    </section>
</aside>
