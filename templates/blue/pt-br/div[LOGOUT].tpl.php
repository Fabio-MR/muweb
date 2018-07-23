<div id="header">
	<span id="videoFadeIn"></span>
	<div class="wrapper">
		<ul id="navigation">
			<div class="spacer4"></div>
			<li><a href="pt/news" id="nav-active"><i class="top-icons-news"></i>Iinicio</a>
			</li>
			<li><a href="pt/server"><i class="top-icons-server"></i>Sobre</a>
			</li>
			<li><a href="pt/files"><i class="top-icons-files"></i>Downloads</a>
			</li>
			<li><a href="pt/rules"><i class="top-icons-rules"></i>Regras</a>
			</li>
			<li><a href="pt/ratings"><i class="top-icons-ratings"></i>Rankings</a>
			</li>
			<li><a href="pt/statistic"><i class="top-icons-statistic"></i>Estatísticas</a>
			</li>
		</ul>

		<div id="countdown">
			<h2>O servidor será iniciado em</h2>
		</div>
		<script type="text/javascript">
			$( function () {
				var ts = new Date( "July 29, 2018 18:00:00" );
				$( '#countdown' ).countdown( {
					timestamp: ts
				} );
			} );
		</script>
		<div class="lk1">
			<a class="card-login" id="#signin" href="pt/signin">
  	<i class="icons icon-lock"></i>
    <h2>Entrar</h2>
    <span>Faça o login no painel da sua conta</span>
  </a>
		
		</div>

		<div class="lk2">
			<div class="right-box mTop">

				<a class="card-register" href="pt/signup">
      <i class="icons icon-key"></i>
     	<h2>Cadastre-se</h2>
     	<span>Criar uma nova conta para o jogo</span>
    </a>
			

				<a class="card-files" href="pt/files">
      <i class="icons icon-cloud"></i>
      <h2>Downloads</h2>
      <span>Baixe os arquivo nescessarios para jogar</span>
    </a>
			

			</div>
		</div>

		<div class="status">
			<div class="item" data-online="{#TOTAL_ONLINE}" data-max-online="600">
				<div class="v-align">
					<a href="#" class="link-about" target="_blank">descrição</a>
					<div class="name">{#SERVERNAME}</div>
					<div class="chronicle">{#EXPERIENCE}</div>
				</div>
				<div class="circle"><canvas width="144" height="144"></canvas>
				</div>
				<div class="caption">
					online agora<span>{#TOTAL_ONLINE}</span>
				</div>
			</div>

			<!--<div class="item" data-online="189" data-max-online="600">
				<div class="v-align">
					<a href="https://norebirth.com/topic/580-miracle-x50-server-information/" class="link-about" target="_blank">description</a>
					<div class="name">Miracle</div>
					<div class="chronicle">x50</div>
				</div>
					<div class="circle"><canvas width="144" height="144"></canvas></div>
					<div class="caption">
					current online<span>189</span>
				</div>
			</div>-->

		</div>



	</div>
</div>