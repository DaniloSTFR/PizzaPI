<?php
include_once('model/administrativo/administrativo.class.php');

$discriminador = "";
$discriminadorAtivo = 0;
$dados = array();
$categories = array();
$adm = new Administrativo();
$dadosRelatorio = $adm->dadosBalancoPedidos();

if($dadosRelatorio){
    foreach ($dadosRelatorio as &$value){
        array_push($dados,$value->TOTAL_POR_STATUS);
        array_push($categories, $value->statusDescricao);
    }
}

?>
<div class="row mb-3">

    <div class="col-md-2 themed-grid-col"></div>

    <div class="col-md-8 themed-grid-col">
        <div id="chart"></div>

        <script>
            var options = {
                series: [{
                    data: <?php echo "[".implode(",", $dados)."]"; ?>
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: <?php echo "['".implode("','", $categories)."']"; ?>,
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>



    </div>

    <div class="col-md-2 themed-grid-col"></div>

</div>