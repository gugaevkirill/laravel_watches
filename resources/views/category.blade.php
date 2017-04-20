@extends('layouts.front')

@push('headOther')
<script src="https://unpkg.com/vue@2.2.6"></script>
<script src="https://unpkg.com/vue-router@2.4.0/dist/vue-router.js"></script>
@endpush

@push('scripts')
<script>
    var config = {
        brands: {!! $brandsJSON !!},
        page: {{ $paginator->currentPage() }},
        totalPages: {{ $paginator->lastPage() }}
    };
</script>
<script src="/js/catalog.js"></script>
@endpush

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>{{ $category->name_ru }}</a>
</div>

<div id="vue-catalog">
    <div class="information-blocks">
        <div class="row">
            <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
                <div class="row shop-grid grid-view">
                    @include("parts/products-list")
                </div>

                <div class="page-selector">
                    {{--TODO: запилить тут вывод--}}
                    <div class="description">@include('parts/products-count')</div>
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
                    <ul class="brands-filter">
                        @foreach($brands as $brand)
                        <router-link :to="{ query: { brand: '{{ $brand['slug'] }}' }}" tag="li" v-if="!brands.{{ $brand['slug'] }}.active">
                            {{ $brand['name'] }}
                        </router-link>
                        <li class="active" v-if="brands.{{ $brand['slug'] }}.active" @click.stop="unsetBrand()">{{ $brand['name'] }}</li>
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
</div>

<template id="vue-catalog-template">

</template>
@endsection
