<div class="product-slide-entry">
    <div class="product-image">
        <img src="/{{ $item->images[0] ?? '' }}" alt="{{ $item->name }}" />
    </div>
    <a class="tag" href="{{ $item->getHref() }}" target="_blank">{{ $item->param('ref') ?? 'Референс' }}</a>
    <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
    <div class="price">
        <div class="current roboto">{{ $item->getPriceString() }}</div>
    </div>
</div>