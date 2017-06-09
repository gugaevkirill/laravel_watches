@extends('layouts.front')

@section('content')
<div class="information-blocks">
    <div class="row">
        <div class="col-md-3 p-a-0">
            <div class="sidebar-navigation">
                <div class="title">Бренды<i class="fa fa-angle-down"></i></div>
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
                                        <div class="description">Часы класса «Люкс»</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=patek_philippe">В каталог</a>
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
                                        <div class="description">Шедевры часового искусства</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=audemars_piguet">В каталог</a>
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
                                        {{--<h2 class="subtitle">Слайдер из баннеров</h2>--}}
                                        <h1 class="title">ROLEX</h1>
                                        <div class="description">Новый уровень совершенства</div>
                                        <div class="info">
                                            <a class="button style-1" href="/watches/?brand=rolex">В каталог</a>
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
            <div class="title">Новинки</div>
            <div class="list">
                <a class="block-title tab-switcher active">Швейцарские часы</a>
                <a class="block-title tab-switcher">Элитные товары</a>
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
                            @foreach($luxury as $item)
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
        <div class="information-entry col-md-6 p-a-0">
            <div class="sale-entry sale-entry-border main-banner1">
                <div class="sale-price"><i class="fa fa-3x fa-check" style="
    padding: 20px;
    color: white;
"></i></div>
                <div class="sale-title">Лучшая цена</div>
                <div class="sale-description">Как при покупке, так и при продаже.</div>
            </div>
        </div>
        <div class="information-entry col-md-6 p-a-0">
            <div class="sale-entry sale-entry-border main-banner2">
                <div class="sale-price" style="color: white;"><i class="fa fa-3x fa-credit-card" style="padding: 20px;"></i></div>
                <div class="sale-title">Быстрые выплаты</div>
                <div class="sale-description">Вы получите деньги в тот же день, когда обратитесь к нам.</div>
            </div>
        </div>
    </div>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Кто мы такие?</h3>
            <div class="from-the-blog-entry">
                <span class="image"><img src="/img/main/main-1.jpg" alt=""></span>
                <div class="description">Компания Elite Bazaar представляет собой проверенный временем ломбард, где можно выгодно продать часы. Мужские или женские – не имеет значения. Доверие многочисленных клиентов подтверждает высокий уровень и безупречную репутацию заведения. Независимо от состояния часов, которые у вас имеются, вы можете быть стопроцентно уверены, что Elite Bazaar предложит лучшую цену.</div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Как продать часы</h3>
            <ol class="list-type-2">
                <li><b>Оценка</b> Прямо при вас эксперт оценивает состояние часов и озвучивает их точную стоимость.</li>
                <li><b>Оформление документов</b> Сделка оформляется юристом. От вас потребуется лишь паспорт.</li>
                <li><b>Выплата суммы</b> Оценочная стоимость часов выплачивается клиенту. Все банкноты проходят проверку на подлинность. </li>
            </ol>
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title">Отзывы</h3>
            <div class="swiper-container blockquote-slider" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">Неожиданно хороший сервис. Думал, придется отдать хорошую вещь за копейки, но здесь предложили действительно хорошую цену! Спасибо вам и успехов в бизнесе!</div>
                            <footer class="roboto"><cite>Алексей Ягофаров</cite>, 10.01.2016</footer>
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">Пришлось продать любимые часы, так как напряженка с деньгами. Все корректно и вежливо, никаких проблем. Деньги получила в течение получаса, спасибо!</div>
                            <footer class="roboto"><cite>Дарья Осипова</cite>, 18.07.2016</footer>
                        </blockquote>
                    </div>
                    <div class="swiper-slide">
                        <blockquote class="latest-review">
                            <div class="text">В других ломбардах за мой Ролекс давали, как за китайскую подделку, курам на смех! Здесь предложили адекватную цену и выплатили быстро. Буду рекомендовать знакомым.</div>
                            <footer class="roboto"><cite>Андрей Кишин</cite>, 12.02.2017</footer>
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
