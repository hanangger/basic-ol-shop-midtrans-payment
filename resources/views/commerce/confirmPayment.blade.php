@extends('commerce/template')
@include('commerce/footer')

@section('content')
	<div class="row">
		<div class="col-md-3 v-line"></div>
		<div class="col-md-6 v-line">
			<h3>Confim Payment</h3>
			<table class="table table-stripped">
				<tr>
					<th>First Name</th>
					<td>{{ $data['customer']['first_name'] }}</td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td>{{ $data['customer']['last_name'] }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $data['customer']['email'] }}</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>{{ $data['customer']['address'] }}</td>
				</tr>
				<tr>
					<th>City</th>
					<td>{{ $data['customer']['city'] }}</td>
				</tr>
				<tr>
					<th>Phone</th>
					<td>{{ $data['customer']['phone'] }}</td>
				</tr>
				<tr>
					<th>Postal Code</th>
					<td>{{ $data['customer']['postal_code'] }}</td>
				</tr>
			</table>
			<h3>Cart</h3>
			<table class="table table-striped">
				<tr>
					<td>Name</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Total</td>
				</tr>
				<?php foreach($data['cartList'] as $key=>$item){ ?>
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
							foreach($data['cartList'] as $item){
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
					 	{{ Form::open(array('url' => 'catalog/payment/checkoutvtweb')) }}

							{{@Form::button('Checkout Payment', ['id'=>'checkout-button', 'type'=>'submit', 'class'=>'btn btn-success'])}}
						{{ Form::close()}}
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-3 v-line"></div>
	</div>
@stop