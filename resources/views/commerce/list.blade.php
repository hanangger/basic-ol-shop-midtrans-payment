@extends('commerce/template')
@include('commerce/footer')

@section('content')
	<div class="row">
		<div class="col-md-3 v-line">
			sub
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
       	}
    </script>
@stop