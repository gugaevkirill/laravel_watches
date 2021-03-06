<div class="information-blocks">
    <div class="row">
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">@lang('site.main_watchesofday')</h3>
            @foreach ($watches as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="{{ $item->getFirstImageUrl() }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current roboto">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">@lang('site.main_newaccessories')</h3>
            @foreach ($accessories as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="{{ $item->getFirstImageUrl() }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current roboto">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 information-entry">
            <h3 class="block-title inline-product-column-title">@lang('site.main_elitegoods')</h3>
            @foreach ($luxury as $item)
                <div class="inline-product-entry">
                    <a class="image" href="{{ $item->getHref() }}" target="_blank"><img src="{{ $item->getFirstImageUrl() }}" alt="{{ $item->name }}" /></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="{{ $item->getHref() }}" target="_blank">{{ $item->name }}</a>
                            <div class="price">
                                <div class="current roboto">{{ $item->getPriceString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>