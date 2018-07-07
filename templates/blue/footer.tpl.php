<div id="footer">
	<div class="wrapper">
		<div class="item-footer">
			<h2>© 2018 NewAgeZ Design</h2>
			<p>All other trademarks and copyrights belong to their respective owners.</p>
			<a class="non teen" target="_blank" href="https://www.esrb.org/ratings/Synopsis.aspx?Certificate=21291&Title=Mu+Online"><img src="templates/{#TEMPLATE}/images/teen.png" alt="" /></a>
		</div>
		<div class="item-footer">
			<h2>About us</h2>
			<p>Mu New Age Z - young, but ambitious MMO-game project focused on the English-speaking audience, created by the well talented and experienced developers in the field of MMORPG featuring professional technical support. Latest features of the gaming universe, creative innovations, a revolutionary approach to the old content - all that can be found on MuNewAgeZ.</p>
		</div>
		<div class="item-footer">
			<h2>Social networks</h2>
			<div class="social-list">
				<a rel="nofollow" id="social-fb" class="non" href="{#FBPAGE}" target="_blank"></a>
				<a rel="nofollow" id="social-youtube" class="non" href="{#YOUTUBE}" target="_blank"></a>
			</div>
		</div>
		<div class="item-footer">
			<h2>Donate</h2>
			<div id="take-list">
				<a class="non" href="https://www.paymentwall.com/" target="_blank"><img src="templates/{#TEMPLATE}/images/paymentwall_button.png" alt="" /></a>
				<p><a href="https://mu.newagez.com/rules?tab=2">Terms</a> and <a href="/rules?tab=3">Privacy</a>
				</p>
			</div>
		</div>
	</div>
</div>
    <div id="opaco-box"></div>
    <div id="popup-box"></div>
    <div id="loading"></div>
    <div id="tooltip"></div>
<script>
$('form').submit(function(event) {
			var dados = jQuery(this).serialize();
			$('#feedback').html('Carregando...');
			$form = $(this); //wrap this in jQuery
			if($form.attr('target') == "_blank"){console.log("Vamos cancelar o ajax");}else{
			jQuery.ajax({
				type: "POST",
				url: "{#SITEBASE}/ajax/index.php",
				dataType:"json",
				//dataType:"html",
				data: dados,
				success: function(data)
				{
				console.log(data);	
				if(data.type == 1){
				var div = '<div  class="box alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>';
				var endiv = '</div>';
				}else{
				var div = '<div class="box alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Sucesso:</span>';
				var endiv = '</div>';					
				}
				$('#'+data.rtn).html(div+data.msg+endiv);
					console.log(div+data.msg+endiv);
				//console.log(data);
				},error: function (request, status, error) {
					console.log(request, status, error);
				//alert('alerta de erro de envio!');	
				}
			});
			event.preventDefault();}
 });
</script>