<!DOCTYPE html>
	<head>
		<title>delivery_inquire</title>
	</head>
	<body>
		<?php if ($result['company'] == 'postoffice') :?>
			<?=$result['company']?><br>
			<?=$result['num']?><br>
			<?=$result['sender']?><br>
			<?=$result['send_date']?><br>
			<?=$result['receiver']?><br>
			<?=$result['receive_date']?><br>
			<?=$result['state']?><br>
			
			<?php foreach ($result['state_detail'] as $i) :?>
				<?=$i['date']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['time']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['location']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['state']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br>
			<?php endforeach;?>
		<?php else :?>
			<?=$result['company']?><br>
			<?=$result['num']?><br>
			<?=$result['sender']?><br>
			<?=$result['send_date']?><br>
			<?=$result['receiver']?><br>
			
			<?php foreach ($result['state_detail'] as $i) :?>
				<?=$i['date']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['time']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['location']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$i['state']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br>
			<?php endforeach;?>
		<?php endif;?>
	</body>
</html>