@forelse($paginator->getCollection() as $item)
    <div class="col-md-3 col-sm-4 shop-grid-item">
        @include('parts.product-card')
        <div class="clear"></div>
    </div>
@empty
    <div class="col-md-12 no-products">
        Товаров нет
        <div class="clear"></div>
    </div>
@endforelse