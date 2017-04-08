<div class="information-blocks">
    <div class="row">
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">Часы дня</h3>
            @foreach ($watches->slice(0, 3) as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="/{{ $item->images[0] ?? '' }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">Украшения со скидкой</h3>
            @foreach ($jewelry->slice(0, 3) as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="/{{ $item->images[0] ?? '' }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">Аксессуары</h3>
            @foreach ($accessories->slice(0, 3) as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="/{{ $item->images[0] ?? '' }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>