<!-- Tipo de cuenta efectivo-->
@if($cuenta->id_tipo_cuenta==1)
  <a class="btn btn-app">
    <span class="badge bg-red">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->egreso) }}</span>
    <i class="fa fa-thumbs-down"></i> Egresos
  </a>

  <a class="btn btn-app">
    <span class="badge bg-green">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->ingreso) }}</span>
    <i class="fa fa-thumbs-up"></i> Ingresos
  </a>

  <a class="btn btn-app">
    <span class="badge">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->neto) }}</span>
    <i class="fa fa-bar-chart"></i> Neto
  </a>

  <a class="btn btn-app">
    <span class="badge bg-blue">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->balance) }}</span>
    <i class="fa fa-balance-scale"></i> Balance
  </a>
@endif