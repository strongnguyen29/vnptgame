<section class="newsevent {{ $sectionClass ?? '' }}">
    <div class="container">
        <h3 class="text-center">{{ __('Tin tức - Sự kiện') }}<span class="fake">.</span></h3>
        <div class="cactin">
            @foreach($posts as $post)
                <x-front.post-item :post="$post" />
            @endforeach
        </div>
    </div>
</section>

@push('body_end')
    <script>

        $(function () {
            $(".cactin").slick({
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            autoplay: true,
                            autoplaySpeed: 3000,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 376,
                        settings: {
                            autoplay: true,
                            autoplaySpeed: 3000,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        })

    </script>
    @endpush
