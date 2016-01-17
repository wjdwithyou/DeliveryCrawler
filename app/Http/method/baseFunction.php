<?php


	/*
	 * 인풋 에러 체크 함수
	 */
	function inputErrorCheck($parameter, $columnName)
	{
		if( isset($parameter) && ($parameter!='') ){
			return TRUE;
		}
		else{
			echo json_encode( array('code' => '400', 'msg' => 'invalid input at '.$columnName));
			return FALSE;
		}
	}

 	/*
     * 카카오톡 액세스토큰을 이용해서 사용자 ID를 반환하는 함수
     */
    function getIDKakao($accessToken)
    {
    	
      	$headers    = array('Authorization: Bearer '.$accessToken, 'Content-type: application/x-www-form-urlencoded:charset=utf-8');
     	$opts       = array(
         	CURLOPT_URL       		=> 'https://kapi.kakao.com/v1/user/me',
         	CURLOPT_POST       		=> true,
         	CURLOPT_HEADER      	=> false,
         	CURLOPT_HTTPHEADER    	=> $headers,
         	CURLOPT_RETURNTRANSFER 	=> true
        );
      	
      	$ch      = curl_init();
      	curl_setopt_array($ch, $opts);
      	
      	$result   = curl_exec($ch);
      	curl_close($ch);
      	
      	$result = json_decode($result,true);
 
      	return $result['id'];
    }


    /*
     * 페이스북 액세스토큰을 이용해서 사용자 ID를 반환하는 함수
     */
	function getIdFacebook($accessToken)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=".$accessToken);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);

		//convert  response
		$output = json_decode($output);

		//handle error; error output
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200)
		{
			var_dump($output);
		}

		var_dump($output);
 
		curl_close($ch);
	}

    /*
     *  구글 액세스토큰을 이용해서 사용자 ID를 반환하는 함수
     */
    function getIdGoogle($accessToken)
    {
    	
		if(	!(	inputErrorCheck($accessToken, 'accessToken')))
			return ;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$accessToken);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);

		//convert  response
		$output = json_decode($output);

		//handle error; error output
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200)
		{
			var_dump($output);
		}

		var_dump($output);
 
		curl_close($ch);		
    }


	/*
	 *	이미지 사진 등록 함수
	 */
    /*
    function insertImg($target_idx, $document_idx, $image, $ext, $image_num){
    	if(	!(inputErrorCheck($target_idx, 'target_idx')
    		&&inputErrorCheck($document_idx, 'document_idx')
    		&&inputErrorCheck($image, 'image')
    		&&inputErrorCheck($image_num, 'image_num')))
    		return;
    	
    	$s3 = App::make('aws')->createClient('s3');
    	
    	switch ($target_idx){
    		case 'num':	// temp
    			$image_name = $document_idx.'_image'.$image_num.'.'.$ext;
    			$s3->putObject(array(
    				'Bucket' 	=> 'boxone-image/advertise',
    				'Key'		=> 'advertise/'.$image_name,
    				'SourceFile'	=> $image,
    			));
    			break;
    		default:
    			break;
    	}
    	
    	return array('code' => '200', 'data' => 'image upload success');
    }
    */
    
    /*
	function insertImg($target_idx, $document_idx, $image, $ext, $image_num)
	{
		if( ! (inputErrorCheck($target_idx, 'target_idx')
			  && inputErrorCheck($document_idx, 'document_idx')
			  && inputErrorCheck($image, 'image')
			  && inputErrorCheck($image_num, 'image_num')))
				return;
		
		//$image->move("/tmp", "test.jpg");
			
		$s3 = App::make('aws')->createClient('s3');
//		$image = Image::make('/tmp/test.jpg')->fit(317,374)->save('/tmp/test_317.jpg');
//		$image = Image::make('/tmp/test.jpg')->fit(164,167)->save('/tmp/test_164.jpg');

		switch ($target_idx) {
			// community
			case '1':
			$image_name = $document_idx.'_image'.$image_num.'.'.$ext;
			$s3->putObject(array(
				'Bucket'	=> 'boxone-image',
				'Key'		=> 'community/'.$image_name,
				'SourceFile'	=> $image,
				));
			break;
			
			// member
			case '2':
			$image_name = $document_idx.'_image.'.$ext;
			$s3->putObject(array(
				'Bucket'	=> 'boxone-image',
				'Key'		=> 'profile/'.$image_name,
				'SourceFile'	=> $image,
				));				
			break;

			// community complain
			case '3':
			$s3->putObject(array(
				'Bucket'	=> 'boxone_image/community_complain',
				'Key'		=> $document_idx.'_image'.$image_num.'.jpg',
				'SourceFile'	=> '/tmp/test.jpg',
				));				
			$result = DB::update('update community_complain set image= CONCAT(image, "?") where idx=?', array($image_name, $document_idx));
			break;

			// direct product
			case '4':
			$s3->putObject(array(
				'Bucket'	=> 'boxone_image/direct_product',
				'Key'		=> $document_idx.'_image'.$image_num.'.jpg',
				'SourceFile'	=> '/tmp/test.jpg',
				));				
			$result = DB::update('update direct_product set image= CONCAT(image, "?") where idx=?', array($image_name, $document_idx));
			break;

			default:
			break;
		}
			
		//File::delete("/tmp/test.jpg");

//		File::delete("/tmp/test_317.jpg");
//		File::delete("/tmp/test_164.jpg");

		return array('code' => '200', 'data' => 'image uplaod success');
				
	}
	*/
    
	/*
	 * YYYY-MM-DD HH:MM:SS => YYYY-MM-DD
	 */
	function getDateFromDatetime($dateTime)
	{
		return substr($dateTime, 0, 11);
	}
	
	/*
	 * YYYY-MM-DD HH:MM:SS => HH:MM:SS
	 */
	function getTimeFromDatetime($dateTime)
	{
		return substr($dateTime, 12);
	}
	
	/*
	 * 로그인 체크
	 * 원하는 로그인 상태가 아니면 접근거부 / 로그인창 열기
	 */
	function loginStateChk($chk)
	{
		if (session_id() == '')	session_start();
		$logined = !empty($_SESSION['idx']);
		if ($logined == $chk)
		{
			return true;
		}
		else
		{
			$host = $_SERVER['HTTP_HOST'];

			if (isset($_SERVER['HTTP_REFERER']))
			{
				$bef = $_SERVER['HTTP_REFERER'];

				// 앞 페이지가 있을 때
				if ($logined)
				{
					header("Location: http://".$host."/Mypage/index");
					die();
				}
				else 
				{
					setcookie("need_login", "1", time()+60, "/");
					if (!strpos($bef,"Mypage"))
						header("Location: ".$bef);
					else
						header("Location: http://".$host);
					die();
				}
			}
			// 앞 페이지가 없을 때
			else 
			{
				if ($logined)
				{
					header("Location: http://".$host."/Mypage/index");
					die();
				}
				else 
				{
					header("Location: http://".$host);
					die();
				}
			}
		}
	}
	
	function cutDateAsToday($date)
	{		
		if (date('Y-m-d') == substr($date, 0, 10))
			return substr($date, 11, 5);
		else
			return substr($date, 0, 10);
	}