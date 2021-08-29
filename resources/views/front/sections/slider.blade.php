<section class="slider">
    <div id="carouselSliders" class="carousel slide" data-bs-ride="carousel" >

        <div class="carousel-inner">
            @for($i = 1; $i < 5;$i++)
            <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                <img src="{{ asset('images/slider'. $i .'.jpg') }}" class="bannerdesktop d-block w-100" alt="slide">
            </div>
            @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSliders"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselSliders"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
