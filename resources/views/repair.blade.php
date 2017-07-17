@extends('layouts.front')

@section('title')
    @lang('site.title_repair')
@endsection

@section('content')
{{--<div class="breadcrumb-box">--}}
    {{--<a href="/">Главная</a>--}}
    {{--<a>Ремонт часов</a>--}}
{{--</div>--}}

<div class="information-blocks repair-block">
    <div class="row">
        <div class="col-md-9 col-md-push-3 information-entry">
            <div class="blog-landing-box type-1 detail-post">
                <div class="blog-entry">
                    <div class="image"><img src="/img/repair.jpg" alt="" /></div>
                    <div class="content">
                        <h1 class="title">@lang('site.repair_title1')</h1>
                        <div class="article-container style-1">@lang('site.repair_text1')</div>
                    </div>
                </div>
                <div class="blog-entry">
                    <h3 class="additional-blog-title">@lang('site.repair_title2')</h3>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/apply.png" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage1')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/waterproof.png" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage2')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/bill.jpg" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage3')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/diagnostic.jpg" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage4')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/wash.png" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage5')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/remont.jpg" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage6')</div>
                    </div>

                    <div class="comment">
                        <span class="comment-image"><img src="/img/repair/sborka.jpg" alt="" /></span>
                        <div class="comment-content">@lang('site.repair_stage7')</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-md-pull-9 information-entry blog-sidebar">
            <div class="information-blocks">
                <div class="categories-list">
                    <div class="block-title size-3">@lang('site.repair_title3')</div>
                </div>
            </div>
            <div class="information-blocks">
                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/swiss.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service1')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/obsluzhivanie.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service2')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/battery.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service3')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/germ.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service4')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/polish.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service5')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/glass.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service6')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/strap.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service7')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/rodium.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service8')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/balance.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service9')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/tourbillon.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service10')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/repeater.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service11')</div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/repair/swiss_made.png" alt=""></span>
                    <div class="content">
                        <div class="cell-view">@lang('site.repair_service12')</div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('parts.featured-products')
@endsection