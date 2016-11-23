@extends('commerce/template')
@include('commerce/footer')

@section('content')
	<div class="row">
		<div class="col-md-3 v-line ">
			{{ Form::open(array('url' => 'catalog/list', 'method'=>'get')) }}
				<div class="form-group pd-10">
	                <label for="brand" class="control-label">Select Brand</label>
	                {{ Form::select('brand', ['asus'=>'Asus', 'samsung'=>'Samsung', 'sony'=>'Sony', 'xiaomi'=>'Xiaomi'], Input::get('brand'), ['class'=>'form-control', 'onChange'=>'return brand_change($(this))']) }}
	            </div>
	            <!--
	            <div class="form-group pd-10">
	                <label for="price_range" class="control-label">Select Price Range</label>
	                {{ Form::select('price', ['500-1500'=>'500.000 - 1.000.000', '1500-3000'=>'1.5000.000 - 3.000.000', '3000-5000'=> '3.000.000 - 5.000.000', '5000-10000'=>'5.000.000 - 10.000.000'], null, ['class'=>'form-control', 'onChange'=>'return price_change($(this))']) }}
	            </div>-->
			{{ Form::close() }}
		</div>
		<div class="col-md-9 v-line">
			<div class="row">
			@if (!empty($items))
				@foreach($items as $key=>$item)
					<div class="col-sm-3 t-c b">
						<img class="item-img" src="{{ asset('uploads').'/'.$item->image }}"/>
						<strong><div class="name">{{$item->name}}</div></strong>
						<div class="price">IDR {{$item->price}}</div>
						<div class="stock"><strong>Stock</strong> : {{$item->stock}}</div>
						<div class="id">{{$item->id}}</div>
						<input type="hidden" class="_token" value="{{ csrf_token() }}">
						{{Form::button('Add to cart', array('class'=>'cart-button btn btn-primary', 'onclick'=>'return add($(this));'))}}
					</div>
				@endforeach
			@endif
			</div>
		</div>
	</div>
    <script type="text/javascript">
       	function add(item){
       		var quantity = prompt('Input quantity : ');
       		if(quantity > 0){
	       		var data = {
	       			id : item.parent('.b').find('.id').html(),
	       			name : item.parent('.b').find('.name').html(),
	       			price : item.parent('.b').find('.price').html(),
	       			stock : item.parent('.b').find('.stock').html(),
	       			quantity : quantity,
	       			_token : item.parent('.b').find('._token').val(),
	       		};
	       		$.ajax({
	       			url : "{{url('/catalog/addCart')}}",
	       			data : data,
	       			type : 'post',
	       			success : function(response){
	       				alert(response);
	       			}
	       		});
	       		console.log(data);
	       	}else{
	       		alert("Minimum quantity is 1");
	       	}
       	}
       	function brand_change(ele){
       		ele.closest('form').submit();
       	}
       	function price_change(ele){
       		ele.closest('form').submit();
       	}
    </script>
@stop