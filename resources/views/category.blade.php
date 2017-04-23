@extends('layouts.front')

@push('headOther')
<script src="/js/vue.js"></script>
<script src="/js/vue-router.js"></script>
@endpush

@push('scripts')
<script>
    var config = {
        brands: {!! $brandsJSON !!},
        page: {{ $paginator->currentPage() }},
        totalPages: {{ $paginator->lastPage() }},
        params: {!! $paramsJSON !!}
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
                        <a class="square-button active">1</a>
                        {{--<a class="square-button">2</a>--}}
                        {{--<a class="square-button">3</a>--}}
                        {{--<div class="divider">...</div>--}}
                        {{--<a class="square-button"><i class="fa fa-angle-right"></i></a>--}}
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

                @foreach ($params as $param)
                <div class="information-blocks">
                    <div class="block-title size-2">{{ $param['title'] }}</div>
                    @if ($param['type'] == 'boolean' || ($param['type'] == 'select' && count($param['values']) < 3))
                    <div class="size-selector">
                        <div class="entry active">Все</div>
                        @foreach($param['values'] as $valId => $val)
                        <div class="entry">{{ $val['title'] }}</div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        @foreach($param['values'] as $valId => $val)
                        <label class="checkbox-entry col-xs-6" @click="modifyParam('{{ $param['slug'] }}')">
                            <input type="checkbox" v-model="params.{{ $param['slug'] }}.values.{{ $valId }}.active"/> <span class="check"></span> {{ $val['title'] }}
                        </label>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<template id="vue-catalog-template">

</template>
@endsection
