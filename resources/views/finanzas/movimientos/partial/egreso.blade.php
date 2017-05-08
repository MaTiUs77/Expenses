<!-- Tipo de cuenta prestamo o tarjetas-->
@if($cuenta->id_tipo_cuenta==2 || $cuenta->id_tipo_cuenta==3)
  <a class="btn btn-app">
    <span class="badge bg-red">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->egreso) }}</span>
    <i class="fa fa-thumbs-down"></i> Egresos
  </a>
@endif