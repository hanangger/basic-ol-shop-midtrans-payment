@extends('commerce/template')
@include('commerce/footer')

@section('content')
	<div class="row">
		<div class="col-md-3 v-line"></div>
		<div class="col-md-6 v-line">
			<h3>My cartList</h3>
			<table class="table table-striped">
				<tr>
					<td>Name</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Total</td>
				</tr>
				<?php foreach($cartList as $key=>$item){ ?>
					<tr>
						<td><?php echo $item[1]; ?></td>
						<td><?php echo $item[2]; ?></td>
						<td><?php echo $item[3]; ?></td>
						<td><?php echo $item[3]*$item[2]; ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td class="t-c" colspan="4"><strong>
						<span>
							Total Payment : IDR 
						</span>
						<span>
						<?php 
							$total = [];
							foreach($cartList as $item){
								$total[] = $item[2] * $item[3];
							}
							echo array_sum($total);
						?>
						</span>
						</strong>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="t-r">
					 	{{ Form::open(array('url' => 'catalog/payment/customer')) }}

							{{@Form::button('Continue to Payment', ['id'=>'checkout-button', 'type'=>'submit', 'class'=>'btn btn-success'])}}
						{{ Form::close()}}
					</td>
				</tr>
			</table>
			@section('payment-powered')

			@stop
		</div>
		<div class="col-md-3 v-line">&nbsp;</div>
	</div>
@stop