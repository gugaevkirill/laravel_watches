@extends('layouts.front')

@section('title')
    @lang('site.title_contacts')
@endsection

@push('scripts')
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyABoeMU4atJosF8dwBb0Z5t5fHqs2dGYu4"></script>
<script src="/js/site/map.js"></script>
@endpush

@section('content')
{{--<div class="breadcrumb-box">--}}
    {{--<a href="/">Главная</a>--}}
    {{--<a>Контакты</a>--}}
{{--</div>--}}

<div class="information-blocks">
    <div class="map-box type-2">
        <div id="map-canvas" data-lat="@chunk('map-lat')" data-lng="@chunk('map-lng')" data-zoom="17"></div>
        <div class="addresses-block">
            <a data-lat="@chunk('map-lat')" data-lng="@chunk('map-lng')" data-string="@lang('site.contacts_placemark')"></a>
        </div>
    </div>
    <div class="map-overlay-info">
        <div class="article-container style-1">
            <div class="cell-view">
                <h5>@lang('site.system_phone')</h5>
                <p><a href="@chunk('phone1href')" class="roboto">@chunk('phone1')</a></p>
                <h5>@lang('site.system_address')</h5>
                <p class="roboto">@chunk('address')</p>
                <h5>@lang('site.system_workhours')</h5>
                <p class="roboto">@chunk('working-hours')</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <a name="call-us"></a>
    <div class="row">
        <div class="col-md-8 information-entry">
            <h3 class="block-title main-heading">@lang('site.contacts_contactus')</h3>
            {{ Form::open(array('route' => 'contacts.process')) }}
            <div class="row">
                <div class="col-sm-6">
                    <label>@lang('site.contacts_name') <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="@lang('site.contacts_nameplaceholder')" name="name" required />
                    <div class="clear"></div>
                </div>
                <div class="col-sm-6">
                    <label>@lang('site.contacts_data') <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="@lang('site.contacts_dataplaceholder')" name="contact" required />
                    <div class="clear"></div>
                </div>
                <div class="col-sm-12">
                    <label>@lang('site.contacts_comment') <span>*</span></label>
                    <textarea class="simple-field" placeholder="@lang('site.contacts_commentplaceholder')" name="message" required></textarea>

                    @foreach ($errors->all() as $error)
                    <label class="text-danger">{{ $error }}</label>
                    @endforeach

                    @if ($success)
                    <label class="text-success">@lang('site.contacts_messagesent')</label>
                    @endif

                    <div class="button style-10">@lang('site.system_sent')<input type="submit" value="" /></div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="p-t-30 p-b-30 hidden-xs-up display-block"></div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title main-heading">@lang('site.contacts_title')</h3>
            <div class="article-container style-1">@lang('site.contacts_text')</div>
            <div class="share-box detail-info-entry">
                <div class="title">@lang('site.social_links')</div>
                <div class="socials-box">@chunk('social-box')</div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
@endsection