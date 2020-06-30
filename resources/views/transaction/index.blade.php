@extends('layouts.app')
@section('title', 'Product')
@section('content')
    <x-data-table title="Transaksi" :header="$header_table" resource="transactions">
        @include('transaction.form')
    </x-data-table>
@endsection

@push('css')
    <style>

        .modal-dialog {
            width: 100%;
            height: 100%;
            padding: 0;
            margin:0;
        }
        .modal-content {
            height: 100%;
            border-radius: 0;
            color:#333;
            overflow:auto;
        }
        .modal-title {
            font-size: 2em;
            font-weight: 300;
            margin: 0 0 10px 0;
        }
        .close {
            color:black ! important;
            opacity:1.0;
        }
        @media (min-width: 992px) {
            .modal-lg {
                max-width: 100%;
            }
        }
        @media (min-width: 576px) {
            .modal-lg {
                max-width: 100%;
            }
        }
    </style>
@endpush
