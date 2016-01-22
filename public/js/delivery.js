$(document).ready(function(){
	$("#company").change(function(){
		$("#company_direct").val("");
		$("#company_direct").attr("readonly", (($("#company").val() == 'direct')? false: true));
	});
});

function dvInquire(){
	var adr_ctr = $("#adr_ctr").val();
	
	if ($("#company").val() == 'direct'){
		alert("지원하지 않는 택배사입니다.");
		return;
	}
	
	var company = $("#company").val();
	var num = $("#num").val();
	
	//var company = ($("#company").val() == 'direct')? $("#company_direct").val(): $("#company").val();
	
	
	if (company == 'base'){
		alert("택배사를 선택해주세요.");
		return;
	}
	
	if (num == ''){
		alert("운송장번호를 입력해주세요.");
		return;
	}
	
	// num length cjeck
	if (company == 'postoffice'){
		if (num.length != 13){
			alert("운송장번호 13자리를 입력해주세요.");
			return;
		}
	}
	
	if (company == 'logen'){
		if (num.length != 11){
			alert("운송장번호 11자리를 입력해주세요.");
			return;
		}
	}
	
	// impl other company
	
	
	
	location.href = adr_ctr + "Delivery/indexInquire?company=" + company + "&num=" + num;
	
	/*
	$.ajax({
		url: adr_ctr + "Inquiry/indexInquire",
		type: 'post',
		async: false,
		timeout: 10000,
		data:{
			//idx
			company: company,
			num: num
		},
		success: function(result){
			//alert(JSON.stringfy(result)));
			result = JSON.parse(result);
			
			// impl.
		},
		error: function(request, status, error){
			console.log(request.responseText);
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	*/
}

// check regular expression?

function attackGoogle(){
	var adr_ctr = $("#adr_ctr").val();
	
	location.href = adr_ctr + "Google/test";
}