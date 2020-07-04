<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_table = [
            'id' => 'ID',
            'invoice' => 'Invoice',
            'final_price' => 'Total Harga',
            'note' => 'Note',
            'action' => 'Action'
        ];
        if(request()->ajax()){
            $products = Transaction::all(['id', 'invoice', 'final_price', 'note']);
            return DataTables::of($products)->addColumn('action', function ($data) {
                $show = '<button onclick="show_data(' . $data->id . ')" class="btn btn-sm btn-primary"><i class="flaticon flaticon-pencil"></i> Show</button>';
                $delete = '<button onclick="delete_data(' . $data->id . ')" class="btn btn-sm btn-danger"><i class="flaticon flaticon-close"></i> Delete</button>';
                $action = '<div class="btn-group" role="group" aria-label="Basic example">' . $show . $delete . '</div>';
                return $action;
            })->rawColumns(['action'])->make(true);
        }
        $products = Product::all();
        return view('transaction.index', compact('header_table', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice' => 'required',
            'final_price' => 'required|gte:0',
            'list_barang' => 'required'
        ]);
        $list_barang =  json_decode($request->list_barang);
        $iput_transaksi = $request->except('list_barang');
        $iput_transaksi['invoice'] = $request->invoice.Transaction::max('id');
        $iput_transaksi['user_id'] = Auth::user()->id;
        $transaction = Transaction::create($iput_transaksi);
        foreach($list_barang as $barang){
            $transaction->products()->attach($barang->id, ['qty' => $barang->qty, 'final_price' => $barang->final_price]);
        }
        return response()->json(['message' => 'Berhasil Menambahkan Transaksi'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(['message' => 'Transaksi Berhasil Di Hapus']);
    }
}
