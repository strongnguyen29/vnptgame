<section class="doitac">
    <div class="container">
        <h3 class="text-center">{{ __('Đối tác của chúng tôi') }}<span class="fake">.</span></h3>
        <div class="alldoitac"  data-aos="fade-up" data-aos-duration="800">
            <div class="card" style="">
                <div class="doitacshow">
                    <img src="{{ asset('images/dt1.png') }}" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="card" style="">
                <div class="doitacshow">
                    <img src="{{ asset('images/dt2.png') }}" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="card" style="">
                <div class="doitacshow">
                    <img src="{{ asset('images/dt3.png') }}" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="card" style="">
                <div class="doitacshow">
                    <img src="{{ asset('images/dt4.png') }}" class="card-img-top" alt="...">
                </div>
            </div>

        </div>
    </div>
</section>

@push('body_end')

    <script>
        $( document ).ready(function() {
            $(".alldoitac").slick({
                centerPadding: '40px',
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                arrows: false,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 376,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    </script>
    @endpush
