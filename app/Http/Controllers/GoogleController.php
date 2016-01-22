<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
//model
//use Request;

class GoogleController extends Controller{
	public function test(){
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=apple+iphone+6s&tbm=shop&cad=h");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/shopping');
		
		$html = curl_exec($ch);
		
		curl_close($ch);
		
		
		
		$html = substr($html, strpos($html, "Merchant links are sponsored"));
		
		$html = substr($html, strpos($html, "<a"));
		
		$html = substr($html, strpos($html, "product/") + 8);
		$num = substr($html, 0, strpos($html, "?"));
		
		
		return file_get_contents('http://www.google.com/shopping/product/'.$num.'/reviews');
		
		// here!
		
		
		
		
		
		
		
		
		$host = 'https://www.google.com';
		$path = '/shopping';
		
		//$html = file_get_contents('https://www.google.com/shopping');
		$html = file_get_contents($host.$path);
		
		if (!strpos($html, "Top Tech Products"))
			return 'google: page error';	// temp
		
		$html = substr($html, strpos($html, "Top Tech Products"));
		
		//return $html;
		
		$url = array();
		$review = array();
		
		
		while ($loop = strpos($html, "_tpb")){
			$html = substr($html, strpos($html, "<a"));
			$html = substr($html, strpos($html, "href=\"") + 6);
			$temp_url = substr($html, 0, strpos($html, "\""));
			
			//$rvtml = file_get_contents($host.$temp_url);
			$rvtml = file_get_contents('https://www.google.com/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8&source=pshome-c-0-0&sa=X&ved=0ahUKEwjNmfTbk7XKAhVE36YKHYwuAhQQ7j8IBw#q=apple+iphone+6s&tbm=shop');
			$rvtml = mb_convert_encoding($rvtml, 'UTF-8', 'EUC-KR');
			//$rvtml = file_get_contents($temp_url);
			return $rvtml;
			//print ($temp_url);
			
			// err check
			
			$rvtml = substr($rvtml, strpos($rvtml, "rating__product"));
			
			
			//$rvtml = substr()
			
			
			
			//array_push($url, $temp_url);
				
			$html = substr($html, strpos($html, "<a") + 1);
		}
		
		
		$test = file_get_contents('https://www.google.co.kr/search?q=apple+iphone+6s&tbm=?');
		//$test = mb_convert_encoding($test, 'UTF-8', 'EUC-KR');
		print ($test);
		return;
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		while ($loop = strpos($html, "_tpb")){
			$html = substr($html, strpos($html, "<a"));
			$html = substr($html, strpos($html, "href=\"") + 6);
			$temp_url = substr($html, 0, strpos($html, "\""));
			
			array_push($url, $temp_url);
			
			$html = substr($html, strpos($html, "<a") + 1);
		}
		
		print_r ($url);
		return;
		
		
		
		
		
		
		
		
		
		
		
		
		$page = 'google';
		return view($page, array('page' => $page/*additional data*/));
	}
}