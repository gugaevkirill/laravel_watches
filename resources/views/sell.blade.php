@extends('layouts.front')

@section('content')
<div class="navigation-banner-swiper">
    <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
        <div class="swiper-wrapper">
            <div class="swiper-slide active" data-val="0">
                <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/old//mini-1.jpg); background-position: center center;">
                    <div class="navigation-banner-content">
                        <div class="cell-view">
                            <h2 class="subtitle">new special collection</h2>
                            <h1 class="title">Minimal Collection</h1>
                            <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="swiper-slide" data-val="1">
                <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/old//mini-2.jpg); background-position: center center;">
                    <div class="navigation-banner-content">
                        <div class="cell-view">
                            <h2 class="subtitle">new special collection</h2>
                            <h1 class="title">Minimal Collection</h1>
                            <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</div>
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

<div class="mozaic-banners-wrapper type-2">
    <div class="row">
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/old//mini-3.jpg); background-size: cover; background-position: right top;" class="mozaic-banner-entry type-3">
                    <span class="mozaic-banner-content">
                        <span class="subtitle">New Collection</span>
                        <span class="title">For Him</span>
                        <span class="view">read more</span>
                    </span>
            </a>
        </div>
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/old//mini-4.jpg); background-size: cover; background-position: right top;" class="mozaic-banner-entry type-3">
                    <span class="mozaic-banner-content">
                        <span class="subtitle">New Collection</span>
                        <span class="title">For Her</span>
                        <span class="view">read more</span>
                    </span>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="hidden-sm hidden-xs" style="height: 30px;"></div>

<div class="column-article-wrapper">
    <div class="row nopadding">
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">About Store</a>
                <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                <a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Company Blog</a>
                <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                <a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Coming Events</a>
                <div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                <a class="read-more">Read more <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection