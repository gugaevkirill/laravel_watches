@extends('layouts.front')

@section('content')
<div class="navigation-banner-swiper">
    <div class="swiper-slide active">
        <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/sell/2400x1000.png); background-position: center center;">
            <div class="navigation-banner-content">
                <div class="cell-view">
                    <h2 class="subtitle"></h2>
                    <h1 class="title">Скупка часов</h1>
                    <div class="description">Покупаем швейцарские в. т. ч. винтажные часы по России и миру. Просто скиньте фотку часов по whatsapp / viber / telegramm, напишите на мыло или заполните форму и мы быстро и точно сделаем онлайн оценку.</div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="mozaic-banners-wrapper type-2">
    <div class="row">
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_2.png); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">
                    <span class="subtitle">При наличии документов</span>
                    <span class="title">Деньги в день обращения</span>
                    <span class="view">узнать цену</span>
                </span>
            </a>
        </div>
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/sell/600x420_3.png); background-size: cover; background-position: center center;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">
                    <span class="subtitle">обеспечиваем вам</span>
                    <span class="title">Полную приватность</span>
                </span>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="hidden-sm hidden-xs" style="height: 30px;"></div>

<div class="column-article-wrapper">
    <div class="row nopadding">
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Работаем с оригиналом</a>
                <div class="description">Мы осуществляем скупку оригинальных швейцарских часов в Москве. Поэтому мы настоятельно просим не предлагать на выкуп часы:

                    сомнительного происхождения,
                    копии и подделки китайского производства,
                    советские часы,
                    электронные, пластмассовые.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Классная цена</a>
                <div class="description">Скупка оригинальных швейцарских часов производится после тщательной оценки изделия, и мы можем гарантировать своим клиентам, что выкуп элитных наручных часов б/у будет осуществлен по объективной цене.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Бесплатная экспертиза</a>
                <div class="description"> Мы проводим оценку часов бесплатно, если вы продадите их в наш ломбард. Обязательно обращайтесь к нам, если вам необходима независимая экспертиза. Например, она может понадобиться, чтобы проверить, правильную ли цену вам предлагают в другом ломбарде.</div>
            </div>
        </div>
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

                    <div class="button style-10">Отправить<input type="submit" value="" /></div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-4 information-entry">
            <h3 class="block-title main-heading">Как происходит онлайн оценка</h3>
            <div class="article-container style-1">
                <p>Чтобы облегчить для Вас процедуру оценки швейцарских часов, магазин швейцарских часов в Москве Shoprepeater практикует услугу оценки онлайн. Для этого от Вас требуется заполнить специальную форму на нашем сайте, где вы сообщите необходимые данные о своих часах, перешлете фотографии, а наши специалисты на основе этих данных смогут сделать предварительное заключение о стоимости Вашего изделия.

                    После этого Вам останется только узнать цену швейцарских часов и приехать к нам за деньгами. В большинстве случаев та цена, что была озвучена после онлайн оценки соответствует действительной. Но необходимо помнить, что полностью оценить стоимость может только непосредственный осмотр Ваших часов квалифицированным специалистом у нас в офисе.</p>
            </div>
        </div>
    </div>
</div>
@endsection