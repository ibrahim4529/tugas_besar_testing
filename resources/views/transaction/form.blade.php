<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            Data Transakasi
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('invoice', 'No Invoice', ['class'=>'placeholder']) !!}
                    {!! Form::input('text', 'invoice', "INV-".date('YmdHis'), ['class' => 'form-control
                    form-control-sm', 'disabled']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('final_price', 'Harga Ahir', ['class'=>'placeholder']) !!}
                    {!! Form::input('number', 'final_price', null, ['disabled','class' => 'form-control
                    form-control-sm']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('note', 'Catatan Transaksi', ['class'=>'placeholder']) !!}
                    {!! Form::textarea('note', null, ['class' => 'form-control form-control-sm', 'rows' => "3"]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        {!! Form::label('product', 'Poduk ', ['class'=>'placeholder']) !!}
                        <select class="form-control" style="width: 100%;" name="product" id="product">
                            @foreach($products as $product)
                            <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('jumlah', 'Jumlah ', ['class'=>'placeholder']) !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control', 'rows' => "3"]) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="button" onclick="addbarang()" class="btn btn-primary btn-full" value="Tambah"
                        style="margin-top: 40px;">
                </div>
            </div>

            <table class="table" style="width: 100%" id="table_barang">
                <thead>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    var barang = [];

    function save_trans(){
        let form = new FormData();
        form.append('invoice', $("#invoice").val());
        form.append('final_price', $("#final_price").val())
        form.append('note', $("#note").val())
        form.append('list_barang', JSON.stringify(barang));
        $.ajax({
            url: method == 'POST' ? url : url + '/' + edited_id,
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: function () {
                if(method != 'POST'){
                    form.append('_method', 'PATCH');
                }
                delete_error();
            },
            success: function (data) {
                $("#modal_form").modal('hide');
                swal("Pesan", data.message, {
						icon : "success",
						buttons: {
							confirm: {
								className : 'btn btn-success'
							}
						},
				});
                reload_table()
                },
            error: function(xhr, error, errorThrown){
                if (xhr.status == 422) {
                    let message = xhr.responseJSON.message;
                    let errors = xhr.responseJSON.errors;
                    swal('Error', 'Data Tidak Valid \nPastikan Data Barang Tidak Kosong', {
                        icon: 'error',
                        buttons: {
                            confirm:{
                                className: 'btn btn-info'
                            }
                        }
                    });
                }
            }
            });
        }
        class Product{
            constructor(id, name, qty,price, final_price)
            {
                this.id = id;
                this.name= name;
                this.qty= qty;
                this.price = price;
                this.final_price = final_price;
            }
        }


        var tablebarang = $("#table_barang").dataTable({
            data: barang,
            theme: 'bootstrap',
            columns:[
                {title: 'Nama Barang', data:'name'},
                {title: 'Jumlah', data:'qty'},
                {title: 'Harga', data:'price'},
                {title: 'Total', data:'final_price'},
            ],
            pageLength: 3,
        });
        function addbarang(){
            let product_id = $("#product").val();
            let product_qty = parseInt($("#jumlah").val());
            if(product_qty < 1 || Number.isNaN(product_qty)){
                swal("Pesan", "Jumlah Barang Tidak Boleh Kurang dari 1", {
                    icon: "warning",
                    buttons:{
                        confirm:{
                            className : 'btn btn-success'
                        }
                    }
                });
            }
            else{
                let name = $('#product').select2('data')[0]['text'];
                let price = $('#product').select2('data')[0].element.dataset.price;
                let product = new Product(product_id, name, product_qty, price, parseInt(price) * parseInt(product_qty));
                let item = barang.find(item => item.id == product_id);
                if(item === undefined){
                    barang.push(product);
                    tablebarang.fnAddData(
                        product
                    );
                }else{
                    item.qty = parseInt(item.qty) + parseInt(product_qty);
                    item.final_price = item.qty * item.price;
                    tablebarang.fnClearTable();
                    barang.forEach(function (val) {
                        tablebarang.fnAddData(val);
                    });
                }
            }
            let total_harga = barang.map(item => item.final_price)
                                .reduce((prev, curr) => prev + curr, 0);
            $("#final_price").val(total_harga);
        }
</script>
@endpush
