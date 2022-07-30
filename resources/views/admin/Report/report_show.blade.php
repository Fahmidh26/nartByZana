@extends('admin.admin_master')
@section('admin')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Report</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Date</th>
								<th>Invoice</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Buying Price</th>
								<th>Selling Price</th>
								<th>Delivery Company </th>
								<th>Delivery Charge</th>

							</tr>
						</thead>
						<tbody>
	@php
		$buyingPrice = 0;
		$sellingPrice = 0;
		$deliveryCharge = 0;
	@endphp

	 @foreach($orders as $item)
	 <tr>
		
		<td> {{ $item->order_date }}  </td>
		<td> {{ $item->invoice_id }}  </td>
		<td> <img src="{{ asset($item->product->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
		<td> {{ $item->qty }}  </td> 
		<td> {{ $item->product->buying_price * $item->qty}}   </td>
		<td> {{ $item->product->selling_price * $item->qty}}  </td>		
		<td> {{ $item->delivery_company }}  </td>
		<td> {{ $item->delivery_charge }}  </td>
		
		@php
		$buyingPrice = $buyingPrice + ($item->product->buying_price * $item->qty);
		$sellingPrice = $sellingPrice + ($item->product->selling_price * $item->qty);
		$deliveryCharge = $deliveryCharge + $item->delivery_charge;
		@endphp

	 </tr>
	  @endforeach
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->






		  </div>
		  <!-- /.row -->
		</section>

		
		<!-- ///////////////// Start Multiple Image Update Area ///////// -->

 <section class="content">
	<div class="row">

<div class="col-md-12">
			   <div class="box bt-3 border-info">
				 <div class="box-header ">
				 <h4 class="box-title">Account Details</h4>
				 </div>

				 <div class="text-right" style="padding: 20px">
					<h4 class="box-title">Total Buying Price : <strong>{{ $buyingPrice }}</strong></h4>
					<h4 class="box-title">Total Selling Price : <strong>{{ $sellingPrice }}</strong></h4>
					<h4 class="box-title">Total Delivery Charge : <strong>{{ $deliveryCharge }}</strong></h4>
					<h4 class="box-title">Profit : <strong>{{ $sellingPrice - $buyingPrice }}</strong></h4>
				 </div>

			   </div>
			 </div>
	</div> <!-- // end row  -->
	
</section>
<!-- ///////////////// End Start Multiple Image Update Area ///////// -->
		<!-- /.content -->
		
	  </div>




@endsection 