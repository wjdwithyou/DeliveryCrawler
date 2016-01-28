<?php
namespace App\Http\models;
use DB;

// include?

class ReviewModel{
	function createHotdeal($hotdeal_idx, $rating, $writer_name, $title, $upload, $contents){
		// input error check
		
		$test = DB::select('select * from hotdeal_review where hotdeal_idx=?', array($hotdeal_idx));
		
		for ($i = 0; $i < count($test); ++$i){
			if ($test[$i]->rating == $rating && $test[$i]->writer_name == $writer_name)
				return array('code' => 0, 'msg' => 'duplicate');
		}
		
		// If new review occur, insert to DB.
		$result = DB::table('hotdeal_review')->insertGetId(
				array(
						'hotdeal_idx' => $hotdeal_idx,
						'rating' => $rating,
						'writer_name' => $writer_name,
						'title' => $title,
						'upload' => $upload,
						'contents' => $contents
				)
		);
		
		return array('code' => 1, 'msg' => 'success');
	}
	
	function createProduct($product_idx, $rating, $writer_name, $title, $upload, $contents){
		// input error check
		
		$test = DB::select('select * from product_review where product_idx=?', array($product_idx));
		
		for ($i = 0; $i < count($test); ++$i){
			if ($test[$i]->rating == $rating && $test[$i]->writer_name == $writer_name)
				return array('code' => 0, 'msg' => 'duplicate');
		}
		
		// If new review occur, insert to DB.
		$result = DB::table('product_review')->insertGetId(
				array(
						'product_idx' => $product_idx,
						'rating' => $rating,
						'writer_name' => $writer_name,
						'title' => $title,
						'upload' => $upload,
						'contents' => $contents
				)
		);
	}
}