<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->middleware('auth');
        $this->blogRepository = $blogRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function welcome()
    {
        $blogs = $this->blogRepository->paginate(10);
        return view('welcome', compact('blogs'));
    }

    public function details($id)
    {
        $blog = $this->blogRepository->find($id);
        return view('details', compact('blog'));
    }
}
