@extends('layouts.front')

@push('scripts')
<script>
    $(document).ready(function () {
        var minVal = parseInt($('.min-price span').text());
        var maxVal = parseInt($('.max-price span').text());
        $("#prices-range").slider({
            range: true,
            min: minVal,
            max: maxVal,
            step: 5,
            values: [minVal, maxVal],
            slide: function (event, ui) {
                $('.min-price span').text(ui.values[0]);
                $('.max-price span').text(ui.values[1]);
            }
        });
    });
</script>
@endpush

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>{{ $category->name_ru }}</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <div class="row shop-grid grid-view">
                @foreach($products as $item)
                    <div class="col-md-3 col-sm-4 shop-grid-item">
                        @include('parts.product-card')
                        <div class="clear"></div>
                    </div>
                @endforeach
            </div>

            <div class="page-selector">
                {{--TODO: запилить тут вывод--}}
                <div class="description">Показано: 1-4 из 16</div>
                <div class="pages-box">
                    <a href="#" class="square-button active">1</a>
                    <a href="#" class="square-button">2</a>
                    <a href="#" class="square-button">3</a>
                    {{--<div class="divider">...</div>--}}
                    {{--<a href="#" class="square-button"><i class="fa fa-angle-right"></i></a>--}}
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            <div class="information-blocks categories-border-wrapper">
                <div class="block-title size-3">Бренды</div>
                <ul>
                    @foreach($brands as $brand)
                    <li class="accordeon-title">{{ $brand->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="information-blocks">
                <div class="block-title size-2">Boolean</div>
                <div class="size-selector">
                    <div class="entry active">Все</div>
                    <div class="entry">Да</div>
                    <div class="entry">Нет</div>
                    <div class="spacer"></div>
                </div>
            </div>

            <div class="information-blocks">
                <div class="block-title size-2">Select</div>
                <div class="row">
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                    <label class="checkbox-entry col-xs-6">
                        <input type="checkbox"/> <span class="check"></span> Select value
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
