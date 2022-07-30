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
				  <h3 class="box-title">Product List <span class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image </th>
								<th>Name </th>
								<th>Code</th>
								{{-- <th>Product Price </th> --}}
								<th>Quantity </th>
								<th>Buying Price </th>
								<th>Selling Price </th>
								<th>Color </th>
								<th>Size </th>
								<th>Availibility </th>
								<th>Action</th>
								 
							</tr>
						</thead>
						<tbody>
	 @foreach($products as $item)
	 <tr>
		<td> <img src="{{ asset($item->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
		<td>{{ $item->product_name }}</td>
		<td>{{ $item->product_code }}</td>
		
		 <td>{{ $item->product_qty }} Pcs</td>
		 <td>TK {{ $item->buying_price }} </td>
		 <td>TK {{ $item->selling_price }} </td>
		 <td>{{ $item->product_color }} </td>
		 <td>{{ $item->product_size }} </td>

		 {{-- <td>{{ $item->buying_price }} </td> --}}

		 <td> 
		 	@if($item->product_qty < 0)
		 	<span class="badge badge-pill badge-danger">Stockout</span>

		 	@else
  			 <span class="badge badge-pill badge-success">In Stock</span>

		 	@endif



		 </td>

		 {{-- <td>
		 	@if($item->status == 1)
		 	<span class="badge badge-pill badge-success"> Active </span>
		 	@else
           <span class="badge badge-pill badge-danger"> InActive </span>
		 	@endif

		 </td> --}}


		<td >

 <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>

 <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
 	<i class="fa fa-trash"></i></a>

<a href="{{ route('product.ship',$item->id) }}" class="btn btn-info" title="Ship Product"><i class="fa fa-truck"></i> </a>

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