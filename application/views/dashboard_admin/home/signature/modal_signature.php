<style>
		
		#sign_btn {
			color: #fff;
			background: #2b62ba;
			padding: 5px;
			border: none;
			border-radius: 5px;
			font-size: 10px;
			margin-top: 10px;
		}
		#signArea{
			width:250px;
			margin: 5px auto;
		}
		.sign-container {
			width: 99%;
			margin: auto;
		}
		.tag-ingo {
			font-family: cursive;
			font-size: 12px;
			text-align: left;
			font-style: oblique;
		}
		.center-text {
			text-align: center;
		}
    .tag-info {
      font-family: cursive;
      font-size: 12px;
      text-align: left;
      font-style: oblique;
    }
</style>
<div class="card card-navy">
  <div class="card-body">
    <div id="signArea" >
		<h2 class="tag-ingo">Put signature below,</h2>
	      <ul class="sigNav">
	        <li class="clearButton"><a href="#clear">Clear</a></li>
	      </ul>
        <div class="sig sigWrapper" style="height:auto;">
          <div class="typed"></div>
          <canvas class="sign-pad" id="sign-pad" width="230" height="150"></canvas>
        </div>
        
        <button type='button' id="sign_btn" onclick ="save_sign()">Save Signature</button>
	</div>
    
  </div>
</div>

<link href="<?= base_url() ?>asset/signature/main_style/assets/jquery.signaturepad.css" rel="stylesheet" />
<script type='text/javascript' src="<?= base_url() ?>asset/signature/main_style/html2canvas.js"></script>
<script>
		$(document).ready(function() {
			$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:200});
		});

    // function save_sign() {
    //   html2canvas([document.getElementById('sign-pad')], {
		// 		onrendered: function (canvas) {
		// 			var canvas_img_data = canvas.toDataURL('image/png');
		// 			var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
    //       console.log(img_data);
    //       var element = document.getElementById('signature_pic');
    //       element.style = '';
    //       document.getElementById("signature_pic").style.backgroundImage = "url('data:image/(png|jpg);base64,"+ img_data +"')";

		// 		}
		// 	});
    // }
    function save_sign() {
      //window.scrollTo(100, 0);kt_edit_signature
      // html2canvas(element , {
      //     scrollX: -window.scrollX,
      //     scrollY: -window.scrollY,
      //     windowWidth: document.documentElement.offsetWidth,
      //     windowHeight: document.documentElement.offsetHeight
      // })
      html2canvas([document.getElementById('sign-pad')], {
        //scrollY: -window.scrollY,
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
          console.log(img_data);
          var element = document.getElementById('signature_pic');
          element.style = null;
          document.getElementById("signature_pic").style.backgroundImage = "url('data:image/(png|jpg);base64,"+ img_data +"')";
          document.getElementById("signature_pic").style.width = "250px";
          document.getElementById("signature_pic").style.height = "150px";
          document.getElementById("kt_edit_signature").classList.add("kt-avatar--changed");
          document.getElementById("dig_signature").value = img_data;
				}
			});
    }

</script>