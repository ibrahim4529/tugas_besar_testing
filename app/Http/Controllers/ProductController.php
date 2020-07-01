<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
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
            'name' => 'Nama',
            'price' => 'Harga',
            'qty' => 'Jumlah',
            'action' => 'Action'
        ];
        if(request()->ajax()){
            $products = Product::all(['id', 'name', 'price', 'qty']);
            return DataTables::of($products)->addColumn('action', function ($data) {
                $edit = '<button onclick="edit_data(' . $data->id . ')" class="btn btn-sm btn-primary"><i class="flaticon flaticon-pencil"></i> Edit</button>';
                $delete = '<button onclick="delete_data(' . $data->id . ')" class="btn btn-sm btn-danger"><i class="flaticon flaticon-close"></i> Delete</button>';
                $action = '<div class="btn-group" role="group" aria-label="Basic example">' . $edit . $delete . '</div>';
                return $action;
            })->rawColumns(['action'])->make(true);
        }

        return view('product.index', compact('header_table'));

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
            'name' => 'required',
            'price' => 'required|gte:0',
            'qty' => 'required|gte:0'
        ]);

        $data = $request->all();
        $product = Product::create($data);
        return response()->json([
            'message' => $product->name." Berhasil Dibuat"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $name = $product->name;
        $data = $request->all();
        $product->update($data);
        return response()->json(['message' => 'Data '.$name.' Berhasil diperbarui'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();
        return response()->json([
            'message' => 'Data '. $name." Berhasil Di Hapus",
        ], 200);
    }
}
