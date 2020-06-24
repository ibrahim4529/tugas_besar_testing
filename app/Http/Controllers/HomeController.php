<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlah_data = [
            'user' => User::count(),
            'produk' => Product::count(),
            'transaksi'=> Transaction::count(),
        ];
        return view('home', compact('jumlah_data'));
    }
}
