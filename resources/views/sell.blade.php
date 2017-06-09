@extends('layouts.front')

@section('title')
    Скупка швейцарских часов в Москве - элитный часовой ломбард.
@endsection

@section('content')
<div class="navigation-banner-swiper" style="margin-bottom: 0;">
    <div class="swiper-slide active">
        <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/sell/1200x500.jpg); background-position: center center;">
            <div class="navigation-banner-content">
                <div class="cell-view">
                    <h2 class="subtitle"></h2>
                    <h1 class="title">Скупка часов</h1>
                    <div class="description">Узнать оценочную стоимость ваших швейцарских часов очень просто. Где бы вы ни находились, просто пришлите нам их фотографию любым удобным способом и заполните онлайн простую форму.</div>
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
                <a class="title roboto">Скупаем только оригинал</a>
                <div class="description">Мы готовы выкупить ваши часы в Москве, только если они настоящие. Специалисты компании Elite Bazaar не смогут вам помочь, если вы хотите продать китайские копии, электронные часы в пластмассовом корпусе, или изделия производства СССР.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title roboto">Честная оценка</a>
                <div class="description">Точная цена швейцарских часов озвучивается только после осмотра профессионального эксперта. Такой подход позволяет гарантировать, что клиент получит за свои винтажные или элитные часы максимальную цену.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title roboto">Бесплатная экспертиза</a>
                <div class="description">Обращаясь к нам, вы можете рассчитывать на бесплатную оценку. Мы гарантируем, что оценка будет максимально объективной. Своевременное обращение к нам позволит убедиться, что вас не обманывают в другом месте.</div>
            </div>
        </div>
    </div>
</div>

<div class="mozaic-banners-wrapper type-2">
    <div class="row">
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_2.jpg); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">
                    <span class="subtitle">При наличии паспорта</span>
                    <span class="title">Деньги в день обращения</span>
                    <span class="view">узнать цену</span>
                </span>
            </a>
        </div>
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_3.jpg); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">
                    <span class="subtitle">Гарантируем</span>
                    <span class="title">Полную приватность</span>
                </span>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="information-blocks" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-8 information-entry">
            <h3 class="block-title main-heading">Заказать оценку</h3>
            {{ Form::open(array('route' => 'sell.process', 'files' => true)) }}
            <div class="row">
                <div class="col-sm-6">
                    <label>Ваше имя <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="Как к вам обращаться" name="name" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Фото <span>*</span></label>
                    <input class="simple-field" type="file" name="image" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Телефон <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="Номер телефона" name="phone" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>E-mail</label>
                    <input class="simple-field" type="email" placeholder="example@mail.ru" name="email" />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Ref. No <span>*</span></label>
                    <input class="simple-field" type="text" placeholder="Референс часов" name="reference" required />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Год выпуска</label>
                    <input class="simple-field" type="number" name="year" />
                    <div class="clear"></div>
                </div>

                <div class="col-sm-6">
                    <label>Сумма, желаемая к получению, руб.</label>
                    <input class="simple-field" type="number" name="amount" />
                    <div class="clear"></div>
                </div>

                <label class="col-sm-6 checkbox-entry">
                    {{ Form::checkbox('has_box') }} <span class="check"></span> С коробкой
                </label>

                <label class="col-sm-6 checkbox-entry">
                    {{ Form::checkbox('has_documents') }} <span class="check"></span> С документами
                </label>

                <div class="col-sm-12">
                    @foreach ($errors->all() as $error)
                        <label class="text-danger">{{ $error }}</label>
                    @endforeach

                    @if ($success)
                        <label class="text-success">Форма отправлена!</label>
                    @endif

                    <div class="button style-10 sell-button">Отправить<input type="submit" value="" /></div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title main-heading">Как происходит онлайн-оценка</h3>
            <div class="article-container style-1">
                <p>Для удобства клиентов ломбарда Elite Bazaar мы позаботились о создании сервиса онлайн оценки швейцарских часов. Процедура предельно проста: вам достаточно сфотографировать свои часы, заполнить простую анкету и прислать эти данные нам любым удобным способом. После этого останется лишь получить предварительную оценку вашего экземпляра.</p>
                <p>Как правило, экспертное заключение соответствует действительности, однако следует понимать, что окончательный вердикт может быть вынесен только после вашего визита в офис компании. Эксперт сможет лично осмотреть ваши швейцарские часы и подтвердить предварительно озвученную стоимость. Здесь же вы сможете сразу получить наличные деньги.</p>
            </div>
        </div>
    </div>
</div>
@endsection