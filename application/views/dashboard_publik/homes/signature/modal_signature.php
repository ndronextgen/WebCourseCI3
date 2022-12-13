<style type="text/css">
	.pager li a.active {
		background-color: #008096;
		color: #fff;
		border: 1px solid #008096;
	}

	#sign_btn {
		color: #fff;
		background: #2b62ba;
		padding: 5px;
		border: none;
		border-radius: 5px;
		font-size: 10px;
		margin-top: 10px;
	}

	#cancel_btn {
		color: #fff;
		background: #f04f41;
		padding: 5px;
		border: none;
		border-radius: 5px;
		font-size: 10px;
		margin-top: 10px;
	}

	#signArea {
		width: 280px;
		margin: 15px auto;
	}

	.sign-container {
		width: 99%;
		margin: auto;
	}

	.sign-preview {
		width: 280px;
		height: 150px;
		border: solid 1px #CFCFCF;
		margin: 10px 5px;
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
		<div id="signArea">
			<ul class="sigNav">
				<li class="clearButton"><a href="#clear">Clear</a></li>
			</ul>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="250" height="150"></canvas>
			</div>
			<button type='button' id="sign_btn" onclick="save_sign()">Save Signature</button>
			<button type='button' id="cancel_btn" onclick="cancel_sign()">Cancel Signature</button>
		</div>

	</div>
</div>

<link href="<?= base_url() ?>asset/signature/main_style/assets/jquery.signaturepad.css" rel="stylesheet" />
<script type='text/javascript' src="<?= base_url() ?>asset/signature/main_style/html2canvas.js"></script>

<script>
	$(document).ready(function() {
		$('#signArea').signaturePad({
			drawOnly: true,
			drawBezierCurves: true,
			lineTop: 200
		});
	});

	function save_sign() {
		html2canvas([document.getElementById('sign-pad')], {
			onrendered: function(canvas) {
				var canvas_img_data = canvas.toDataURL('image/png');
				var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
				console.log(img_data);
				var element = document.getElementById('signature_pic');
				element.style = '';
				document.getElementById("signature_pic").style.backgroundImage = "url('data:image/(png|jpg);base64," + img_data + "')";
				//document.getElementById("kt_edit_signature").classList.add("kt-avatar--changed");
				document.getElementById("signature_pic").style.width = "250px";
				document.getElementById("signature_pic").style.height = "150px";
				document.getElementById("dig_signature").value = img_data;
			}
		});
	}

	function cancel_sign() {
		var old_sign = $('#old_signature_path').val();
		//alert(old_sign);
		document.getElementById("signature_pic").style.backgroundImage = "url('" + old_sign + "')";
		document.getElementById("signature_pic").style.backgroundRepeat = "no-repeat";
		document.getElementById("dig_signature").value = '';
	}
</script>