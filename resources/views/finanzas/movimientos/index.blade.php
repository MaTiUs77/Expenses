@extends('adminlte/theme')
@section('ng','app')
@section('mini',false)
@section('title','Administracion')
@section('head')
{!! IAStyle('adminlte/plugins/fullcalendar/fullcalendar.min.css') !!}
{!! IAStyle('adminlte/plugins/fullcalendar/fullcalendar.print.css') !!}
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
@section('menutop')
	@include('finanzas.common.menutop')
@endsection
@section('bodytag',' ng-controller="FinanzasController" ')
@section('body')

 <div id="calendarOFFLINE"></div>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="panel panel-default" style="margin: 5px; ">
        <div class="panel-body">

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

                <!-- FOREACH $cuentas -->
                @foreach($cuentas as $cuenta)
                    <div class="tab-pane {{ $active ? 'active' : '' }}" id="{{ $cuenta->cuenta }}">
                        <div class="panel panel-default" style="background-color: #{{ $cuenta->color }};">
                            <div class="panel-body">

                                <div class="row">

                                    <!-- Lista de saldos en periodos
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            @if(count($cuenta->periodos)>0)
                                                @foreach($cuenta->periodos as $periodo)
                                                    <li class="cuentaWidget list-group-item">
                                                        {{  $periodo->formatPeriodo }}
                                                        <div class="pull-right">
                                                            @if($cuenta->tipo==0)
                                                                <span class="label label-success">${{ currency($periodo->ingreso) }}</span>
                                                                <span class="label label-danger">${{ currency($periodo->egreso) }}</span>
                                                                <span class="label label-primary">${{ currency($periodo->neto) }}</span>

                                                            @endif

                                                            @if($cuenta->tipo==1)
                                                                <span class="label label-danger">${{ currency($periodo->neto) }}</span>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="cuentaWidget list-group-item">
                                                    Sin movimientos
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    FIN Lista de saldos en periodos -->

                                    <div class="col-md-12">
                                        @include('finanzas.common.chart')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="list-group">
                            <ul class="media-list">
                                <?php
                                    $lastMonth = null;
                                ?>
                                @foreach($cuenta->movimientos as $movimiento)
                                    <?php
                                        $currentMonth= ucfirst($movimiento->createdCarbon->formatLocalized('%B/%Y'));
                                        $currentAngularToggle= ucfirst($movimiento->createdCarbon->formatLocalized('%B%Y'));

                                        if($lastMonth == $currentMonth) {
                                            $showMonthHeader = false;
                                        } else {
                                            $showMonthHeader = true;
                                        }
                                   ?>

                                    @if($showMonthHeader)
                                        <?php
                                            $breadcrump = $cuenta->periodos->where('formatPeriodo',$currentMonth)->first();
                                            $lastMonth = $currentMonth;
                                            ?>
                                        <ol class="breadcrumb">
                                            <li>
                                                <i class="fa" ng-class="{'fa-eye' : mediaMonth{{ $currentAngularToggle  }}, 'fa-eye-slash' : !mediaMonth{{ $currentAngularToggle  }}}" ng-click="mediaMonth{{ $currentAngularToggle  }} = !mediaMonth{{ $currentAngularToggle  }}"></i>
                                                {{ $currentMonth  }}
                                            </li>


                                            <li class="pull-right"><i class="fa fa-thumbs-down"></i> ${{ currency($breadcrump->egreso) }}</li>
                                            @if($cuenta->tipo==0)
                                                <li class="pull-right"><i class="fa fa-thumbs-up"></i> ${{ currency($breadcrump->ingreso) }}</li>
                                                <li class="pull-right"><i class="fa fa-bar-chart"></i> ${{ currency($breadcrump->neto) }}</li>
                                                <li class="pull-right"><i class="fa fa-balance-scale"></i> ${{ currency($breadcrump->balance) }}</li>
                                            @endif
                                        </ol>
                                    @endif

                                    <li class="media" ng-show="mediaMonth{{ $currentAngularToggle  }}">
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

                                            <div class="pull-right {{ $movimiento->modo=='I'  ? 'ingreso' : 'egreso' }}">${{ currency($movimiento->monto) }}</div>
                                            @if(!empty($movimiento->nota))
                                                <span class="fa fa-file-text-o "></span> {{ $movimiento->nota }}
                                            @endif

                                            <?php
                                            $calendario[] = [
                                                    'cat' => $movimiento->joinCategoria->categoria,
                                                    'monto' => currency($movimiento->monto),
                                                    'carbon' => $movimiento->createdCarbon
                                            ];
                                            ?>
                                        </div>
                                    </li>
                                @endforeach <!-- END FOREACH $movimientos -->
                            </ul>
                        </div>


                    </div>
                    <?php $active = false; ?>
                @endforeach <!-- END FOREACH $cuentas -->
				
	
				{{--
				<script>
				var calendarEvents = [];
				
				calendarEvents = [
					@foreach($calendario as $item)
					{
					  title: '{{ $item['cat'] }} {{ $item['monto'] }}',
					  start: new Date({{ $item['carbon']->format('Y') }}, {{ $item['carbon']->format('m') - 1 }}, {{ $item['carbon']->format('d') }}),
					  backgroundColor: "#f56954", //red
					  borderColor: "#f56954" //red
					},
					@endforeach
				];	   
			</script>--}}
            </div>
        </div>
    </div>


@include('finanzas.movimientos.partial.footer')
@endsection
