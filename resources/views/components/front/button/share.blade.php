<div {{ $attributes->merge(['class' => 'social text-end']) }}>
    <a id="share-fb" class="sharer button rounded-circle"
       href="https://www.facebook.com/sharer/sharer.php?app_id=546564929828575&sdk=joey&u={{ $shareLink }}&display=popup&ref=plugin&src=share_button"
       onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')">
        <i class="fa  fa-facebook"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?original_referer={{ url('/') }}&url={{ $shareLink }}" id="share-tw" class="sharer button rounded-circle" target="_blank">
        <i class="fa  fa-twitter"></i>
    </a>
    <a href="https://plus.google.com/share?url={{ $shareLink }}" id="share-gg" class="sharer button rounded-circle" target="_blank">
        <i class="fa  fa-google-plus"></i>
    </a>
</div>
