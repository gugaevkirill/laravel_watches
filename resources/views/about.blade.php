@extends('layouts.front')

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>О нас</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 information-entry">
            <div class="information-blocks">
                <img class="project-thumbnail" src="/img/old//about-5.jpg" alt="" />
                <div class="row">
                    <div class="col-md-6 information-entry">
                        <div class="article-container">
                            <h2>Кто мы?</h2>
                            <p style="font-size:16px;color:#929292;">
                                Маленькое вступительное слово про нас. Максимум на 2 строки.
                            </p>
                            <p><b>Швейцарские часы всегда радуют глаз, смотреть на них приносит эстетическое удовольствие, ведь это произведение искусства, созданное руками настоящего мастера! Если Вы счастливый обладатель такого изделия, то знаете, как привлекательно оно, как подкупает  совершенством линий, безукоризненной точностью и идеальным ходом. Эти часы, будучи всемирно известны, ассоциируются с волнующими эмоциями, роскошью и элегантностью, придавая статусности и солидности владельцу.</b></p>
                            <p>Такие часы могут быть разнообразных форм, материалов и цветов. Но, как и любой другой механизм, требующий к себе внимания, они нуждаются в профилактике, поэтому раз в 3-5 лет Ваши швейцарские часы необходимо отдавать в мастерскую по ремонту. Тщательная проверка механизма гарантирует максимально долгий срок службы и бесперебойную работу.</p>
                            <p>Мы осуществляем обслуживание всех марок, работаем с любыми материалами и производим сервис и ремонт швейцарских часов в Москве быстро, качественно и по невысокой цене!</p>
                            {{--<a class="continue-link" href="">Прайс-лист <i class="fa fa-long-arrow-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-6 information-entry">
                        <h3 class="block-title">Наши преимущества</h3>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Преимущество номер раз</h5>
                            <p>Мы можем произвести ремонт швейцарских часов любой сложности, начиная от простой замены детали и заканчивая полной переборкой механизма.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Преимущество номер два</h5>
                            <p>Мы можем произвести ремонт швейцарских часов любой сложности, начиная от простой замены детали и заканчивая полной переборкой механизма.</p>
                        </div>
                        <div class="article-container style-1">
                            <h5><i class="fa fa-check"></i> Преимущество номер три</h5>
                            <p>Мы можем произвести ремонт швейцарских часов любой сложности, начиная от простой замены детали и заканчивая полной переборкой механизма.</p>
                        </div>


                        <div class="accordeon">
                            <div class="accordeon-title active">А тут идет блок вопросов - ответов <span class="inline-label red">важно</span></div>
                            <div class="accordeon-entry" style="display: block;">
                                <div class="article-container style-1">
                                    <p>Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. </p>
                                </div>
                            </div>
                            <div class="accordeon-title">Вопрос номер два</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. </p>
                                </div>
                            </div>
                            <div class="accordeon-title">Вопрос номер три</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. </p>
                                </div>
                            </div>
                            <div class="accordeon-title">Вопрос номер четыре</div>
                            <div class="accordeon-entry">
                                <div class="article-container style-1">
                                    <p>Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. Текст ответа на вопрос. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 information-entry blog-sidebar">
            <div class="information-blocks">
                <div class="categories-list">
                    <h3 class="block-title size-3">Оригинальные швейцарские часы</h3>
                    <ul>
                        @foreach($brands as $brand)
                        <li><a href="/watches/?brands[]={{ $brand->slug }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title">SEO - текстик</h3>
                <div class="text-widget">
                    <div class="description">Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. Сео текст. </div>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">Услуги по ремонту</h3>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/old//product-image-inline-4.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Ремонт швейцарских часов</span>
                            <div class="description">Краткий текст про услугу</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/old//product-image-inline-4.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Обслуживание часов</span>
                            <div class="description">Краткий текст про услугу</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <span class="image"><img src="/img/old//product-image-inline-4.jpg" alt=""></span>
                    <div class="content">
                        <div class="cell-view">
                            <span class="title">Проверка и замена элементов питания</span>
                            <div class="description">Краткий текст про услугу</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection