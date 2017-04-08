@extends('layouts.front')

@push('scripts')
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
<script src="/js/map.js"></script>
@endpush

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>Контакты</a>
</div>

<div class="information-blocks">
    <div class="map-box type-2">
        <div id="map-canvas" data-lat="@chunk('map-lat')" data-lng="@chunk('map-lng')" data-zoom="17"></div>
        <div class="addresses-block">
            <a data-lat="@chunk('map-lat')" data-lng="@chunk('map-lng')" data-string="Офис EliteBazaar"></a>
        </div>
    </div>
    <div class="map-overlay-info">
        <div class="article-container style-1">
            <div class="cell-view">
                <h5>Телефон</h5>
                <p><a href="@chunk('phone1href')">@chunk('phone1')</a></p>
                <h5>Адрес</h5>
                <p>@chunk('address')</p>
                <h5>Часы работы</h5>
                <p>@chunk('working-hours')</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <div class="row">
        <div class="col-md-8 information-entry">
            <h3 class="block-title main-heading">Свяжитесь с нами</h3>
            {{ Form::open(array('route' => 'contacts.process')) }}
            <div class="row">
                <div class="col-sm-6">
                    <label>Ваше имя <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="Как к вам обращаться" name="name" required />
                    <div class="clear"></div>
                </div>
                <div class="col-sm-6">
                    <label>Контактные данные <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="Телефон / E-mail" name="contact" required />
                    <div class="clear"></div>
                </div>
                <div class="col-sm-12">
                    <label>Опишите проблему <span>*</span></label>
                    <textarea class="simple-field" placeholder="Оставьте небольшой комментарй" name="message" required></textarea>

                    @foreach ($errors->all() as $error)
                    <label class="text-danger">{{ $error }}</label>
                    @endforeach

                    @if ($success)
                    <label class="text-success">Сообщение отправлено!</label>
                    @endif

                    <div class="button style-10">Отправить<input type="submit" value="" /></div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title main-heading">Выгодные условия и оперативность</h3>
            <div class="article-container style-1">
                <p>Ломбард Elite Bazaar предлагает клиентам полный спектр операций покупки-продажи элитных швейцарских часов, а также аксессуаров к ним и украшений. На протяжении многих лет работы нами выработан безупречный алгоритм взаимовыгодного сотрудничества с многочисленными клиентами.</p>
                <p>Профессиональные эксперты быстро дадут заключение о происхождении и состоянии часов, после чего озвучат их честную стоимость. Бумажная волокита сведена к минимуму, а клиенту достаточно паспорта для совершения любой сделки.</p>
            </div>
            <div class="share-box detail-info-entry">
                <div class="title">Мы в соц. сетях</div>
                <div class="socials-box">
                    @chunk('social-box')
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
@endsection