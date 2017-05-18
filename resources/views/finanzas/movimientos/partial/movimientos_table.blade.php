<div class="list-group">
    <ul class="media-list">
        @foreach($movimientos as $movimiento)
            <li class="media">
                <!-- Icono de movimiento -->
                <div class="media-left">
                    <a href="{{ route('movimientos.edit',$movimiento->id) }}">
             <span class="fa-stack fa-2x">
                  <i class="fa fa-circle fa-stack-2x" @if(isset($movimiento->joinCategoria->color)) style="color:#{{ $movimiento->joinCategoria->color }};" @endif></i>
                  <i class="fa fa-{{ $movimiento->joinCategoria->icon }} fa-stack-1x fa-inverse"></i>
            </span>
                    </a>
                </div>

                <!-- Descripcion de movimiento -->
                <div class="media-body">
                    <div class="pull-right fecha">
                        @if($movimiento->futuro)
                            <span class="fa fa-refresh  fa-spin"></span> {{ $movimiento->createdCarbon->format('d/m') }}
                        @else
                            <span class="fa fa-calendar-o"></span> {{ $movimiento->createdCarbon->format('d/m') }}
                        @endif
                    </div>
                    <h4 class="media-heading">
                        {{ $movimiento->joinCategoria->categoria }}
                    </h4>

                    <!-- Tipo de cuenta kmslan-->
                    @if($cuenta->id_tipo_cuenta== 4)
                        <div class="pull-right {{ $movimiento->modo=='I'  ? 'ingreso' : 'egreso' }}">{{ currency($movimiento->monto) }} kms</div>
                    @else
                        <div class="pull-right {{ $movimiento->modo=='I'  ? 'ingreso' : 'egreso' }}">{{ ($movimiento->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($movimiento->monto) }}</div>
                    @endif

                    @if(!empty($movimiento->nota))
                        <span class="fa fa-file-text-o "></span> {{ $movimiento->nota }}
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
