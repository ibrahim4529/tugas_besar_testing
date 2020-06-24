@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-user text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <h4 class="card-title">{{$jumlah_data['user']}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-graph text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Produk</p>
                                    <h4 class="card-title">{{$jumlah_data['produk']}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-cart text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Transaksi</p>
                                    <h4 class="card-title">{{$jumlah_data['transaksi']}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    class Transaction{

        }
        function sendRequest() {
            class Car{
                constructor(nama, alamat) {
                    this.name = nama;
                    this.address = alamat;
                }
            }
            car1 = new Car("abu", "losarang");
            alert("Send");
            $.ajax({
                    url: 'http://127.0.0.1:8000/api/login',
                method: 'POST',
                dataType: 'JSON',
                    data: {
                        'simple': 'Abu',
                        "data": [
                            car1
                        ]
                    },
                    success: function (data) {
                        console.log(data);
                    }
                }
            )
        }
</script>
@endpush
