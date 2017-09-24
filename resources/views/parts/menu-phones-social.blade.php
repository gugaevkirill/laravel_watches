<span class="icon-entry">
    <span class="text roboto">
        @if (isset($showPhone2) && $showPhone2)
            <a href="@chunk('phone2href')"><b>@chunk('phone2')</b></a>
            <div class="clearfix hidden-md-up"></div>
        @endif
        <div class="clearfix hidden-md-up"></div>
        <a href="@chunk('phone2href')" class="soc m-a-0">
            <img src="/img/whatsapp.png" alt="WhatsApp">
        </a>
        <a href="@chunk('phone2href')" class="soc">
            <img src="/img/viber.png" alt="Viber">
        </a>
        <a href="@chunk('phone2href')" class="soc">
            <img src="/img/telegram.png" alt="Telegram">
        </a>
    </span>
</span>