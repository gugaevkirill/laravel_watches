<?php $startCount = ($paginator->currentPage() - 1) * $paginator->perPage() + 1 ?>
Показано:
@if ($paginator->count() > 1)
{{ $startCount }}-{{ $startCount + $paginator->count() - 1 }}
@else
{{ $startCount }}
@endif
из {{ $paginator->total() }}