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
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($jewelry as $item)
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
            <div class="tabs-entry">
                <div class="products-swiper">
                    <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                        <div class="swiper-wrapper">
                            @foreach($accessories as $item)
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
        </div>
    </div>
</div>


<div class="information-blocks">
    <div class="row">
        <div class="information-entry col-md-6">
            <div class="sale-entry sale-entry-border" style="background: #333;">
                <div class="sale-price"><i class="fa fa-3x fa-check" style="
    padding: 20px;
    color: white;
"></i></div>
                <div class="sale-title">Выгодное предложение</div>
                <div class="sale-description">И по скупке, и по продаже.</div>
            </div>
        </div>
        <div class="information-entry col-md-6">
            <div class="sale-entry sale-entry-border" style="background: #337ab7;">
                <div class="sale-price" style="
    color: white;
"><i class="fa fa-3x fa-credit-card" style="
    padding: 20px;
"></i></div>
                <div class="sale-title">Деньги в день обращения</div>
                <div class="sale-description">Когда вы приносите мы оцениваем и платим в тот же день.</div>
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
                <div class="description">«Перспектива» — известный Московский ломбард часов. Мы работаем достаточно продолжительное время и создали себе безупречную репутацию. «Перспектива» пользуется заслуженным авторитетом и доверием наших клиентов. Если Вы намерены осуществить продажу мужских или женских часов любых известных элитных марок, наш ломбард поможет Вам независимо от того, новые они или нет.</div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Как продать часы</h3>
            <ol class="list-type-2">
                <li><b>Осмотр</b> Эксперты проводят осмотр часов и определяют их стоимость в Вашем присутствии</li>
                <li><b>Оформление документов</b> Юрист оформляет необходимые документы. Вам достаточно иметь при себе только паспорт.</li>
                <li><b>Выдача наличных</b> Проверяем банкноты на банковском оборудовании. Выплачиваем наличными стоимость изделия. </li>
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
