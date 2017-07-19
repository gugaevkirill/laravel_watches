<div class="currency {{ $class }}">
    <span class="now">{{ $currency }}</span>
    <i class="fa fa-angle-down"></i>
    <i class="fa fa-angle-up"></i>
    <ul class="list">
        @foreach($currencies as $code)
        <li>{{ $code }}</li>
        @endforeach
    </ul>
</div>