@extends('commerce/template')
@include('commerce/footer')

@section('content')
	<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center><h2>Plase Fill Your Data</h2></center>
            {{ Form::open(array('url' => 'catalog/payment/confirm', 'files'=>true)) }}
                <div class="form-group">
                    <label for="first_name" class="control-label">First Name</label>
                     {{Form::text('first_name','', ['id'=>'name', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label">Last Name</label>
                    {{Form::text('last_name', "", ['id'=>'price', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    {{Form::email('email', "", ['id'=>'stock', 'class'=>'form-control'])}}
                </div>
                 <div class="form-group">
                    <label for="phone" class="control-label">Phone</label>
                    {{Form::text('phone', "", ['id'=>'specification', 'class'=>'form-control'])}}
                </div>

                 <div class="form-group">
                    <label for="address" class="control-label">Address</label>
                    {{Form::textarea('address', "", ['id'=>'stock', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="city" class="control-label">City</label>
                    {{Form::text('city', "", ['id'=>'city', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="postal_code" class="control-label">Postal Code</label>
                    {{Form::text('postal_code', "", ['id'=>'postal_code', 'class'=>'form-control'])}}
                </div>
                <div class="form-group">
                   {{Form::button('Continue to Payment', ['type'=>'submit', 'class'=>'btn btn-primary form-control'])}}
                </div>
            {{ Form::close() }}
        </div>
        <div class="col-md-3"></div>
    </div> 
@stop