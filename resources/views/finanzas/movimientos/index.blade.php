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
                        <a href="#{{ str_slug($cuenta->cuenta) }}" aria-controls="{{ str_slug($cuenta->cuenta) }}" role="tab" data-toggle="tab">{{ $cuenta->cuenta }}</a>
                    </li>
                    <?php $active = false; ?>
                @endforeach
            </ul>
					
            <!-- TABS CONTENT -->
            <div class="tab-content">
                <?php $active = true; ?>

                @foreach($cuentas as $cuenta)
                    <div class="tab-pane {{ $active ? 'active' : '' }}" id="{{ str_slug($cuenta->cuenta) }}">
                        <div class="panel panel-default" style="background-color: #{{ $cuenta->color }};">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('finanzas.common.chart')
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        @include('finanzas.movimientos.partial.prestamo',[$breadcrump])
                                        @include('finanzas.movimientos.partial.tarjetas',[$breadcrump,$movimientos])
                                        @include('finanzas.movimientos.partial.kms',[$breadcrump,$movimientos])
                                    </div>
                                    <!-- ********************* MOVIMIENTOS ******************** -->
                                    <div class="tab-pane" id="{{ str_slug($monthYear) }}_{{ str_slug($cuenta->cuenta) }}_movimientos">
                                        @include('finanzas.movimientos.partial.movimientos_ulist',[$movimientos])
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <?php $active = false; ?>
                @endforeach

            </div>


@include('finanzas.movimientos.partial.footer')
@endsection
