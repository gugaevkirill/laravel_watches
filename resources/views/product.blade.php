@extends('layouts.front')

@section('title')
    {{ $productName }}
@endsection

@push('scripts')
<link rel="stylesheet" href="/css/photoswipe.css">
<link rel="stylesheet" href="/css/photoswipe-default-skin/default-skin.css">
@endpush

@push('scripts')
<script src="/js/libs/photoswipe.min.js"></script>
<script src="/js/libs/photoswipe-ui-default.min.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-594a0788009cfcb0"></script>
@endpush

@section('content')
{{--<div class="breadcrumb-box">--}}
    {{--<a href="/">Главная</a>--}}
    {{--<a>{{ $categoryName }}</a>--}}
{{--</div>--}}

<div class="information-blocks m-t-30">
    <div class="row">
        <div class="col-sm-5 col-md-4 col-lg-3 information-entry">
            <div class="product-preview-box">
                <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        @foreach ($productImages as $productImage)
                        <div class="swiper-slide" data-fullurl="{{ $productImage }}">
                            <div class="product-zoom-image">
                                <img src="{{ $productImage }}" alt="{{ $productName }}"/>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination"></div>
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
                                    <img src="{{ $productImage }}" alt="{{ $productName }}" />
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
        <div class="col-sm-7 col-md-4 col-lg-6 information-entry">
            <div class="product-detail-box">
                <h1 class="product-title roboto">{{ $productName }}</h1>
                <h3 class="product-subtitle">{{ $brandName }}</h3>

                <div class="price detail-info-entry roboto">
                    @if ($productIsReserved)
                    <div class="button style-10 reserved-button">
                        В резерве
                    </div>
                    @else
                    <div class="current">{{ $productPrice }}</div>
                    @endif

                    <div class="clear"></div>
                </div>

                @foreach ($productAttrs as $attrName => $attrValue)
                <div class="detail-info-entry">
                    <span class="detail-info-entry-title">{{ $attrName }}:</span>
                    <span>{{ $attrValue }}</span>
                </div>
                @endforeach

                <div class="share-box detail-info-entry">
                    <div class="title">@lang('site.social_share'):</div>
                    <div class="clear"></div>
                    <div class="addthis_inline_share_toolbox"></div>
                </div>
            </div>
        </div>

        <div class="clear visible-xs visible-sm"></div>

        <div class="col-md-4 col-lg-3 information-entry product-sidebar">
            <div class="row">
                <div class="col-md-12">
                    <div class="information-blocks production-logo">
                        <div class="background">
                            <div class="logo"><img src="{{ $brandImage }}" alt="" /></div>
                            <a href="{{ $brandHref }}">@lang('site.catalog_gotobrand')</a>
                        </div>
                    </div>
                </div>
                @if (count($featuredItems))
                <div class="col-md-12">
                    <div class="information-blocks">
                        <div class="information-entry products-list">
                            <h3 class="block-title inline-product-column-title">@lang('site.catalog_similars')</h3>

                            @foreach($featuredItems as $item)
                            <div class="inline-product-entry">
                                <a href="{{ $item->getHref() }}" class="image">
                                    <img alt="{{ $item->name }}" src="{{ $item->getFirstImageUrl() }}"></a>
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


<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
@endsection