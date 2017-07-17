@extends('layouts.front')

@section('title')
    @lang('site.title_about')
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
                            <h2>@lang('site.about_header1')</h2>
                            <p style="font-size:16px;color:#929292;">@lang('site.about_subtext1')</p>
                            @lang('site.about_text1')
                            {{--<a class="continue-link" href="">Прайс-лист <i class="fa fa-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-6 information-entry">
                        <h3 class="block-title">@lang('site.about_header2')</h3>
                        @lang('site.about_text2')

                        <div class="accordeon">
                            @lang('site.about_qa')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 information-entry blog-sidebar">
            <div class="information-blocks">
                <div class="categories-list">
                    <h3 class="block-title size-3">@lang('site.about_header3')</h3>
                    <ul>
                        @foreach($brands as $brand)
                        <li><a href="/watches/?brand={{ $brand->slug }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title">@lang('site.about_header4')</h3>
                <div class="text-widget">
                    <div class="description">@lang('site.about_text4')</div>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">@lang('site.about_header5')</h3>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-1.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.about_benefit1')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-2.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.about_benefit2')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/about/about-3.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.about_benefit3')</div>
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection