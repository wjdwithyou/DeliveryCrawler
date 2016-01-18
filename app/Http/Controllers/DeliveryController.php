<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// model
use Request;

class DeliveryController extends Controller{
	// CJ대한통운			8524859560		// va_num
	// 우체국택배			6012647424303
	// 한진택배
	// 현대택배
	// 로젠택배				99061979995
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
			case 'cj':
				$url = 'https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no='.$num;
				
				//$html = file_get_contents('https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no='.$num);
				
				$ch = curl_init();
				
				curl_setopt_array($ch, array(
						CURLOPT_RETURNTRANSFER => 1,
						CURLOPT_URL => 'https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no='.$num,
				));
				
				//$result = curl_exec($ch);
				curl_close($ch);
				
				$result['test'] = $ch;
				
				
				/*
				$purl = parse_url($url);
				
				$host = $purl['host'];
				$path = $purl['path'];
				$port = '443';
				
				$hostport = $purl['host'].':'.$port;
				$pathquery = $purl['path'].'?'.$purl['query'];
				
				$timeout = 10;
				$response = '';
				
				$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
				
				if (!$fp){
					echo ("error");
					return;
				}
				
				fputs($fp,	"GET $pathquery HTTP/1.1\r\n".
							"Host: $hostport\r\n".
							"Accept: ...".
							"Accept-Encoding: gzip, deflate, sdch\r\n".
							"Accept-Language: ko-KR,ko;q=0.8,en-US;q=0.6,en;q=0.4\r\n".
							"Cookie: WMONID=GCuTHd4pTju; _ga=GA1.3.657622120.1453096370; _gat=1; JSESSIONID=wW0GOS8r4otE4UZxOFYlVp3n1S6R3Uc2ULYpDnucDlKPO5bQO7L9aFl1oVCG3HEC.edtdwas4_servlet_engine1\r\n".
							"Upgrade-Insecure-Requests: 1".
							"Referer: $url\r\n".
							"User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36\r\n\r\n");
				
				while ($line = fread($fp, 4096))
					$response .= $line;
				
				fclose($fp);
				
				$response = substr($response, strpos($response, "\r\n\r\n") + 4);
				
				$result['test'] = $response;
				*/
				
				/*
				$url = 'https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no='.$num;
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
				
				
				//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
				//curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				
				$g = curl_exec($ch);
				
				curl_close($ch);
				
				$result['test'] = $g;
				*/
				
				//$html = file_get_contents('https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no='.$num);
				
				
				// temp
				/*
				$postdata = "fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=$num&nextpage=parcel%2Fpa_004_r.jsp";
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://www.doortodoor.co.kr/main/doortodoor.do");
				//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
				curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				ob_start();
				$res = curl_exec($ch);
				$buffer = ob_get_contents();
				ob_end_clean();
				if (!$buffer)
				{
					$html = "Curl Fetch Error : ".curl_error($ch);
					return view($page, array('page' => $page, 'code' => 0));
				}
				else
					$html = $buffer;
				curl_close($ch);
				*/
				// temp end
				
			
				break;
				
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