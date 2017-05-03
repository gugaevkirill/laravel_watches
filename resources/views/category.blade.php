@extends('layouts.front')

@push('headOther')
<script src="/js/vue.js"></script>
<script src="/js/vue-router.js"></script>
@endpush

@push('scripts')
<script>
    var config = {
        brands: {!! $brandsJSON !!},
        page: {{ $currentPage }},
        totalPages: {{ $totalPages }},
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
                        {!! $pagesNumberHTML !!}
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
                    @if (isset($param['value']))
                    <div class="size-selector">
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '0' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '0')">Все</div>

                        {{-- Для параметров типа Select --}}
                        @foreach($param['values'] as $valId => $val)
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '{{ substr($valId, 3) }}' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '{{ substr($valId, 3) }}')">{{ $val['title'] }}</div>
                        @endforeach

                        {{-- Для boolean параметров --}}
                        @if ($param['type'] == 'boolean')
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '1' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '1')">Да</div>
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '2' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '2')">Нет</div>
                        @endif
                    </div>
                    @else
                    <div class="row">
                        @foreach($param['values'] as $valId => $val)
                        <label class="checkbox-entry col-xs-6" @click="updateRouteParam('{{ $param['slug'] }}')">
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
