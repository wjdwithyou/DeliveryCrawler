<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// model
use Request;

class DeliveryController extends Controller{
	// CJ대한통운			
	// 우체국택배			6012647424303
	// 한진택배
	// 현대택배
	// 로젠택배			99061979995
	// KG로지스
	// CVSnet 편의점택배
	// KGB택배
	// 경동택배
	// 대신택배
	// 일양로지스
	// 합동택배
	// GTX로지스
	// 건영택배
	// 천일택배
	// 한의사랑택배
	// 굿투럭
	// FedEx
	// EMS
	// DHL
	// UPS
	// TNTExpress
	
	public function index(){
		$page = 'delivery';
		return view($page, array('page' => $page/*additional data*/));
	}
	
	public function indexInquire(){
		// session
		
		$company = Request::input('company');
		$num = Request::input('num');
		
		$result = array();
		
		$result['company'] = $company;
		$result['num'] = $num;
		
		switch($company){
			case 'postoffice':
				$html = file_get_contents('https://service.epost.go.kr/trace.RetrieveDomRigiTraceList.comm?displayHeader=N&sid1='.$num);
				
				if (strpos($html, "배달정보를 찾지 못했습니다"))
					return 'postoffice: num error';	// temp
				
				$html = substr($html, strpos($html, $num));
				
				$html = substr($html, strpos($html, "<td>") + 4);
				$result['sender'] = substr($html, 0, strpos($html, "<"));
				
				$html = substr($html, strpos($html, ">") + 1);
				$result['send_date'] = substr($html, 0, strpos($html, "<"));
				
				$html = substr($html, strpos($html, "<td>") + 4);
				$result['receiver'] = substr($html, 0, strpos($html, "<"));
				
				$html = substr($html, strpos($html, ">") + 1);
				$result['receive_date'] = substr($html, 0, strpos($html, "<"));
				
				$html = substr($html, strpos($html, "<td>") + 1);
				
				$html = substr($html, strpos($html, "<td>") + 4);
				$result['state'] = substr($html, 0, strpos($html, "<"));
				
				$state_detail = array();
				
				$html = substr($html, strpos($html, "처리현황") + 1);
				$html = substr($html, strpos($html, "처리현황"));
				
				while ($loop = strpos($html, "<tr>")){
					$temp = array();
					
					$html = substr($html, $loop);
					
					$html = substr($html, strpos($html, "<td>") + 4);
					$temp['date'] = substr($html, 0, strpos($html, "<"));
					
					$html = substr($html, strpos($html, "<td>") + 4);
					$temp['time'] = substr($html, 0, strpos($html, "<"));
					
					$html = substr($html, strpos($html, "onkeypress"));
					
					$html = substr($html, strpos($html, ">") + 1);
					$temp['location'] = substr($html, 0, strpos($html, "<"));
					
					$html = substr($html, strpos($html, "<td>") + 4);
					$temp['state'] = substr($html, 0, strpos($html, "&nbsp"));	// need trim?
					
					if (strpos($temp['state'], "배달준비"))
						$temp['state'] = '배달준비';
					
					array_push($state_detail, $temp);
				}
				
				//array_push($result, $state_detail);
				$result['state_detail'] = $state_detail;
				break;
				
			case 'logen':
				$html = file_get_contents('http://www.ilogen.com/iLOGEN.Web.New/TRACE/TraceDetail.aspx?gubun=fromview&slipno='.$num);
				$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
				
				if (strpos($html, "배송자료를 조회할 수 없습니다"))
					return 'logen: num error';	// temp
				
				$html = substr($html, strpos($html, "tbTakeDt"));
				
				$html = substr($html, strpos($html, "value") + 7);
				$result['send_date'] = substr($html, 0, strpos($html, "\""));
				
				$html = substr($html, strpos($html, "tbSndCustNm"));
				
				$html = substr($html, strpos($html, "value") + 7);
				$result['sender'] = substr($html, 0, strpos($html, "\""));
				
				$html = substr($html, strpos($html, "tbRcvCustNm"));
				
				$html = substr($html, strpos($html, "value") + 7);
				$result['receiver'] = substr($html, 0, strpos($html, "\""));
				
				$state_detail = array();
				
				$html = substr($html, strpos($html, "gridTrace"));
				
				while (true){
					$html = substr($html, strpos($html, "<tr"));
					$html = substr($html, strpos($html, "<td"));
					
					if (!strpos($html, "gridTrace"))
						break;
					
					$temp = array();
					
					$html = substr($html, strpos($html, ">") + 1);
					$temp['date'] = substr($html, 0, strpos($html, " "));
					
					$html = substr($html, strpos($html, " ") + 1);
					$temp['time'] = substr($html, 0, strpos($html, "<"));
					
					$html = substr($html, strpos($html, "<td"));
					
					$html = substr($html, strpos($html, ">") + 1);
					$temp['location'] = substr($html, 0, strpos($html, "<"));
					
					$html = substr($html, strpos($html, "<td"));
					
					$html = substr($html, strpos($html, ">") + 1);
					$temp['state'] = substr($html, 0, strpos($html, "<"));
					
					array_push($state_detail, $temp);
				}
				
				$result['state_detail'] = $state_detail;
				break;
				
			default:
				// impl.
				break;
		}
		
		$page = 'delivery_inquire';
		return view($page, array('page' => $page, 'result' => $result));
	}
}