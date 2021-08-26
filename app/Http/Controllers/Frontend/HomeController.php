<?php

namespace App\Http\Controllers\Frontend;


use App\Facades\MetaTag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends FrontendController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.pages.home.index');
    }

    /**
     *
     */
    public function aboutUs() {
        return view('front.pages.about.index');
    }

    /**
     *
     */
    public function ourServices() {
        return view('front.pages.about.index');
    }

    /**
     *
     */
    public function contactUs() {
        MetaTag::setBreadcrumb([['title' => __('Liên hệ')]]);
        return view('front.pages.contact.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function languageChange(Request $request) {

        $lang = $request->get('lang', 'vi');

        switch ($lang) {
            case 'vi':
                $language = 'vi';
                break;
            case 'en':
                $language = 'en';
                break;
            default: $language = config('app.locale');
        }

        Session::put('front-language', $language);
        return redirect()->route('front.home');
    }
}
