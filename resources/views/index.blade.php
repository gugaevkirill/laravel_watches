@extends('layouts.front')

@section('content')
<div class="information-blocks" style="margin-bottom: 30px;">
    <div class="row">
        <div class="col-md-3 p-a-0">
            <div class="sidebar-navigation">
                <div class="title">@lang('site.system_brands')<i class="fa fa-angle-down"></i></div>
                <div class="list">
                    @foreach($brands as $brand)
                    <a class="entry" href="{{ $brand->getHref() }}"><span><i class="fa fa-angle-right"></i>{{ $brand->name }}</span></a>
                    @endforeach
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-md-9 p-a-0">
            <div class="navigation-banner-swiper">
                <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide active" data-val="0">
                            <div class="navigation-banner-wrapper light-text align-1" style="background-image: url(/img/main/900x500_PatekP3.jpg);">
                                <div class="navigation-banner-content">
                                    <div class="cell-view">
                                        {{--<h2 class="subtitle">Слайдер из баннеров</h2>--}}
                                        <h1 class="title">Patek Philippe</h1>
                                        <div class="description">@lang('site.menu_patek')</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=patek_philippe">@lang('site.main_in_catalog')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="swiper-slide active" data-val="0">
                            <div class="navigation-banner-wrapper light-text align-1" style="background-image: url(/img/main/900x500_Piguet3.jpg);">
                                <div class="navigation-banner-content">
                                    <div class="cell-view">
                                        {{--<h2 class="subtitle">Слайдер из баннеров</h2>--}}
                                        <h1 class="title">Audemars Piguet</h1>
                                        <div class="description">@lang('site.menu_audemar')</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=audemars_piguet">@lang('site.main_in_catalog')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="swiper-slide active" data-val="0">
                            <div class="navigation-banner-wrapper light-text align-1" style="background-image: url(/img/main/900x500_Rolex.jpg);">
                                <div class="navigation-banner-content">
                                    <div class="cell-view">
                                        <h1 class="title">ROLEX</h1>
                                        <div class="description">@lang('site.menu_rolex')</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=rolex">@lang('site.main_in_catalog')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="pagination"></div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="information-blocks">
    <div class="tabs-container">
        <div class="swiper-tabs tabs-switch">
            <div class="title">@lang('site.system_novels')</div>
            <div class="list">
                @foreach ($featured as $record)
                <a class="block-title tab-switcher @if ($loop->first) active @endif ">{{ $record['title'] }}</a>
                @endforeach
                <div class="clear"></div>
            </div>
        </div>
        <div>
            @foreach ($featured as $record)
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($record['products'] as $item)
                                <div class="swiper-slide">
                                    <div class="paddings-container">
                                    @include('parts.product-card')
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<div class="information-blocks">
    <div class="row">
        <div class="information-entry col-md-6 promotion">
            <div class="sale-entry sale-entry-border main-banner1">
                <div class="sale-price"><i class="fa fa-3x fa-check" style="
    padding: 20px;
    color: white;
"></i></div>
                <div class="sale-title">@lang('site.main_cardstitle1')</div>
                <div class="sale-description">@lang('site.main_cardstext1')</div>
            </div>
        </div>
        <div class="information-entry col-md-6 promotion">
            <div class="sale-entry sale-entry-border main-banner2">
                <div class="sale-price" style="color: white;"><i class="fa fa-3x fa-credit-card" style="padding: 20px;"></i></div>
                <div class="sale-title">@lang('site.main_cardstitle2')</div>
                <div class="sale-description">@lang('site.main_cardstext2')</div>
            </div>
        </div>
    </div>
</div>

<div class="information-blocks m-b-30">
    <div class="row">
        <div class="col-md-4 information-entry">
            <h3 class="block-title">@lang('site.main_benefitstitle1')</h3>
            <div class="from-the-blog-entry">
                <span class="image"><img src="/img/main/main-1.jpg" alt=""></span>
                <div class="description m-b-30">@lang('site.main_benefitstext1')</div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-4 information-entry m-b-30">
            <h3 class="block-title">@lang('site.main_benefitstitle2')</h3>
            <ol class="list-type-2">@lang('site.main_benefitstext2')</ol>
        </div>
        <div class="col-md-4 information-entry m-b-30 otz">
            <h3 class="block-title">@lang('site.system_comments')</h3>
            <div class="swiper-container blockquote-slider" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            @lang('site.main_comment1')
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            @lang('site.main_comment2')
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            @lang('site.main_comment3')
                        </blockquote>
                    </div>
                </div>
                <div class="pagination "></div>
            </div>
        </div>
    </div>
</div>

@include('parts.featured-products')
@endsection
