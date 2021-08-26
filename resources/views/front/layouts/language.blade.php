<li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle btn btn-outline-secondary changelg" href="#" id="lg" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('images/' . app()->getLocale() . '.jpg') }}" alt="{{ config('frontend.languages.' . app()->getLocale()) }}"/>
        <span>{{ config('frontend.languages.' . app()->getLocale()) }}</span>
    </a>

    <ul class="dropdown-menu drlg" aria-labelledby="lg">
        @foreach(config('frontend.languages') as $code => $title)
            <li>
                <a class="dropdown-item" href="{{ route('front.languageChange', ['lang' => $code]) }}">
                    <img src="{{ asset('images/'. $code .'.jpg') }}" alt="{{ $title }}"/> {{ $title }}
                </a>
            </li>
        @endforeach
    </ul>

</li>
