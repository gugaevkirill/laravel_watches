@extends('layouts.front')

@section('title')
    @lang('site.title_sell')
@endsection

@section('content')
<div class="navigation-banner-swiper" style="margin-bottom: 0;">
    <div class="swiper-slide active">
        <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/sell/1200x500.jpg); background-position: center center;">
            <div class="navigation-banner-content">
                <div class="cell-view">
                    <h2 class="subtitle"></h2>
                    <h1 class="title">@lang('site.sell_bannertitle')</h1>
                    <div class="description">@lang('site.sell_bannertext')</div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="column-article-wrapper">
    <div class="row nopadding">
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <span class="title roboto">@lang('site.sell_benefittitle1')</span>
                <div class="description">@lang('site.sell_benefittext1')</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <span class="title roboto">@lang('site.sell_benefittitle2')</span>
                <div class="description">@lang('site.sell_benefittext2')</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <span class="title roboto">@lang('site.sell_benefittitle3')</span>
                <div class="description">@lang('site.sell_benefittext3')</div>
            </div>
        </div>
    </div>
</div>

<div class="mozaic-banners-wrapper type-2">
    <div class="row">
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_2.jpg); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">@lang('site.sell_card1')</span>
            </a>
        </div>
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_3.jpg); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">@lang('site.sell_card2')</span>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="information-blocks" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-8 information-entry">
            <h3 class="block-title main-heading">@lang('site.sell_button')</h3>
            {{ Form::open(array('route' => 'sell.process', 'files' => true)) }}
            <div class="row">
                <div class="col-sm-6">
                    <label>@lang('site.contacts_name') <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="@lang('site.contacts_nameplaceholder')" name="name" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>@lang('site.system_photo') <span>*</span></label>
                    <input class="simple-field" type="file" name="imagenew" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>@lang('site.system_phone') <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="@lang('site.form_phoneplaceholder')" name="phone" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>E-mail</label>
                    <input class="simple-field" type="email" placeholder="example@mail.ru" name="email" />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Ref. No <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="" name="reference" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>@lang('site.form_year')</label>
                    <input class="simple-field" type="number" name="year" />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>@lang('site.form_price')</label>
                    <input class="simple-field" type="number" name="amount" />
                    <div class="clear"></div>
                </div>

                <label class="col-sm-6 checkbox-entry">
                    {{ Form::checkbox('has_box') }} <span class="check"></span> @lang('site.form_withbox')
                </label>

                <label class="col-sm-6 checkbox-entry">
                    {{ Form::checkbox('has_documents') }} <span class="check"></span> @lang('site.form_withdoc')
                </label>

                <div class="col-sm-12">
                    @foreach ($errors->all() as $error)
                        <label class="text-danger">{{ $error }}</label>
                    @endforeach

                    @if ($success)
                        <label class="text-success">@lang('site.form_sent')</label>
                    @endif

                    <div class="button style-10 sell-button">@lang('site.system_sent')<input type="submit" value="" /></div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="p-t-30 p-b-30 hidden-xs-up display-block"></div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title main-heading">@lang('site.sell_title4')</h3>
            <div class="article-container style-1">@lang('site.sell_text4')</div>
        </div>
    </div>
</div>
@endsection