@extends('layouts.front')

@section('title')
    EliteBazaar - О нас. Ломбард и часовая мастерская в москве. Продажа и ремонт швейцарских часов.
@endsection

@section('content')
{{--<div class="breadcrumb-box">--}}
    {{--<a href="/">Главная</a>--}}
    {{--<a>О нас</a>--}}
{{--</div>--}}

<div class="information-blocks m-t-30">
    <div class="row">
        <div class="col-md-9 information-entry">
            <div class="information-blocks">
                <img class="project-thumbnail" src="/img/about/about-bg.jpg" alt="" />
                <div class="row">
                    <div class="col-md-6 information-entry">
                        <div class="article-container">
                            <h2>Что такое Elite Bazaar?</h2>
                            <p style="font-size:16px;color:#929292;">Уже более 5 лет наш коллектив работает в сфере скупки-продажи элитных и винтажных швейцарских часов. Наши партнеры убедились в квалификации каждого сотрудника компании, и полностью доверяют профессионалам все типы сделок. Честная цена уже стала визитной карточкой ломбарда Elite Bazaar.</p>
                            <p>Мы предлагаем клиентам приобрести настоящие Rolex, Patek Philippe, Breitling, A.  Lange & Sohne и многие другие марки элитных брендовых часов. На сайте имеется удобный каталог, где каждый может ознакомиться с полным ассортиментом швейцарских часов, имеющихся в наличии.</p>
                            <p>У нас вы в любое время можете купить не только новые, но и б/у часы от швейцарских производителей. Такое решение позволит сэкономить бюджет, получив при этом стопроцентно качественный хронометр производства элитных мастеров.</p>
                            <p>Кроме того, Elite Bazaar предлагает клиентам широкий ассортимент аксессуаров. Если вам нужен высококачественный браслет для швейцарских часов, вы всегда найдете у нас лучшие модели из натуральной кожи и металла.</p>
                            {{--<a class="continue-link" href="">Прайс-лист <i class="fa fa-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-6 information-entry">
                        <h3 class="block-title">Почему с нами работают?</h3>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Возможность сэкономить при покупке</h5>
                            <p>Скидка делает желанную покупку еще приятнее. В отличие от большинства московских дилеров, мы не накручиваем 25-30% от стоимости, что позволяет нашим клиентам купить швейцарские часы по действительно низким ценам.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Элитный уровень сервиса</h5>
                            <p>Вы гарантированно останетесь довольны работой сотрудников компании. Вежливые консультанты всегда готовы дать любую информацию относительно покупки или продажи часов при посредничестве нашей компании.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Оперативность работы</h5>
                            <p>Мы прекрасно понимаем, что наши клиенты – серьезные люди, у которых на счету каждая минута. Именно поэтому каждый из нас делает все возможное, чтобы оформление бумаг и прочие формальности занимали как можно меньше времени. Когда вам требуется быстро продать или купить элитные украшения, швейцарские часы или аксессуары, доверить оформление документации нашим специалистам будет отличным решением.</p>
                        </div>


                        <div class="accordeon">
                            <div class="accordeon-title active">Я живу в другом городе, как продать вам часы?{{--<span class="inline-label red">важно</span>--}}</div>
                            <div class="accordeon-entry" style="display: block;">
                                <div class="article-container style-1">
                                    <p>Никаких проблем, мы готовы выехать к вам и на месте оформить сделку.</p>
                                </div>
                            </div>
                            <div class="accordeon-title">Возможна ли выдача залога?</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Нет, мы занимаемся только покупкой или продажей элитных швейцарских часов.</p>
                                </div>
                            </div>
                            <div class="accordeon-title">Интересуют ли вас винтажные или раритетные модели часов?</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Да, подобные изделия, если они оригинальны, как правило, выкупаются по высокой цене.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 information-entry blog-sidebar">
            <div class="information-blocks">
                <div class="categories-list">
                    <h3 class="block-title size-3">Оригинальные швейцарские часы</h3>
                    <ul>
                        @foreach($brands as $brand)
                        <li><a href="/watches/?brand={{ $brand->slug }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title">Elite Bazaar работает для вас</h3>
                <div class="text-widget">
                    <div class="description">Мы гарантируем справедливую оценку, высококлассный сервис и лучшие цены на элитные швейцарские часы, как при покупке, так и при продаже. Вы получите деньги или станете владельцем высококлассных часов и аксессуаров в максимально сжатые сроки.</div>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">Оправдаем ваше доверие:</h3>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-1.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Отсутствие ограничений</span>
                            <div class="description">Мы готовы купить любые швейцарские часы, независимо от ценовой категории;</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-2.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Открытость</span>
                            <div class="description">Любые операции с финансами понятны и открыты для клиентов;</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-3.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Качественный сервис</span>
                            <div class="description">Гарантируем высококлассное обслуживание и взаимную выгоду.
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection