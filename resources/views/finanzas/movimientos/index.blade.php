@extends('adminlte/theme')
@section('ng','app')
@section('mini',false)
@section('title','Administracion')
@section('head')
<style>
    .ingreso
    {
        color: #5bb75b;
        font-size: 20px;
        font-weight: bold;
    }

    .egreso
    {
        color: #ec0006;
        font-size: 20px;
        font-weight: bold;
    }

    .tab-content > .tab-pane:not(.active),
    .pill-content > .pill-pane:not(.active) {
        display: block;
        height: 0;
        overflow-y: hidden;
    }
</style>
@endsection
@section('menuaside')
	@include('finanzas.common.menuaside')
@endsection
@section('bodytag',' ng-controller="FinanzasController" ')
@section('body')

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif


            <!-- TABS DE CUENTAS -->
            <ul class="nav nav-tabs">
                <?php $active = true; ?>
                @foreach($cuentas as $cuenta)
                    <li class="{{ $active ? 'active' : '' }}">
                        <a href="#{{ $cuenta->cuenta }}" aria-controls="{{ $cuenta->cuenta }}" role="tab" data-toggle="tab">{{ $cuenta->cuenta }}</a>
                    </li>
                    <?php $active = false; ?>
                @endforeach
            </ul>
					
            <!-- TABS CONTENT -->
            <div class="tab-content">
                <?php $active = true; ?>

                @foreach($cuentas as $cuenta)
                    <div class="tab-pane {{ $active ? 'active' : '' }}" id="{{ $cuenta->cuenta }}">
                        <div class="panel panel-default" style="background-color: #{{ $cuenta->color }};">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('finanzas.common.chart')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="list-group">
                            <ul class="media-list">

                                @foreach($cuenta->movimientos->groupBy('monthYear') as $monthYear => $movimientos)
                                    <?php
                                        $breadcrump = $cuenta->periodos->where('formatPeriodo',$monthYear)->first();
                                    ?>
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#{{ str_slug($monthYear) }}_{{ str_slug($cuenta->cuenta) }}_resumen" data-toggle="tab">{{ $monthYear }}</a>
                                            </li>
                                            <li>
                                                <a href="#{{ str_slug($monthYear) }}_{{ str_slug($cuenta->cuenta) }}_movimientos" data-toggle="tab">Movimientos</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="{{ str_slug($monthYear) }}_{{ str_slug($cuenta->cuenta) }}_resumen">
                                                @include('finanzas.movimientos.partial.efectivo',[$breadcrump])
                                                @include('finanzas.movimientos.partial.egreso',[$breadcrump])
                                                @include('finanzas.movimientos.partial.kms',[$breadcrump])
                                            </div>
                                            <!-- ********************* MOVIMIENTOS ******************** -->
                                            <div class="tab-pane" id="{{ str_slug($monthYear) }}_{{ str_slug($cuenta->cuenta) }}_movimientos">
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
                                                        @if($cuenta->id_tipo_cuenta==4)
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <?php $active = false; ?>
                @endforeach

            </div>


@include('finanzas.movimientos.partial.footer')
@endsection
