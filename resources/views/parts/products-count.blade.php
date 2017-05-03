<?php $startCount = ($paginator->currentPage() - 1) * $paginator->perPage() + 1 ?>
Показано:
@if ($paginator->count() >= 1)
{{ $startCount }} - {{ $startCount + $paginator->count() - 1 }}
@elseif ($paginator->count() == 1)
1
@else
0
@endif
из {{ $paginator->total() }}