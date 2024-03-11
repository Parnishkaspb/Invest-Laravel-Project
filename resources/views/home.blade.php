@extends('layouts.app')

@section('content')
<style type="text/css">
    @import url("https://code.highcharts.com/css/highcharts.css");

    .highcharts-pie-series .highcharts-point {
        stroke: #ede;
        stroke-width: 2px;
    }

    .highcharts-pie-series .highcharts-data-label-connector {
        stroke: silver;
        stroke-dasharray: 2, 2;
        stroke-width: 2px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 600px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Инвестиции') }}</div>

                <div class="row card-body" id="result">

                    <script src="{{ asset('code/highcharts.js') }}"></script>
                    <script src="{{ asset('code/modules/exporting.js') }}"></script>
                    <script src="{{ asset('code/modules/export-data.js') }}"></script>
                    <script src="{{ asset('code/modules/accessibility.js') }}"></script>
                    
                    <div class="col-md-4">
                        <ul>
                            @foreach ($all_invst as $invest)
                                <li> <a href="/info/{{$invest->id}}"> Полная информация о проекте №: {{ $invest->id }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    

                    <div class="col-md-6" id="pie_container" style="height: 400px;"></div>
                    <!-- <figure class="highcharts-figure">
                        
                    </figure> -->

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const a = {!! json_encode($investition) !!};

    if (a.length == 0){
        $("#result").html("<div class='text-center'> К сожалению, у вас пока нет АКТИВНЫХ <a href='/create_investition'>инвестиций </a> </div>");

    } else {
        const transformedData2 = a.map((item, index) => [
            `Вклад № ${item.id}`,
            item.investment_amount,
            0,
            item.is_agreed,
            item.end_time,
            item.investment_amount_result,
        ]);
        
        Highcharts.chart('pie_container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Вклады'
            },
            credits: {
                enabled: false
            },
            tooltip: {
                enabled: true,
                headerFormat: '<span style="font-size: 10px">{series.name}</span><br>',
                pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>',
                
                formatter: function() {
                    return `<b>Информация о </b> ${this.point.name}: <br/>` +
                            `<b>Сумма вклада</b>: ${this.y}₽ <br/>` +
                            `<b>Сумма после</b>: ${this.point.end_money}₽ <br/>` +
                            `<b>Окончание вклада(Год-Месяц-День)</b>: ${this.point.end_time}<br/>` +
                            `<b>Деньги со вклада забираются на следующий день</b>`
                            ;
                },
                followPointer: false,
                style: {
                    color: '#333333',
                    fontSize: '15px',
                    padding: '8px'
                }
            },
            series: [{
                name: 'Активы',
                colorByPoint: true,
                keys: ['name', 'y', 'selected', 'sliced', 'end_time', 'end_money'],
                data: transformedData2
            }]
        });
    }

</script>
@endsection
