<!-- Tipo de cuenta prestamo-->
<div class="row">
  @if($cuenta->id_tipo_cuenta==2)
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
