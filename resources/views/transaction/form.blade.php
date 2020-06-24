<div class="col-sm-12">
    <div class="form-group" id="name">
        {!! Form::label('name', 'Nama Produk', ['class'=>'placeholder']) !!}
        {!! Form::input('name', 'name', old('email'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group" id="price">
        {!! Form::label('price', 'Harga', ['class'=>'placeholder']) !!}
        {!! Form::input('number', 'price', old('price'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group" id="qty">
        {!! Form::label('qty', 'Jumlah', ['class'=>'placeholder']) !!}
        {!! Form::input('number', 'qty', old('qty'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group" id="description">
        {!! Form::label('description', 'Deskripsi Produk ', ['class'=>'placeholder']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => "3"]) !!}
    </div>
</div>
