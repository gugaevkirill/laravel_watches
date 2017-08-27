@extends('layouts.front')

@section('title')
    {{ $category->name }} - EliteBazaar
@endsection

@push('headOther')
<script src="/js/libs/vue.js"></script>
<script src="/js/libs/vue-router.js"></script>
@endpush

@push('scripts')
<script>
    var config = {
        brands: {!! $brandsJSON !!},
        currentPage: {{ $paginator->currentPage() }},
        totalPages: {{ $paginator->lastPage() }},
        params: {!! $paramsJSON !!}
    };
</script>
<script src="/js/site/catalog.js"></script>
@endpush

@section('content')
{{--<div class="breadcrumb-box">--}}
    {{--<a href="/">Главная</a>--}}
    {{--<a href="/{{ $category->slug }}/">{{ $category->name }}</a>--}}
{{--</div>--}}

<div id="vue-catalog" class="m-t-30">
    <div class="information-blocks">
        <div class="row">
            <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
                <div class="row shop-grid grid-view">
                    @include("parts/products-list")
                </div>

                <div class="page-selector">
                    <div class="description">@include('parts/products-count')</div>
                    <div class="pages-box">
                        {!! $paginator->render('parts/products-pagen') !!}
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
                <div class="information-blocks categories-border-wrapper">
                    <div class="block-title size-3">@lang('site.system_brands')</div>
                    <ul class="brands-filter">
                        @foreach($brands as $brand)
                        <router-link :to="{ query: { brand: '{{ $brand['slug'] }}', page: 1 }}" tag="li" v-if="!brands.{{ $brand['slug'] }}.active">
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
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '0' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '0')">@lang('site.system_all')</div>

                        {{-- Для параметров типа Select --}}
                        @foreach($param['values'] as $valId => $val)
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '{{ substr($valId, 3) }}' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '{{ substr($valId, 3) }}')">{{ $val['title'] }}</div>
                        @endforeach

                        {{-- Для boolean параметров --}}
                        @if ($param['type'] == 'boolean')
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '1' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '1')">@lang('site.system_yes')</div>
                        <div :class="['entry', params.{{ $param['slug'] }}.value === '2' ? 'active' : null]" @click.stop="setParam('{{ $param['slug'] }}', '2')">@lang('site.system_no')</div>
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
