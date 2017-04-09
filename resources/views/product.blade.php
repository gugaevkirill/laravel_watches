@extends('layouts.front')

@push('scripts')
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script>
@endpush

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>{{ $categoryName }}</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-sm-5 col-md-4 col-lg-5 information-entry">
            <div class="product-preview-box">
                <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        @foreach ($productImages as $productImage)
                        <div class="swiper-slide">
                            <div class="product-zoom-image">
                                <img src="/{{ $productImage }}" alt="{{ $productName }}" data-zoom="/{{ $productImage }}" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination"></div>
                    <div class="product-zoom-container">
                        <div class="move-box">
                            <img class="default-image" src="img/product-main-1.jpg" alt="" />
                            <img class="zoomed-image" src="img/product-main-1-zoom.jpg" alt="" />
                        </div>
                        <div class="zoom-area"></div>
                    </div>
                </div>

                @if (count($productImages) > 1)
                <div class="swiper-hidden-edges">
                    <div class="swiper-container product-thumbnails-swiper" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                        <div class="swiper-wrapper">
                            @foreach ($productImages as $productImage)
                            <div class="swiper-slide
                                @if ($loop->first)
                                selected
                                @endif
                            ">
                                <div class="paddings-container">
                                    <img src="/{{ $productImage }}" alt="{{ $productName }}" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-7 col-md-4 information-entry">
            <div class="product-detail-box">
                <h1 class="product-title">{{ $productName }}</h1>
                <h3 class="product-subtitle">{{ $brandName }}</h3>

                <div class="price detail-info-entry">
                    @if (!empty($productPrices))
                        <div class="current">{{ $productPrices[0] }}</div>
                        @if (isset($productPrices[1]))
                        <div class="prev">{{ $productPrices[1] }}</div>
                        @endif
                    @endif

                    <a class="button style-10">
                        @if (empty($productPrices))
                            Узнать цену
                        @else
                            Купить
                        @endif
                    </a>

                    <div class="clear"></div>
                </div>

                @foreach ($productAttrs as $attrName => $attrValue)
                <div class="detail-info-entry">
                    <span class="detail-info-entry-title">{{ $attrName }}:</span>
                    <span>{{ $attrValue }}</span>
                </div>
                @endforeach

                <div class="share-box detail-info-entry">
                    <div class="title">Поделиться в соц. сетях:</div>
                    <div class="clear"></div>
                    <div class="ya-share2" data-services="vkontakte,facebook,viber,whatsapp,telegram"></div>
                </div>
            </div>
        </div>

        <div class="clear visible-xs visible-sm"></div>

        <div class="col-md-4 col-lg-3 information-entry product-sidebar">
            <div class="row">
                <div class="col-md-12">
                    <div class="information-blocks production-logo">
                        <div class="background">
                            <div class="logo"><img src="/{{ $brandImage }}" alt="" /></div>
                            <a href="{{ $brandHref }}">Перейти к бренду</a>
                        </div>
                    </div>
                </div>
                @if (count($featuredItems))
                <div class="col-md-12">
                    <div class="information-blocks">
                        <div class="information-entry products-list">
                            <h3 class="block-title inline-product-column-title">Похожие товары {{--Featured products--}}</h3>

                            @foreach($featuredItems as $item)
                            <div class="inline-product-entry">
                                <a href="{{ $item->getHref() }}" class="image">
                                    <img alt="{{ $item->name }}" src="/{{ $item->images[0] }}"></a>
                                <div class="content">
                                    <div class="cell-view">
                                        <a href="{{ $item->getHref() }}" class="title">{{ $item->name }}</a>
                                        <div class="price">
                                            <div class="current">{{ $item->getPriceString() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection