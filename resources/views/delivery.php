<!DOCTYPE html>
	<head>
		<?php 
			include ("libraries.php");
		?>
		<title>inquiry</title>
	</head>
	<body>
		<form>
		
			<!-- list -->
		
			<table align="center" bordercolor="black">
				<tr>
					<td>회사명</td>
					<td>
						<select id="company">
							<option value="base">택배사를 선택하세요</option>
							<option value="cj">CJ대한통운</option>
							<option value="postoffice">우체국택배</option>
							<option value="logen">로젠택배</option>
							<option value="direct">직접입력</option>
							<!--
							<option value="cj">CJ대한통운</option>
							<option value="postoffice">우체국택배</option>
							<option value="hanjin">한진택배</option>
							<option value="hyundai">현대택배</option>
							<option value="logen">로젠택배</option>
							<option value="kg">KG로지스</option>
							<option value="cvs">CVSnet 편의점택배</option>
							<option value="kgb">KGB택배</option>
							<option value="kd">경동택배</option>
							<option value="daesin">대신택배</option>
							<option value="ilyang">일양로지스</option>
							<option value="hd">합동택배</option>
							<option value="gtx">GTX로지스</option>
							<option value="love">한의사랑택배</option>
							<option value="gl">굿투럭</option>
							<option value="fedex">FedEx</option>
							<option value="ems">EMS</option>
							<option value="dhl">DHL</option>
							<option value="ups">UPS</option>
							<option value="tnt">TNTExpress</option>
							-->
						</select>
						<input type="text" class="form-control" id="company_direct" readonly/>
					</td>
				</tr>
				<tr>
					<td>운송장번호</td>
					<td><input type="text" class="form-control" id="num"/></td>
				</tr>
				<tr align="center">
					<td colspan="2"><button type="button" onclick="dvInquire();">조회하기</button></td>
				</tr>
			</table>
			<button type="button" onclick="attackGoogle();">구글을 침략한다</button>
			<button type="button" onclick="collectReview();">리뷰 모으기</button>
		</form>
	</body>
</html>