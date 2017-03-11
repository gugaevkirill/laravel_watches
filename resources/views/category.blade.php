@extends('layouts.front')

@push('scripts')
<script>
    $(document).ready(function () {
        var minVal = parseInt($('.min-price span').text());
        var maxVal = parseInt($('.max-price span').text());
        $("#prices-range").slider({
            range: true,
            min: minVal,
            max: maxVal,
            step: 5,
            values: [minVal, maxVal],
            slide: function (event, ui) {
                $('.min-price span').text(ui.values[0]);
                $('.max-price span').text(ui.values[1]);
            }
        });
    });
</script>
@endpush

@section('content')
<div class="breadcrumb-box">
    <a href="/">Главная</a>
    <a>{{ $category->name_ru }}</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <div class="row shop-grid grid-view">
                {{--TODO: вывести отфильтрованные продукты--}}
                <div class="col-md-3 col-sm-4 shop-grid-item">
                    <div class="product-slide-entry shift-image">
                        <div class="product-image">
                            <img src="img/product-minimal-1.jpg" alt=""/>
                            <img src="img/product-minimal-11.jpg" alt=""/>
                            <div class="bottom-line left-attached">
                                <a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-heart"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                        <a class="tag" href="#">Men clothing</a>
                        <a class="title" href="#">Blue Pullover Batwing Sleeve Zigzag</a>
                        <div class="rating-box">
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="reviews-number">25 reviews</div>
                        </div>
                        <div class="article-container style-1">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="price">
                            <div class="prev">$199,99</div>
                            <div class="current">$119,99</div>
                        </div>
                        <div class="list-buttons">
                            <a class="button style-10">Add to cart</a>
                            <a class="button style-11"><i class="fa fa-heart"></i> Add to Wishlist</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="page-selector">
                <div class="description">Showing: 1-3 of 16</div>
                <div class="pages-box">
                    <a href="#" class="square-button active">1</a>
                    <a href="#" class="square-button">2</a>
                    <a href="#" class="square-button">3</a>
                    <div class="divider">...</div>
                    <a href="#" class="square-button"><i class="fa fa-angle-right"></i></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            <div class="information-blocks categories-border-wrapper">
                <div class="block-title size-3">Бренды</div>
                <ul>
                    @foreach($brands as $brand)
                    <li class="accordeon-title">{{ $brand->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="information-blocks">
                <div class="block-title size-2">Boolean</div>
                <div class="size-selector">
                    <div class="entry active">Все</div>
                    <div class="entry">Да</div>
                    <div class="entry">Нет</div>
                    <div class="spacer"></div>
                </div>
            </div>

            <div class="information-blocks">
                <div class="block-title size-2">Select</div>
                <div class="row">
                    <div class="col-xs-6">
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Armani
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Bershka Co
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Nelly.com
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Zigzag Inc
                        </label>
                    </div>
                    <div class="col-xs-6">
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Armani
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Bershka Co
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Nelly.com
                        </label>
                        <label class="checkbox-entry">
                            <input type="checkbox"/> <span class="check"></span> Zigzag Inc
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
