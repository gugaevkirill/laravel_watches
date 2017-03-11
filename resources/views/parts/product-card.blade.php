<div class="swiper-slide">
    <div class="paddings-container">
        <div class="product-slide-entry">
            <div class="product-image">
                <img src="/{{ $item->images[0] ?? '' }}" alt="{{ $item->name }}" />
            </div>
            <a class="tag" href="{{ $item->getHref() }}">{{ $item->param('ref') ?? 'Референс' }}</a>
            <a class="title" href="{{ $item->getHref() }}">{{ $item->name }}</a>
            <div class="price">
                <div class="current">{{ $item->getPrice() }}</div>
            </div>
        </div>
    </div>
</div>