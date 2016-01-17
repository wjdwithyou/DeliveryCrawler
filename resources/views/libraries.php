<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<meta name="csrf-token" content="<?php echo csrf_token();?>"/>

<?php
	/*
	$adr_js = "http://52.69.26.243/js/";
	$adr_css = "http://52.69.26.243/css/";
	$adr_img = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/";
	$adr_btstrp = "http://52.69.26.243/bootstrap/";
	$adr_ctr = "http://52.69.26.243/";

	$adr_js = "http://166.104.125.62:8000/js/";
	$adr_css = "http://166.104.125.62:8000/css/";
	$adr_img = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/";
	$adr_btstrp = "http://166.104.125.62:8000/bootstrap/";
	$adr_ctr = "http://166.104.125.62:8000/";
	*/
	/*
	// test server
	$adr_js = "http://platformstory.iptime.org:8091/js/";
	$adr_css = "http://platformstory.iptime.org:8091/css/";
	$adr_img = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/";
	$adr_btstrp = "http://platformstory.iptime.org:8091/bootstrap/";
	$adr_ctr = "http://platformstory.iptime.org:8091/";
	*/
	// local
	$adr_js = "http://localhost:8000/js/";
	$adr_css = "http://localhost:8000/css/";
	$adr_img = "http://localhost:8000/img/";
	//$adr_img = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/";
	$adr_btstrp = "http://localhost:8000/bootstrap/";
	$adr_ctr = "http://localhost:8000/";
?>

<input type="hidden" id="adr_js" value="<?=$adr_js?>"/>
<input type="hidden" id="adr_css" value="<?=$adr_css?>"/>
<input type="hidden" id="adr_img" value="<?=$adr_img?>"/>
<input type="hidden" id="adr_ctr" value="<?=$adr_ctr?>"/>

<?php
	if (session_id() == '')
		session_start();
	
	$logined = !empty($_SESSION['idx']);
?>

<?php if ($logined) :?>
	<input type="hidden" id="logined" value="1"/>
<?php else :?>
	<input type="hidden" id="logined" value="0"/>
<?php endif;?>

<link rel="stylesheet" href="<?=$adr_btstrp?>css/bootstrap.css"/>
<link rel="stylesheet" href="<?=$adr_btstrp?>css/bootstrap-theme.css"/>
<link rel="stylesheet" href="<?=$adr_css?>carousel.css"/>

<script type="text/javascript" src="<?=$adr_btstrp?>js/jquery-1.11.3.min.js"></script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<script type="text/javascript" src="<?=$adr_btstrp?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$adr_btstrp?>js/ie-emulation-modes-warning.js"></script>
<script type="text/javascript" src="<?=$adr_btstrp?>js/ie10-viewport-bug-workaround.js"></script>






<!-- social login js -->






<link rel="stylesheet" href="<?=$adr_css?><?=$page?>.css">
<script type="text/javascript" src="<?=$adr_js?><?=$page?>.js"></script>






<!-- header,footer 관련 css, js -->





<link rel="icon" href="<?=$adr_img?>brower_logo.png">
<title>BOXONE</title>