@extends('layouts.app')

@section('content')

<style>
    .image-container {
    position: relative;
    margin-top: 200px;
    }

    .bw-image,
    .color-image {
    position: absolute;
    top: 10%;
    left: 50%;
    width: 50%;
    height: auto;
    transition: opacity 0.5s ease;
    transform: translate(-50%, -50%);
    }   

    .bw-image {
    z-index: 1;
    }

    .color-image {
    z-index: 2;
    opacity: 0;
    }

    .image-container:hover .color-image {
    opacity: 1;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <h1> {{ __('Информация о проекте №') }}  {{ $info->id }}</h1>
                    </div>
                </div>
                <div class="card-body">
                    <!-- СДЕЛАТЬ ПОЗДРАВИТЕЛЬНУЮ ШТУКУ, КОГДА ВКЛАД ЗАКОНЧИЛСЯ -->
                    <!-- <h1>Информация о записи</h1> -->
                    <div class="text-center">
                        <h1> {{ __("Сумма инвестиции: ") }}  {{ $info->investment_amount }}</h1>
                        <h1> {{ __("Сумма, которую вы получите: ") }}  {{ $info->investment_amount_result }}</h1>
                    </div>

                    <ul>
                        @if ($info->quantity_time == 1)
                        <li> {{ __("Процент инвестиции: 20%") }} </li>
                        @elseif ($info->quantity_time == 2)
                        <li> {{ __("Процент инвестиции: 25%") }} </li>
                        @elseif ($info->quantity_time == 3)
                        <li> {{ __("Процент инвестиции: 30%") }} </li>
                        @elseif ($info->quantity_time == 5)
                        <li> {{ __("Процент инвестиции: 40%") }} </li>
                        @endif
                        <li> {{ ($info->is_agreed == 0) ? "Денежные средства еще не поступили на счет" : "Инвестиции уже работают" }} </li>
                    </ul>
                    <div class="text-center">
                    <h3> {{ __("Дата окончания: ") }}  {{ \Carbon\Carbon::parse($info->end_time)->formatLocalized('%d %B %Y') }} год</h3>


                    </div>
                    <div class="text-center">
                        <h3 id="percent"></h3>
                    </div>
                </div>
            </div>
            <div class="image-container">
                    <img src="{{asset('images/forInvest/black-and-white-image.png') }}" alt="ЧБ" class="bw-image">
                    <img src="{{asset('images/forInvest/color-image.png') }}" alt="Цветная" class="color-image">
            </div>
        </div>
    </div>
</div>

<script>   
    function calculatePercentagePassed(startDate, endDate) {       
        if (new Date(startDate) > new Date(endDate) || new Date() < new Date(startDate)) {
            console.error('Даты указаны некорректно.');
            return;
        }
        // console.log((new Date() - new Date(startDate)) / (new Date(endDate) - new Date(startDate)));
        return (new Date() - new Date(startDate)) / (new Date(endDate) - new Date(startDate));
    }

    document.querySelector('.color-image').style.opacity = calculatePercentagePassed('{{ $info->created_at }}', '{{ $info->end_time }}');
    // document.querySelector('.color-image').style.opacity = calculatePercentagePassed('{{ $info->created_at }}', '2023-12-23');

    function updatePercentageEverySecond(startDate, endDate) {
        setTimeout(function() {
            // const percentagePassed = calculatePercentagePassed(startDate, endDate);
            // console.log(`Прошло ${calculatePercentagePassed(startDate, endDate)*100}% от указанного периода.`);
            $("#percent").text(`${calculatePercentagePassed(startDate, endDate)*100}% из 100%.`);
            
            // Обновляем процент прошедшего времени каждую секунду
            updatePercentageEverySecond(startDate, endDate);
        }, 1000);
    }

    updatePercentageEverySecond('{{ $info->created_at }}', '{{ $info->end_time }}')
</script>

@endsection
