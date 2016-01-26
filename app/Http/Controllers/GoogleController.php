<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ProductModel;
use App\Http\models\ReviewModel;
use Request;

class GoogleController extends Controller{
	
	/*
	// 160126 J.Style
	// Between $tStart and $tFinish, insert your code what you want to check execution time.
	public function timeTest(){
		$temp = 0;
		
		for ($i = 1; $i <= 100; ++$i){
			$tStart = explode(" ", microtime());	// start
				
			$ch = curl_init();
				
			curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=iphone+6s&tbm=shop&cad=h");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/shopping');
				
			$html = curl_exec($ch);
				
			curl_close($ch);
				
			$tFinish = explode(" ", microtime());	// end
			$tElapsedMicroSec = ($tFinish[1] - $tStart[1]) + ($tFinish[0] - $tStart[0]);
			
			$temp += $tElapsedMicroSec;
			
			print ($i." :: ".$tElapsedMicroSec. " // ".$temp."<br/>");
		}
	}
	*/
	
	public function crawlTest(){	// just test function.
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=Cycle+ring&tbm=shop&cad=h");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/shopping');
		
		$html = curl_exec($ch);
		
		curl_close($ch);
		
		return $html;
		
		$html = substr($html, strpos($html, "Merchant links are sponsored"));
		
		$html = substr($html, strpos($html, "<a"));
		
		$html = substr($html, strpos($html, "product/") + 8);
		$num = substr($html, 0, strpos($html, "?"));
		
		return $num;
		
		return file_get_contents('http://www.google.com/shopping/product/'.$num.'/reviews');
		
		//$page = 'google';
		//return view($page, array('page' => $page/*additional data*/));
	}
	
	public function crawlReview(){
		ini_set('max_execution_time', -1);
		
		$param = Request::input('param');	// hotdeal, product
		
		$pdModel = new ProductModel();
		$rvModel = new ReviewModel();
		
		$List = ($param == 'hotdeal')? $pdModel->getHotdealAll(): $pdModel->getProductAll();	// idx begins 1
		
		$fp = fopen($param."_log.txt", "a");
		
		for ($i = 0; $i < count($List['data']); ++$i){
			$remain = $List['data'][$i]->name;
			$rename = '';
			$txt = '';
			
			while (true){
				if (!strpos($remain, " ")){
					$rename .= $remain;
					break;
				}
				
				$rename .= substr($remain, 0, strpos($remain, " "));
				$rename .= "+";
				$remain = substr($remain, strpos($remain, " ") + 1);
			}
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=".$rename."&tbm=shop&cad=h");
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
			
			for ($j = 0; $j < strlen($num); ++$j){
				switch($num[$j]){
					case '0':
					case '1':
					case '2':
					case '3':
					case '4':
					case '5':
					case '6':
					case '7':
					case '8':
					case '9':
						break;
						
					default:
						$j = strlen($num);
						$num = '';
						break;
				}
			}
			
			if ($num == '')		// if product number doesn't exist, process next product.
				continue;
			
			$txt .= "idx ".($i + 1)." | ".$num."\r\n";
			
			$review = file_get_contents('http://www.google.com/shopping/product/'.$num);
			
			if (strpos($review, "The product could not be found"))
				$txt .= "잘못된 상품번호('.$num.')입니다.\r\n";
			else if (!strpos($review, "\"review-section-results\""))
				$txt .= "리뷰가 없습니다.\r\n";
			else{
				$review = substr($review, strpos($review, "\"review-section-results\""));
				
				$reviews = array();
				
				while (strpos($review, "_G")){
					$temp = array();
					
					$review = substr($review, strpos($review, "review-title") + 14);
					$temp['title'] = substr($review, 0, strpos($review, "<"));
					
					$review = substr($review, strpos($review, "aria-label") + 12);
					$temp['star'] = substr($review, 0, strpos($review, "\""));
					
					$review = substr($review, strpos($review, "</span>"));
					
					$review = substr($review, strpos($review, "By ") + 3);
					$temp['writer'] = substr($review, 0, strpos($review, "  "));
					
					$review = substr($review, strpos($review, "- ") + 2);
					$temp['date'] = substr($review, 0, strpos($review, "   "));
					
					$review = substr($review, strpos($review, "review-content"));
					
					$review = substr($review, strpos($review, "<span>") + 6);
					$temp['alt'] = substr($review, 0, strpos($review, "</span>"));
					
					array_push($reviews, $temp);
					
					// for DB
					if ($param == 'hotdeal')
						$rvModel->createHotdeal($i+1, $temp['star'], $temp['writer'], $temp['title'], $temp['date'], $temp['alt']);
					else
						$rvModel->createProduct($i+1, $temp['star'], $temp['writer'], $temp['title'], $temp['date'], $temp['alt']);
				}
				
				// idx (=$i+1) | product_num
					// review 1
					// star | title | writer | date
					// alt
					// review 2
					// ...
				//	idx	(next)
				
				for ($j = 0; $j < count($reviews); ++$j){
					$txt .= "review ".($j + 1)."\r\n";
					$txt .= $reviews[$j]['star']." | ".$reviews[$j]['title']." | ".$reviews[$j]['writer']." | ".$reviews[$j]['date']."\r\n";
					$txt .= $reviews[$j]['alt']."\r\n";
				}
			}
			
			$txt .= "\r\n";
			
			fwrite($fp, $txt);
		}
		
		fclose($fp);
	}
}

			/*
			 * jstyle
			 * google/shopping/..
			 * not crawl->html
			 * 
			if ($num != ''){
				$review = file_get_contents('http://www.google.com/shopping/product/6133307566775116650');
				//$review = file_get_contents('http://www.google.com/shopping/product/'.$num.'/reviews');
			
				if (strpos($review, "The product could not be found")){		// 이건 crawl source에서!
					fclose($fp);
					return '잘못된 상품번호('.$num.')입니다.';
				}
			
				$review = substr($review, strpos($review, "rev-content"));
			
				if (!strpos($review, "_dpc")){
					fclose($fp);
					return '리뷰가 없습니다.';
				}
			
				$reviews = array();
			
				while (strpos($review, "_dpc")){
					$temp = array();
						
					$review = substr($review, strpos($review, "aria-label") + 12);
					$temp['star'] = substr($review, 0, strpos($review, "\""));
						
					$review = substr($review, strpos($review, "_hSb") + 6);
					$temp['title'] = substr($review, 0, strpos($review, "<"));
						
					$review = substr($review, strpos($review, "&ndash") + 8);
					$temp['date'] = substr($review, 0, strpos($review, "<"));
						
					$review = substr($review, strpos($review, "_BYh"));
						
					$review = substr($review, strpos($review, "shop__secondary") + 17);
					$temp['writer'] = substr($review, 0, strpos($review, " &ndash"));
						
					$review = substr($review, strpos($review, "_yXg") + 6);
					$temp['provider'] = substr($review, 0, strpos($review, "<"));
						
					$review = substr($review, strpos($review, "_cX"));
						
					$review = substr($review, strpos($review, ">") + 1);
					$temp['alt'] = substr($review, 0, strpos($review, "<"));
						
					array_push($reviews, $temp);
				}
			
				print_r($reviews);
				return;
			}
			*/