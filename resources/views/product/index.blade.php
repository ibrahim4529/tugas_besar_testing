@extends('layouts.app')
@section('title', 'Product')
@section('content')
    <x-data-table title="Produk" :header="$header_table" resource="products">
        @include('product.form');
    </x-data-table>
@endsection
