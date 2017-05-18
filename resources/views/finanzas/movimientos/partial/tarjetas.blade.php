<!-- Tipo de cuenta tarjetas-->
@if($cuenta->id_tipo_cuenta==3)

  <?php
    $byCategoria = $movimientos->groupBy('id_categoria');
  ?>

  <div class="row">

    @foreach($byCategoria as $id_categoria =>$movimiento)
      <?php
        $cat = \IAServer\Http\Controllers\Finanzas\Model\Categorias::where('id',$id_categoria)->first();
        $total = $movimiento->sum('monto');
      ?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box" style="background-color: #{{ $cat->color }};color:#FFF;">
            <span class="info-box-icon"><i class="fa fa-{{ $cat->icon }}"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ $cat->categoria  }}</span>
              <span class="info-box-number">${{ currency($total) }}</span>
{{--
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
                <span class="progress-description">
                  70% Presupuesto
                </span>
                --}}
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

    @endforeach


    </div>

@endif