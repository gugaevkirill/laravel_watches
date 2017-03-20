<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

    <link rel="shortcut icon" href="/img/favicon-2.ico" />

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <!--[if IE 9]>
    <link href="/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    @stack('styles')

    <title>@chunk('title')</title>
</head>
<body class="style-3">

<div id="content-block">
    <div class="content-center fixed-header-margin">
        {{-- HEADER --}}
        <div class="header-wrapper style-3">
            <header class="type-1">
                <div class="header-top">
                    <div class="header-top-entry">
                        <div class="title"><img src="/img/flag-lang-1.png" alt="" />Русский<i class="fa fa-caret-down"></i></div>
                        <div class="list">
                            <a href="http://luxurybazaar.biz/" class="list-entry"><img src="/img/flag-lang-1.png" alt="" />English</a>
                        </div>
                    </div>
                    <div class="header-top-entry hidden-xs">
                        <div class="title"><i class="fa fa-phone"></i>Остались вопросы? Свяжитесь с нами <a href="@chunk('phone1href')"><b>@chunk('phone1')</b></a></div>
                    </div>
                    <div class="socials-box">
                        @chunk('social-box')
                    </div>
                    <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                    <div class="clear"></div>
                </div>

                <div class="header-middle">
                    <div class="logo-wrapper">
                        <a id="logo" href="/"><img src="/img/logo1-blue.png" alt="" /></a>
                    </div>

                    <div class="middle-entry">
                        <a class="icon-entry" href="@chunk('phone1href')">
                            <span class="image">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="text">
                                <b>@chunk('phone1')</b> <br/> Контактный телефон
                            </span>
                        </a>
                        <a class="icon-entry" href="@chunk('phone2href')">
                            <span class="image">
                                <i class="fa fa-whatsapp"></i>
                            </span>
                            <span class="text">
                                <b>@chunk('phone2')</b> <br/> WhatsApp, Viber, Telegramm
                            </span>
                        </a>
                    </div>

                    <div class="right-entries">
                        <a class="header-functionality-entry" href="/sell/"><b><i class="fa fa-envelope-o"></i>Онлайн оценка</b></a>
                    </div>

                </div>

                <div class="close-header-layer"></div>
                <div class="navigation">
                    <div class="navigation-header responsive-menu-toggle-class">
                        <div class="title">Меню</div>
                        <div class="close-menu"></div>
                    </div>
                    <div class="nav-overflow">
                        <nav>
                            <ul>
                                <li><a href="/watches/">Часы</a></li>
                                <li><a href="/jewelry/">Украшения</a></li>
                                <li><a href="/accessories/">Аксессуары</a></li>
                                <li><a href="/repair/">Ремонт</a></li>
                                <li><a href="/sell/">Продать часы</a></li>
                                <li><a href="/about/">О нас</a></li>
                                <li><a href="/contacts/">Контакты</a></li>
                            </ul>

                            <div class="clear"></div>

                            <a class="fixed-header-visible additional-header-logo"><img src="/img/logo1-white.png"/></a>
                        </nav>
                        <div class="navigation-footer responsive-menu-toggle-class">
                            <div class="socials-box">
                                @chunk('social-box')
                                <div class="clear"></div>
                            </div>
                            <div class="navigation-copyright">@yield('copyright')</div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="clear"></div>
        </div>

        <div class="content-push">
            @yield('content')

            {{-- FOOTER --}}
            <div class="footer-wrapper style-3">
                <footer class="type-1">
                    <div class="footer-columns-entry">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="footer-logo" src="/img/logo1-grey.png"/>
                                <div class="footer-description">@chunk('footer-description')</div>
                                <div class="footer-address">
                                    @chunk('address')<br/>
                                    Телефон: @chunk('phone1')<br/>
                                    Онлайн-оценка: @chunk('phone2')<br/>
                                    Email: <a href="mailto:@chunk('email')">@chunk('email')</a><br/>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h3 class="column-title">Магазин</h3>
                                <ul class="column">
                                    <li><a href="/watches/">Швейцарские часы</a></li>
                                    <li><a href="/jewelry/">Ювелирные изделия</a></li>
                                    <li><a href="/accessories/">Аксессуары</a></li>
                                    <li><a href="/about/">О нас</a></li>
                                    <li><a href="/contacts/">Контакты</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h3 class="column-title">Услуги</h3>
                                <ul class="column">
                                    <li><a href="/sell/">Скупка часов</a></li>
                                    <li><a href="/repair/">Ремонт часов</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-3">
                                <h3 class="column-title">Контактная информация</h3>
                                <div class="footer-description">@chunk('address')</div>
                                <div class="footer-description">
                                    Часы работы: @chunk('working-hours')<br/>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/idangerous.swiper.min.js"></script>
<script src="/js/global.js"></script>

<!-- custom scrollbar -->
<script src="/js/jquery.mousewheel.js"></script>
<script src="/js/jquery.jscrollpane.min.js"></script>

@stack('scripts')

</body>
</html>
