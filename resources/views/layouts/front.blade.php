<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>


    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/manifest.json">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">


    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

    <link href="/css/style_2.css" rel="stylesheet" type="text/css" />
    <!--[if IE 9]>
    <link href="/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    <meta name="yandex-verification" content="7d31fe5986c87c0d" />

    @stack('styles')
    @stack('headOther')

    <title>@yield('title', __('site.title_default'))</title>
</head>

<body class="style-3">

<div id="content-block">
    <div class="content-center fixed-header-margin">
        {{-- HEADER --}}
        <div class="header-wrapper style-15">
            <header class="type-1">
                <div class="header-top">
                    <div class="nav-overflow">
                        <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>
                        <nav class="hidden-xs">
                            @include('parts.menu-submenu')
                            <div class="clear"></div>
                        </nav>

                        <a href="/"><img class="nav-logo" src="/img/logo_xss.png"></a>

                        <div class="header-top-entry">
                            @foreach ($locales as $locale)
                                @if ($loop->iteration == 1)
                                    <div class="title">
                                        <img src="/img/flags/4x3/{{ $locale['code'] }}.svg" alt="{{ $locale['name'] }}"/>
                                        {{ $locale['name'] }}
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                @else
                                    <div class="list">
                                        <a href="{{ $locale['url'] }}" class="list-entry">
                                            <img src="/img/flags/4x3/{{ $locale['code'] }}.svg" alt="{{ $locale['name'] }}" />
                                            {{ $locale['name'] }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="header-middle text-center">
                    <div class="middle-entry text-left">
                        <span class="icon-entry">
                            <span class="image">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="text roboto">
                                <a href="@chunk('phone1href')"><b>@chunk('phone1')</b></a>&nbsp;&nbsp;
                                <a class="popup-trigger" href="/contacts/#call-us">@lang('site.head_call_me')</a>
                            </span>
                        </span>
                        @include('parts.menu-phones-social', ['showPhone2' => 'true'])
                    </div>

                    <div class="logo-wrapper">
                        <a id="logo" href="/"><img src="/img/logo-white.png" alt="" /></a>
                    </div>

                    <div class="right-entries">
                        @if (isset($isSellPage))
                        <a class="header-functionality-entry" href="/contacts/">
                            <i class="fa fa-envelope-o"></i>
                            <span>@lang('site.system_contacts')</span>
                        </a>
                        @else
                        <a class="header-functionality-entry" href="/sell/">
                            <i class="fa fa-envelope-o"></i>
                            <span>@lang('site.system_onlinerequest')</span>
                        </a>
                        @endif

                        @include('parts.currency-picker', ['class' => 'hidden-xs-down'])
                    </div>
                </div>

                <div class="close-header-layer"></div>
                <div class="navigation">
                    <div class="navigation-header responsive-menu-toggle-class">
                        <div class="title">@lang('site.head_menu')</div>
                    </div>
                    <nav>
                        <a class="close-menu hidden-xs-up">&#10005;</a>

                        @include('parts.currency-picker', ['class' => 'hidden-xs-up'])

                        <ul class="georgia pull-none main-menu">
                            @foreach ($categories as $category)
                            <li><a href="/{{ $category['slug'] }}/">{{ $category['name'] }}</a></li>
                            @endforeach
                        </ul>

                        @include('parts.menu-submenu')

                        <div class="hidden-xs-up mobile-contacts">
                            <a href="mailto:@chunk('email')" class="email">@chunk('email')</a>
                            <a class="phone">@chunk('phone1')</a>
                            <a class="phone">@chunk('phone2')</a>
                            @include('parts.menu-phones-social')
                        </div>

                        <div class="clear"></div>
                    </nav>
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
                            <div class="col-md-3 col-sm-5">
                                <a href="/"><img class="footer-logo" src="/img/logo1-grey.png" style="margin-bottom: 15px;"/></a>
                                <div class="footer-description">@chunk('footer-description')</div>
                                <div class="footer-address roboto">
                                    @chunk('address')<br/>
                                    @lang('site.system_phone'): @chunk('phone1')<br/>
                                    @lang('site.system_onlinerequest'): @chunk('phone2')<br/>
                                    Email: <a href="mailto:@chunk('email')">@chunk('email')</a><br/>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h3 class="column-title">@lang('site.system_shop')</h3>
                                <ul class="column">
                                    @foreach ($categories as $category)
                                        <li><a href="/{{ $category['slug'] }}/">{{ $category['name'] }}</a></li>
                                    @endforeach
                                    <li><a href="/about/">@lang('site.menu_about')</a></li>
                                    <li><a href="/contacts/">@lang('site.system_contacts')</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h3 class="column-title">@lang('site.system_services')</h3>
                                <ul class="column">
                                    <li><a href="/sell/">@lang('site.footer_sell')</a></li>
                                    <li><a href="/repair/">@lang('site.footer_repair')</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-3">
                                <h3 class="column-title">@lang('site.footer_contacts')</h3>
                                <div class="footer-description roboto">@chunk('address')</div>
                                <div class="footer-description roboto">
                                    @lang('site.system_workhours'): @chunk('working-hours')<br/>
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

<script src="/js/libs/jquery-2.1.3.min.js"></script>
<script src="/js/libs/idangerous.swiper.min.js"></script>
<script src="/js/site/global_2.js"></script>

{{-- custom scrollbar --}}
<script src="/js/libs/jquery.mousewheel.js"></script>
<script src="/js/libs/jquery.jscrollpane.min.js"></script>

@stack('scripts')

{{-- Yandex.Metrika counter --}}
<script type="text/javascript">
    (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter44775544 = new Ya.Metrika({ id:44775544, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/44775544" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
{{-- Yandex.Metrika counter --}}

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-99992149-1', 'auto');
    ga('send', 'pageview');
</script>

</body>
</html>
