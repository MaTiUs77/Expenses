<!-- Tipo de cuenta kmslan-->
@if($cuenta->id_tipo_cuenta==4)
  <a class="btn btn-app">
    <span class="badge bg-green">{{ currency($breadcrump->ingreso) }} kms</span>
    <i class="fa fa-plane"></i> Puntos
  </a>
@endif