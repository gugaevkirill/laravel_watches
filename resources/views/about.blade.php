@extends('layouts.front')

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>О нас</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 information-entry">
            <div class="information-blocks">
                <img class="project-thumbnail" src="/img/about/about-bg.jpg" alt="" />
                <div class="row">
                    <div class="col-md-6 information-entry">
                        <div class="article-container">
                            <h2>Кто мы?</h2>
                            <p style="font-size:16px;color:#929292;">
                                «Репетир» является узнаваемым брендом на рынке швейцарских часов в Москве. За пять лет работы мы доказали свою квалификацию в продаже оригиналов швейцарских часов. И снискали репутацию надежного партнера в скупке часов, дающий честную цену за изделия наших клиентов.
                            </p>

                            <p>У нас Вы найдете только оригинальные швейцарские часы самых известных и статусных мировых брендов, таких как Patek Philippe, Audemars Piguet, Rolex и многих других. Ознакомиться с полным списком Вы можете в нашем каталоге швейцарских часов.</p>

                            <p> Так же Вы можете купить часы б у в нашем магазине, что позволит экономить деньги и приобрести оригинальное изделие швейцарских мастеров по цене ниже ритейла, сохранив при этом все гарантии надежности.</p>

                            <p> Мы так же продаем аксессуары и если Вы ищите где купить ремешки для швейцарских часов, то магазин Shoprepetir может Вам в этом помочь. Для Вас мы подобрали ассортимент ремешков из кожи, металла, с различными типами застежек, а так же запасные части для них.

                            </p>
                            {{--<a class="continue-link" href="">Прайс-лист <i class="fa fa-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-6 information-entry">
                        <h3 class="block-title">Наши преимущества</h3>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Покупка часов со значительной скидкой</h5>
                            <p>Согласитесь, это особенно приятно, учитывая ценовую политику большинства московских магазинов: дилеры завышают фактическую стоимость на 25-30%, что при средней стоимости в 10000-15000$ составляет значительную сумму.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Высококлассный сервис</h5>
                            <p>Приходя к нам или обращаясь по телефону, вы встретите приветливый персонал, который ответит на все ваши вопросы и подробно разъяснит принципы нашей работы: как приобрести часы или реализовать их через наш комиссионный магазин.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Скорость</h5>
                            <p>Мы ценим время наших клиентов, понимая, что большинство из вас — занятые люди, занимающие серьёзные должности. Поэтому мы максимально сокращаем сроки оформления документов по любым услугам компании. Вы можете очень быстро купить украшения, аксессуары и часы или продать их, не беспокоясь об оформлении лишней документации.</p>
                        </div>


                        <div class="accordeon">
                            <div class="accordeon-title active">Возможна ли продажа из других городов? <span class="inline-label red">важно</span></div>
                            <div class="accordeon-entry" style="display: block;">
                                <div class="article-container style-1">
                                    <p>Да, мы такие крутые, что приедем к вам и купим </p>
                                </div>
                            </div>
                            <div class="accordeon-title">Выдаете залог?</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Не, нифига. </p>
                                </div>
                            </div>
                            <div class="accordeon-title">Покупаете винтаж и раритентые часы?</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Да, это вообще огонь! </p>
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
                        <li><a href="/watches/?brands[]={{ $brand->slug }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title">SEO - текстик</h3>
                <div class="text-widget">
                    <div class="description">Часовой ломбард «Хронограф» предоставляет весь спектр услуг, связанных с покупкой, продажей элитных швейцарских часов. Обратившись к нам, вы сможете быстро получить крупную сумму денег или купить элитные швейцарские часы на выгодных условиях. </div>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">С НАМИ ПРИЯТНО И ВЫГОДНО РАБОТАТЬ:</h3>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-1.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Заголовок</span>
                            <div class="description">принимаем любые марки швейцарских часов вне зависимости от их стоимости;</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-2.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Заголовок</span>
                            <div class="description">все финансовые операции максимально прозрачны для клиентов;</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-3.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Заголовок</span>
                            <div class="description">высокий уровень обслуживания позволяют совершать уникальные сделки, выгодные для всех сторон.
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