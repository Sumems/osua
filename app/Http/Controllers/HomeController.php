<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home() {
        $products = Product::all();
        $articles = Article::all();
        return view('pages.home', ['products' => $products, 'articles' => $articles]);
    }

    public function product() {
        $products = Product::all();
        return view('pages.produk', ['products' => $products]);
    }

    public function article() {
        $articles = Article::all();
        return view('pages.artikel', ['articles' => $articles]);
    }

    public function about() {
        return view('pages.about');
    }

    public function detailArticle($id) {
        $articles = Article::where('id', $id)->first();
        return view('pages.detail-artikel', ['articles' => $articles]);
    }

    public function detailProduct($id) {
        $products = Product::with('images')->where('id', $id)->first();
        return view('pages.detail-produk', ['products' => $products]);
    }

    public function cart() {
        return view('pages.keranjang');
    }

    public function hikingTrails()
    {
        return view('pages.jalur-pendakian');
    }
}
