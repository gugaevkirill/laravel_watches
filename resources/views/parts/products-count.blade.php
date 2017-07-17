<?php $startCount = ($paginator->currentPage() - 1) * $paginator->perPage() + 1 ?>
@lang('site.catalog_show'):
@if ($paginator->count() >= 1)
{{ $startCount }} - {{ $startCount + $paginator->count() - 1 }}
@elseif ($paginator->count() == 1)
1
@else
0
@endif
@lang('site.catalog_pagenpretext') {{ $paginator->total() }}