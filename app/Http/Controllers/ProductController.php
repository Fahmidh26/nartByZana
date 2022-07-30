<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Order;
use App\Models\Product;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image as Image;

class ProductController extends Controller
{
    public function AddProduct(){
		$categories = Category::latest()->get();
		return view('admin.Product.product', compact('categories'));
	}


	public function StoreProduct(Request $request){

        $image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
    	$save_url = 'upload/products/thumbnail/'.$name_gen;

		$discount = ($request->selling_price) - ($request->discount_price);

      $product_id = Product::insertGetId([
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'product_name' => $request->product_name,
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_size' => $request->product_size,
      	'product_color' => $request->product_color,

      	'selling_price' => $request->selling_price,
      	'buying_price' => $request->buying_price,

      	'short_descp' => $request->short_descp,
      	'product_thambnail' => $save_url,
      	'status' => 1,
      	'created_at' => Carbon::now(),   

      ]);


      ////////// Multiple Image Upload Start ///////////

      $images = $request->file('multi_img');
      foreach ($images as $img) {
      	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    	$uploadPath = 'upload/products/multi-image/'.$make_name;

    	MultiImg::insert([

    		'product_id' => $product_id,
    		'photo_name' => $uploadPath,
    		'created_at' => Carbon::now(), 

    	]);

      }

      ////////// Een Multiple Image Upload Start ///////////


       $notification = array(
			'message' => 'Product Inserted Successfully',
			'alert-type' => 'success'
		);

		// return redirect()->route('manage-product')->with($notification);
		return redirect()->back()->with($notification);

	} // end method

	public function ManageProduct(){

		$products = Product::latest()->get();
		return view('admin.Product.product_view',compact('products'));
	}


	public function EditProduct($id){

		$multiImgs = MultiImg::where('product_id',$id)->get();

		$categories = Category::latest()->get();
		$subcategory = subCategory::latest()->get();
		$products = Product::findOrFail($id);
		return view('admin.Product.product_edit',compact('categories','subcategory','products','multiImgs'));

	}


	public function ProductDataUpdate(Request $request){

		$product_id = $request->id;

         Product::findOrFail($product_id)->update([
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'product_name' => $request->product_name,
      	'product_code' => $request->product_code,
      	'product_qty' => $request->product_qty,      
      	'product_size' => $request->product_size,
      	'product_color' => $request->product_color,
      	'selling_price' => $request->selling_price,
      	'buying_price' => $request->buying_price,
      	'short_descp' => $request->short_descp,
      	'status' => 1,
      	'created_at' => Carbon::now(),   

      ]);

          $notification = array(
			'message' => 'Product Updated Without Image Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('manage-product')->with($notification);


	} // end method 


/// Multiple Image Update
	public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = MultiImg::findOrFail($id);
	    unlink($imgDel->photo_name);
	     
    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    	$uploadPath = 'upload/products/multi-image/'.$make_name;

    	MultiImg::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } // end foreach

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

	} // end mehtod 


 /// Product Main Thambnail Update /// 
 public function ThambnailImageUpdate(Request $request){
 	$pro_id = $request->id;
 	$oldImage = $request->old_img;
 	unlink($oldImage);

    $image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;

    	Product::findOrFail($pro_id)->update([
    		'product_thambnail' => $save_url,
    		'updated_at' => Carbon::now(),

    	]);

         $notification = array(
			'message' => 'Product Image Thambnail Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

     } // end method


 //// Multi Image Delete ////
     public function MultiImageDelete($id){
     	$oldimg = MultiImg::findOrFail($id);
     	unlink($oldimg->photo_name);
     	MultiImg::findOrFail($id)->delete();

     	$notification = array(
			'message' => 'Product Image Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

     } // end method 



     public function ProductInactive($id){
     	Product::findOrFail($id)->update(['status' => 0]);
     	$notification = array(
			'message' => 'Product Inactive',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
     }


  public function ProductActive($id){
  	Product::findOrFail($id)->update(['status' => 1]);
     	$notification = array(
			'message' => 'Product Active',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
     	
     }



     public function ProductDelete($id){
     	$product = Product::findOrFail($id);
     	unlink($product->product_thambnail);
     	Product::findOrFail($id)->delete();

     	$images = MultiImg::where('product_id',$id)->get();
     	foreach ($images as $img) {
     		unlink($img->photo_name);
     		MultiImg::where('product_id',$id)->delete();
     	}

     	$notification = array(
			'message' => 'Product Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

     }// end method 



	 public function ShipProduct($id){

		$products = Product::findOrFail($id);

		return view('admin.Order.ship',compact('products'));
	}

	public function EditOrder($id){

		$orders = Order::findOrFail($id);
		// $product = Product::where('product_id',$id)->get();
		return view('admin.Order.order_edit',compact('orders'));

	}

	public function ShipStoreProduct(Request $request){
		
		$proId = $request->pro_id;
		$preQty = $request->quantity;
		$newQty = $request->qty;
		$sellingPrice = $request->selling_price;
		$amount = $newQty * $sellingPrice;

		if ($request->has('delivery_company') && !empty($request->input('delivery_company'))) {
			Order::insert([

				'product_id' => $request->pro_id,
				'invoice_id' => 'NBZ'.mt_rand(10000000,99999999),
				'size' => $request->size,
				'color' => $request->color,
				'qty' => $request->qty,
				'amount' => $amount,
				'address' => $request->address,
				'customer_name' => $request->customer_name,
				'phone_no' => $request->phone_no,
				'payment_type' => $request->payment_type,
				'delivery_company' => $request->delivery_company,
				'delivery_charge' => $request->delivery_charge,
				'order_date' => Carbon::now()->format('d F Y'),
				 'order_month' => Carbon::now()->format('F'),
				 'order_year' => Carbon::now()->format('Y'),
				'created_at' => Carbon::now(),   
		
				]);
		} else {
			Order::insert([

				'product_id' => $request->pro_id,
				'invoice_id' => 'NBZ'.mt_rand(10000000,99999999),
				'size' => $request->size,
				'color' => $request->color,
				'qty' => $request->qty,
				'amount' => $amount,
				'address' => $request->address,
				'customer_name' => $request->customer_name,
				'phone_no' => $request->phone_no,
				'payment_type' => $request->payment_type,
				// 'delivery_company' => $request->delivery_company,
				// 'delivery_charge' => $request->delivery_charge,
				// 'order_date' => Carbon::now()->format('d F Y'),
				//  'order_month' => Carbon::now()->format('F'),
				//  'order_year' => Carbon::now()->format('Y'),
				'created_at' => Carbon::now(),   
		
				]);
		}
		
		
			Product::findOrFail($proId)->update(['product_qty' => $preQty - $newQty]);


       $notification = array(
			'message' => 'Order Shipped Successfully',
			'alert-type' => 'success'
		);

		// return redirect()->route('manage-product')->with($notification);
		return redirect()->back()->with($notification);

	} // end method





	public function UpdateOrder(Request $request){
		
		$proId = $request->pro_id;
		$preQty = $request->quantity;
		$newQty = $request->qty;
		$sellingPrice = $request->selling_price;
		$amount = $newQty * $sellingPrice;

		if ($request->has('delivery_company') && !empty($request->input('delivery_company'))) {
			Order::insert([

				'product_id' => $request->pro_id,
				'invoice_id' => 'NBZ'.mt_rand(10000000,99999999),
				'size' => $request->size,
				'color' => $request->color,
				'qty' => $request->qty,
				'amount' => $amount,
				'address' => $request->address,
				'customer_name' => $request->customer_name,
				'phone_no' => $request->phone_no,
				'payment_type' => $request->payment_type,
				'delivery_company' => $request->delivery_company,
				'delivery_charge' => $request->delivery_charge,
				'order_date' => Carbon::now()->format('d F Y'),
				 'order_month' => Carbon::now()->format('F'),
				 'order_year' => Carbon::now()->format('Y'),
				'created_at' => Carbon::now(),   
		
				]);
		} else {
			Order::insert([

				'product_id' => $request->pro_id,
				'invoice_id' => 'NBZ'.mt_rand(10000000,99999999),
				'size' => $request->size,
				'color' => $request->color,
				'qty' => $request->qty,
				'amount' => $amount,
				'address' => $request->address,
				'customer_name' => $request->customer_name,
				'phone_no' => $request->phone_no,
				'payment_type' => $request->payment_type,
				// 'delivery_company' => $request->delivery_company,
				// 'delivery_charge' => $request->delivery_charge,
				// 'order_date' => Carbon::now()->format('d F Y'),
				//  'order_month' => Carbon::now()->format('F'),
				//  'order_year' => Carbon::now()->format('Y'),
				'created_at' => Carbon::now(),   
		
				]);
		}
		
		
			Product::findOrFail($proId)->update(['product_qty' => $preQty - $newQty]);


       $notification = array(
			'message' => 'Order Shipped Successfully',
			'alert-type' => 'success'
		);

		// return redirect()->route('manage-product')->with($notification);
		return redirect()->back()->with($notification);

	} // end method

	public function Orders(){

		$orders = Order::latest()->get();
		return view('admin.Order.viewOrder',compact('orders'));
	}

	
}
