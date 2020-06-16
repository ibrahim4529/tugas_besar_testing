@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="panel-header bg-secondary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    <h5 class="text-white op-7 mb-2">Data Statistik Sementara!</h5>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-3">
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
                                        <h4 class="card-title">{{$jumlah_data['pegawai']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-thing text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Outlet</p>
                                        <h4 class="card-title">{{$jumlah_data['outlet']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
                                        <p class="card-category">Products</p>
                                        <h4 class="card-title">{{$jumlah_data['product']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
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
                                        <p class="card-category">Category</p>
                                        <h4 class="card-title">{{$jumlah_data['category']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-primary" onclick="sendRequest()">Hallo</button>
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
