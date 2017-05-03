<?php $startCount = ($currentPage - 1) * $perPage + 1 ?>
Показано:
@if ($count > 1)
{{ $startCount }}-{{ $startCount + $count - 1 }}
@else
{{ $startCount }}
@endif
из {{ $total }}