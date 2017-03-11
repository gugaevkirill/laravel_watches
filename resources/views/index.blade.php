@extends('layouts.front')

@section('content')
<div class="information-blocks">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar-navigation">
                <div class="title">Бренды<i class="fa fa-angle-down"></i></div>
                <div class="list">
                    @foreach($brands as $brand)
                    <a class="entry" href="/watches/?brands[]={{ $brand->slug }}"><span><i class="fa fa-angle-right"></i>{{ $brand->name }}</span></a>
                    @endforeach
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-md-9">
            <div class="navigation-banner-swiper">
                <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        @for($i = 0; $i < 3; $i++)
                        <div class="swiper-slide active" data-val="0">
                            <div class="navigation-banner-wrapper light-text align-1" style="background-image: url(img/old/jewellery-1.jpg);">
                                <div class="navigation-banner-content">
                                    <div class="cell-view">
                                        <h2 class="subtitle">Слайдер из баннеров</h2>
                                        <h1 class="title">Слайдер</h1>
                                        <div class="description">Нужно выбрать содержимое этих трех слайдов</div>
                                        <div class="info">
                                            <a class="button style-1" href="#">В каталог</a>
                                            <a class="button style-1" href="#">Товар</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        @endfor
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
            <div class="title">Новинки</div>
            <div class="list">
                <a class="block-title tab-switcher active">Швейцарские часы</a>
                <a class="block-title tab-switcher">Ювелирные изделия</a>
                <a class="block-title tab-switcher">Аксессуары</a>
                <div class="clear"></div>
            </div>
        </div>
        <div>
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($watches as $item)
                                @include('parts.product-card')
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($jewelry as $item)
                                @include('parts.product-card')
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($accessories as $item)
                                @include('parts.product-card')
                            @endforeach
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="information-blocks">
    <div class="row">
        <div class="information-entry col-md-6">
            <div class="sale-entry sale-entry-border" style="background: #333;">
                <div class="sale-price"><i class="fa fa-3x fa-credit-card" style="
    padding: 20px;
    color: white;
"></i></div>
                <div class="sale-title">Деньги в день обращения</div>
                <div class="sale-description">Текст про выкуп часов в день обращения по хорошей цене.</div>
            </div>
        </div>
        <div class="information-entry col-md-6">
            <div class="sale-entry sale-entry-border" style="background: #337ab7;">
                <div class="sale-price" style="
    color: white;
"><i class="fa fa-3x fa-check" style="
    padding: 20px;
"></i></div>
                <div class="sale-title">Только оригинальные часы</div>
                <div class="sale-description">Очень мотивирующий к покупке текст про нас. Для SEO-продвижения полезно.</div>
            </div>
        </div>
    </div>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Текст о нас 1</h3>
            <div class="from-the-blog-entry">
                <a href="#" class="image hover-class-1"><img src="img/old/from-the-blog-thumbnail.jpg" alt=""><span class="hover-label">Read More</span></a>
                <div class="description">Seo-текст о нас и про наши услуги. Можно рассказать про что-то одно, например, ремонт, или про компению в целом. Желательно еще картинку поставить. Должно быть много буковок, чтобы занять больше места. Примерно столько же, сколько напечанано сейчас.</div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Текст о нас 2</h3>
            <ol class="list-type-2">
                <li>Наше первное преимущество. Самое основательное и внушительное.</li>
                <li>Второе преимущество. Т.к. второе, то люди меньше обращают на него внимание.</li>
                <li>Наше последнее и не менее убойное, чем первое преи.</li>
            </ol>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Отзывы</h3>
            <div class="swiper-container blockquote-slider" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">Отзыв покупателя. Афигеть, какой крутой ломбард, цены - улет, гарантии, оригинальные часы. Тут вообще говоря не обязательно писать отзывы, можно описать услуги.</div>
                            <footer><cite>Тестовый покупаль</cite>, дата отзыва</footer>
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">Отзыв покупателя. Афигеть, какой крутой ломбард, цены - улет, гарантии, оригинальные часы. Тут вообще говоря не обязательно писать отзывы, можно описать услуги.</div>
                            <footer><cite>Тестовый покупаль</cite>, дата отзыва</footer>
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">Отзыв покупателя. Афигеть, какой крутой ломбард, цены - улет, гарантии, оригинальные часы. Тут вообще говоря не обязательно писать отзывы, можно описать услуги.</div>
                            <footer><cite>Тестовый покупаль</cite>, дата отзыва</footer>
                        </blockquote>
                    </div>
                </div>
                <div class="pagination"></div>
            </div>
        </div>
    </div>
</div>

@include('parts.featured-products')
@endsection
