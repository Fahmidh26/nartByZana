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
				  <h3 class="box-title">Product List <span class="badge badge-pill badge-danger"> {{ count($orders) }} </span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>Image</th>
								<th>Invoice No.</th>
								<th>Product Name</th>
								<th>Code</th>
								<th>Customer Name</th>
								<th>Address</th>
								<th>Phone</th>
                                <th>Quantity</th>
                                <th>Color</th>
								<th>Size</th>
                                <th>Payment</th>
                                <th>Delivery Company</th>
                                <th>Delivery Charge</th>
								<th>Action</th>
                                
								 
							</tr>
						</thead>
						<tbody>
	 @foreach($orders as $item)
	 <tr>
		<td> <img src="{{ asset($item->product->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
        <td>{{ $item->invoice_id }}</td>
		<td>{{ $item->product->product_name }}</td>
		<td>{{ $item->product->product_code }}</td>
		 <td>{{ $item->customer_name }} </td>
		 <td>{{ $item->address }} </td>
		 <td>{{ $item->phone_no }} </td>
         <td>{{ $item->qty }} Pcs</td>
         <td>{{ $item->color }} </td>
         <td>{{ $item->size }} </td>
         <td>{{ $item->payment_type }} </td>
         <td>{{ $item->delivery_company }} </td>
         <td>{{ $item->delivery_charge }} </td>
		 

		 {{-- <td>{{ $item->buying_price }} </td> --}}

		 {{-- <td> 
		 	@if($item->qty <= 0)
		 	<span class="badge badge-pill badge-danger">Stockout</span>

		 	@else
  			 <span class="badge badge-pill badge-success">In Stock</span>

		 	@endif



		 </td> --}}

		 {{-- <td>
		 	@if($item->status == 1)
		 	<span class="badge badge-pill badge-success"> Active </span>
		 	@else
           <span class="badge badge-pill badge-danger"> InActive </span>
		 	@endif

		 </td> --}}


		<td>

 <a href="{{ route('order.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>

 <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
 	<i class="fa fa-trash"></i></a>

		</td>
							 
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
		<!-- /.content -->
	  
	  </div>
  



@endsection