<?php

namespace App\Http\Controllers;

use Modules\Blog\Entities\Blog;

class MainController extends Controller
{
    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function index()
    {
        return view('pages.index');
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function service()
    {
        return view('pages.service');
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function blog()
    {
        return view('pages.blog');
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function showBlog($slug)
    {
        $blog = Blog::where('slug_title', $slug)->firstOrFail();
        return view('pages.blog-single', compact('blog'));
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function faq()
    {
        return view('pages.faq');
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function contact()
    {
        $contact = [
            'address' => getContact('address'),
            'maps' => getContact('maps'),
            'phone' => getContact('phone'),
            'marketingMail' => getContact('marketing mail'),
        ];
        return view('pages.contact', compact('contact'));
    }

    /**
     * Show homepage on company profile
     *
     * @return void
     */
    public function career()
    {
        return view('pages.career');
    }
}