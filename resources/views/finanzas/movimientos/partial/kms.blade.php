<!-- Tipo de cuenta kmslan-->
<div class="row">
  @if($cuenta->id_tipo_cuenta==4)

    <?php
    $byCategoria = $movimientos->groupBy('id_categoria');
    ?>

    @foreach($byCategoria as $id_categoria =>$movimiento)
        <?php
        $cat = \IAServer\Http\Controllers\Finanzas\Model\Categorias::where('id',$id_categoria)->first();
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green-gradient">
            <span class="info-box-icon"><i class="fa fa-plane"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ $cat->categoria }}</span>
              <span class="info-box-number">{{ currency($movimiento->sum('monto')) }} kms</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    @endforeach

  @endif
</div>
