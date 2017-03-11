@extends('layouts.front')

@section('content')
<div class="navigation-banner-swiper">
    <div class="swiper-slide active">
        <div class="navigation-banner-wrapper light-text align-3" style="background-image: url(/img/old/mini-1.jpg); background-position: center center;">
            <div class="navigation-banner-content">
                <div class="cell-view">
                    <h2 class="subtitle"></h2>
                    <h1 class="title">Оценка часов</h1>
                    <div class="description">В компании EliteBazaar вы сможете в кратчайшие сроки узнать реальную стоимость своего изделия - будь то швейцарские часы, ювелирное украшение или драгоценные камни.</div>
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
            <a style="background-image: url(/img/old//mini-3.jpg); background-size: cover; background-position: right top;" class="mozaic-banner-entry type-3">
                <span class="mozaic-banner-content">
                    <span class="subtitle">При наличии документов</span>
                    <span class="title">Деньги в день обращения</span>
                    <span class="view">узнать цену</span>
                </span>
            </a>
        </div>
        <div class="banner-column col-sm-6">
            <a style="background-image: url(/img/old//mini-4.jpg); background-size: cover; background-position: right top;" class="mozaic-banner-entry type-3">
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
                <a class="title" href="#">Центр Москвы</a>
                <div class="description">Наш офис располагается в охраняемом месте в центре Москвы. А дальше идет разъяснительный текст. А дальше идет разъяснительный текст. А дальше идет разъяснительный текст.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">До 50 млн. в день</a>
                <div class="description">Выдаем на руки сумму до 50 млн. в сутки.  А дальше идет разъяснительный текст. А дальше идет разъяснительный текст. А дальше идет разъяснительный текст.</div>
            </div>
        </div>
        <div class="col-sm-4 information-entry left-border nopadding">
            <div class="column-article-entry">
                <a class="title" href="#">Оценка за 5 минут</a>
                <div class="description"> А дальше идет разъяснительный текст. А дальше идет разъяснительный текст. А дальше идет разъяснительный текст. А дальше идет разъяснительный текст.</div>
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
            <h3 class="block-title main-heading">Текст про онлайн-оценку</h3>
            <div class="article-container style-1">
                <p>В далеком 1721 году Петр 1 основывает Петергофскую императорскую фабрику и именно с того времени начинается история длинною почти в три века. Сначала на фабрике производилась обработка драгоценных камней, но чуть позже фабрика начала работать и с камнем, который был необходим для постройки дворцов, фонтанов и музеев. В различные годы фабрика производила различные продукты от набалдашников для зонтов и тростей, мозаики для престола Морского собора в Кронштадте, гробниц для Петропавловского собора и до рубиновых Кремлевских звезд.</p>
            </div>
        </div>
    </div>
</div>
@endsection