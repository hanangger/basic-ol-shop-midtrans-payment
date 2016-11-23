@extends('commerce/template')
@include('commerce/footer')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center><h2>Add Item</h2></center>
            {{ Form::open(array('url' => 'catalog/doCreate', 'files'=>true)) }}
                <div class="form-group">
                    <label for="name" class="control-label">Item Name</label>
                     {{Form::text('name','', ['id'=>'name', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="price" class="control-label">Price</label>
                    {{Form::text('price', 0, ['id'=>'price', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="stock" class="control-label">Stock</label>
                    {{Form::text('stock', 1, ['id'=>'stock', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="specification" class="control-label">Specification</label>
                    {{Form::textarea('specification', "", ['id'=>'specification', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="quantity" class="control-label">Image</label>
                    {!! Form::file('image') !!}
                </div>
                <div class="form-group">
                   {{Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary form-control'])}}
                </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-3"></div>
    </div> 
@stop