@if(count($cuenta->periodos)>0)

    <?php
        $orderPeriodos = $cuenta->periodos->sortBy('carbonDate');
    ?>

    <div id="#container{{$cuenta->id}}" style="width: 100%;height:300px;"></div>

    <script>
        $(function () {
            var chart;

            var chartOptions = {
                chart: {
                    renderTo: '#container{{$cuenta->id}}',
                    type: 'column'
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: true
                },
                title: {
                    text: 'Resumen'
                },
                xAxis: {
                    categories: ['{!! $orderPeriodos->implode('humanMes', "','")  !!}']
                },
                series: [
                    @if($cuenta->tipo==0)
                    {
                        name: 'Balance',
                        data: [
                                @foreach($orderPeriodos as $v)
                            {
                                y: {{ $v->balance }},
                                @if($v->balance>0)
                                color: '#74C274'
                                @else
                                color: '#F46C6F'
                                @endif
                            },
                            @endforeach
                        ],
                        dataLabels: {
                            enabled: true,
                            format: '${point.y:,.0f}', // one decimal
                        }
                    },
                    {
                        name: 'Neto',
                        data: [
                                @foreach($orderPeriodos as $v)
                            {
                                y: {{ $v->neto }},
                                @if($v->neto>0)
                                color: '#74C274'
                                @else
                                color: '#F46C6F'
                                @endif
                            },
                            @endforeach
                        ],
                        dataLabels: {
                            enabled: true,
                            format: '${point.y:,.0f}', // one decimal
                        },
                        visible : false
                    },
                    {
                        name: 'Ingreso',
                        type: 'line',
                        color: '#74C274',
                        data: [
                            @foreach($orderPeriodos as $v)
                                <?php
                                    $ingreso = $v->ingreso;
                                    if(!is_numeric($ingreso)) { $ingreso = 0; }
                                ?>
                            {
                                y: {{ $ingreso }}
                            },
                            @endforeach
                        ],
                        dataLabels: {
                            enabled: true,
                            format: '${point.y:,.0f}', // one decimal
                        },
                        visible : false
                    },

                    @endif
                    {
                        name: 'Egreso',
                        type: 'line',
                        color: '#F46C6F',
                        data: [
                            @foreach($orderPeriodos as $v)
                                <?php
                                $egreso = $v->egreso * -1;
                                if(!is_numeric($egreso)) { $egreso = 0; }
                                ?>
                            {
                                y: {{ $egreso }}
                            },
                            @endforeach
                        ],
                        dataLabels: {
                            enabled: true,
                            format: '${point.y:,.0f}', // one decimal
                        },
                        @if($cuenta->tipo==0)
                        visible : false
                        @endif
                    }
                ]
            };

            chart = new Highcharts.Chart(chartOptions);
        });
    </script>
@endif
