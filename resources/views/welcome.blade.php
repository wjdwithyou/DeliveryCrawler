<!DOCTYPE html>
<html>
    <head>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
 
<script>
$.fn.setPreview = function(opt){
    "use strict"
    var defaultOpt = {
        inputFile: $(this),
        img: null,
        w: 200,
        h: 200
    };
    $.extend(defaultOpt, opt);
 
    var previewImage = function(){
        if (!defaultOpt.inputFile || !defaultOpt.img) return;
 
        var inputFile = defaultOpt.inputFile.get(0);
        var img       = defaultOpt.img.get(0);
 
        // FileReader
        if (window.FileReader) {
            // image 파일만
            if (!inputFile.files[0].type.match(/image\//)) return;
 
            // preview
            try {
                var reader = new FileReader();
                reader.onload = function(e){
                    img.src = e.target.result;
                    img.style.width  = defaultOpt.w+'px';
                    img.style.height = defaultOpt.h+'px';
                    img.style.display = '';
                }
                reader.readAsDataURL(inputFile.files[0]);
            } catch (e) {
                // exception...
            }
        // img.filters (MSIE)
        } else if (img.filters) {
            inputFile.select();
            inputFile.blur();
            var imgSrc = document.selection.createRange().text;
 
            img.style.width  = defaultOpt.w+'px';
            img.style.height = defaultOpt.h+'px';
            img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\""+imgSrc+"\")";            
            img.style.display = '';
        // no support
        } else {
            // Safari5, ...
        }
    };
 
    // onchange
    $(this).change(function(){
        previewImage();
    });
};
 
 
$(document).ready(function(){
    var opt = {
        img: $('#img_preview'),
        w: 230,
        h: 200
    };
 
    $('#input_file').setPreview(opt);
});
</script>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin-top: 3%;
                width: 100%;
                font-weight: 100;
                
              
            }

            .menu_selectbox {
			    width: 235px;
			    height: 20px;
			    padding-left: 6px;
			    background: #fff url(https://s3-ap-northeast-1.amazonaws.com/boxone-image/select_arrow_pink.png) no-repeat 90% center;
			    text-indent: 0.01px;
			    text-overflow: "";
			    color: #F15A63;
			    -webkit-appearance: none;
			    -moz-appearance: none;
			    appearance: none;
			}
			.text {
				width:230px;
			}
			textarea{
				width: 300px;
				height:300px;
			}
			table, th, td {
				padding:5px;
				border-collapse: collapse;
			    border: 1px solid #F15A63;
			    background: #fff;
			    text-indent: 0.01px;
			}
        </style>
    </head>
    <body>
 	<h1 align="center">Admin menu</h1>
    	<table align="center">
    	  <tr>
		    <td>Category</td>
		    <td>
		    	<select class="menu_selectbox">
	       		<option>shoppingbox_01</option>
	       		<option>shoppingbox_02</option>
	       		<option>shoppingbox_03</option>
	       		<option>shoppingbox_04</option>
	       		<option>shoppingbox_05</option>
	  			</select>
	  		</td>
		  </tr>
		  <tr>
		    <td>ID</td>
		    <td><input type="text" class="text" placeholder="ID"></td>
		  </tr>
		  <tr>
		    <td>Name</td>
		    <td><input type="text" class="text" placeholder="NAME"></td>
		  </tr>
		  <tr>
		    <td rowspan="2">Image</td>
		    <td><input type="file" id="input_file" placeholder="IMG"></td>
		  </tr>
		  <tr>
		    <td height="170"><img id="img_preview" style="display:none;"/></td>
		  </tr>
		  <tr>
		    <td colspan="2">Coment</td>
		  </tr>
		  <tr>
		    <td colspan="2"><textarea placeholder="Comment"></textarea></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center">
		    	<input type="reset" value="Reset">
		    	<input type="submit" value="OK">
		    </td>
		  </tr>
		</table>
    </body>
</html>
