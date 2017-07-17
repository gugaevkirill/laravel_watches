<div class="product-slide-entry">
    <a href="{{ $item->getHref() }}" target="_blank" class="product-image">
        <img src="{{ $item->getFirstImageUrl() }}" alt="{{ $item->name }}" />
    </a>
    <a class="tag" href="{{ $item->getHref() }}" target="_blank">{{ $item->param('ref') ?? __('site.system_ref') }}</a>
    <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
    <div class="price">
        <div class="current roboto">{{ $item->getPriceString() }}</div>
    </div>
</div>