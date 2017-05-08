@extends('adminlte/theme')
@section('ng','app')
@section('mini',false)
@section('menuaside')
	@include('finanzas.common.menuaside')
@endsection
@section('title','Crear usuario')
@section('body')


        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <div class="panel panel-default" style="margin: 5px; ">
            <div class="panel-body">

                <form class="form-horizontal" role="form" method="POST" action="{{ route('movimientos.update',$movimiento->id) }}">
                    <input name="_method" type="hidden" value="PATCH" class="">
                    <div class="form-group">
                        <div class="col-xs-8">
                            <h3>Modificar movimiento</h3>
                        </div>
                    </div>

                    <!-- ERROR -->
                    <div class="form-group">
                        @if (Session::has('errors'))
                            <div class="col-xs-8">
                                <div class="alert alert-warning" role="alert">
                                    <ul>
                                        <strong>Oops! algo salio mal: </strong>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- FIN -->

                    <div class="form-group">
                        <div class="col-xs-8">
                            <label class="radio-inline"><input type="radio" name="modo" value="I" {{ ($movimiento->modo=='I') ? 'checked=checked' : '' }}>Ingreso</label>
                            <label class="radio-inline"><input type="radio" name="modo" value="E" {{ ($movimiento->modo=='E') ? 'checked=checked' : '' }}>Egreso</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="monto" placeholder="Monto" value="{{  $movimiento->monto  }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">
                            <textarea type="text" class="form-control" name="nota" placeholder="Descripcion">{{  $movimiento->nota }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">
                            <select class="form-control" name="id_cuenta">
                                <option value="">- Asignar a cuenta -</option>
                                @foreach($cuentas as $item)
                                    <option value="{{ $item->id }}" {{ ($movimiento->id_cuenta==$item->id) ? 'selected=selected' : '' }}>{{ $item->cuenta }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">
                            <select class="s2_categorias form-control" multiple="multiple" name="id_categoria">
                                < @foreach($categorias as $item)
                                    <option value="{{ $item->id }}" {{ ($movimiento->id_categoria==$item->id) ? 'selected=selected' : '' }}>{{ $item->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-8">

                            <!-- DATEPICKER -->
                            <div ng-init="date_session = '{{ \Carbon\Carbon::parse($movimiento->created_at)->format('d-m-Y') }}';" ng-controller="datapickerController">
                                <div class="input-group">
                                    <input type="text" name="date_session" placeholder="Seleccionar fecha" class="form-control" ng-model="date_session" datepicker-popup="dd-MM-yyyy" is-open="datepickerOpened" ng-required="true" show-button-bar="false" ng-click="open($event)"/>
                                </div>
                            </div>
                            <!-- END DATEPICKER -->

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <input id="submit" name="submit" type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </div>
                </form>

                <div class="col-xs-6 pull-right">
                    <form method="POST" id="Destroy{{$movimiento->id}}"  action="{{ route('movimientos.destroy',$movimiento->id) }}">
                        <input name="_method" type="hidden" value="DELETE" class="">
                        <button type="submit" value="Guardar" class="btn btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar movimiento
                        </button>
                    </form>
                </div>
            </div>
        </div>
 

    @include('finanzas.movimientos.partial.footer')


        <script>
            $(function(){
                $(".s2_categorias").select2({
                    tags: true,
                    placeholder: "Ingresar categoria",
                    maximumSelectionLength: 1,
                    language: {
                        maximumSelected: function (e) {
                            var t = "Solo se permite " + e.maximum + " categoria";
                            e.maximum != 1 && (t += "s");
                            return t;
                        }
                    }
                })
            });

        </script>
@endsection
