@extends('front.main')

@section('content')

    <section class="gioithieu tintuc lienhe">
        <div class="container gt">
            <div class="row runout">

                <x-front.breadcrumb />

                <div class="row main-content">
                    <div class="col-md-5 col-12">
                        <h5>TỔNG CÔNG TY TRUYỀN THÔNG (VNPT-MEDIA)
                            <span>CÔNG TY VNPT GAME</span>                  </h5>
                        <p>
                            Tòa nhà VNPT, số 57 Huỳnh Thúc Kháng,<br>
                            Q. Đống Đa, Hà Nội, Việt Nam<br>
                            024 3772 2728<br>
                            024 3772 2733<br>
                            vnptgame@vnpt.vn
                        </p>
                    </div>
                    <div class="col-md-7 col-12">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('head_end')
    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = { lat: 21.019339344589305, lng: 105.80939299797814 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
    @endpush

@push('body_end')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly&channel=2" async></script>
    @endpush
