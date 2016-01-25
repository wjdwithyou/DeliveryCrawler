<?php
namespace App\Http\models;
use DB;

// include?

class ProductModel{
	function getProductAll(){
		$product = DB::select('select idx, name from product');
		
		return array('code' => 1, 'msg' => 'success', 'data' => $product);
	}
	
	function getHotdealProductAll(){
		$hotdeal_product = DB::select('select idx, name from hotdeal_product');
		
		return array('code' => 1, 'msg' => 'success', 'data' => $hotdeal_product);
	}
}