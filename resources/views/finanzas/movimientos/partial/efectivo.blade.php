<!-- Tipo de cuenta efectivo-->
<div class="row">
  @if($cuenta->id_tipo_cuenta== 1 )
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua-gradient">
        <span class="info-box-icon"><i class="fa fa-balance-scale"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Balance</span>
          <span class="info-box-number">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->balance) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-black-gradient">
        <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Neto</span>
          <span class="info-box-number">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->neto) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green-gradient">
        <span class="info-box-icon"><i class="fa fa-thumbs-up"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ingresos</span>
          <span class="info-box-number">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->ingreso) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red-gradient">
        <span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Egresos</span>
          <span class="info-box-number">{{ ($breadcrump->moneda == 'USD') ? 'US$' : '$'  }}{{ currency($breadcrump->egreso) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  @endif
</div>
