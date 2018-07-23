<div id="header">
		<span id="videoFadeIn"></span>
		<div class="wrapper">
			<ul id="navigation">
				<div class="spacer4"></div>
				<li><a href="pt/news" id="nav-active"><i class="top-icons-news"></i>Inicio</a>
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
				<!--li><a href="#"><i class="top-icons-forum"></i>Forum</a>
				</li-->
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
				<div id="top-info">

					<img src="pt/images/no-avatar.png" alt=""/>

					<p>Você está logado como: <b>{#USERNAME}</b>
					</p>

					<a href="pt/usercp/{#USERNAME}" target="_blank">Perfil</a>
					<a href="pt/logout">Exit</a>

				</div>

				<div class="events-box">

					<div id="events-time">
						<h3>Agenda de eventos</h3>
						<div class="spacer"></div>
						<ul id="events">
							<script type="text/javascript" src="pt/templates/{#TEMPLATE}/js/events.js"></script>
							<script type="text/javascript">
								MuEvents.init( '00:39:44' );
							</script>
						</ul>
						<div class="event-scroll"></div>
					</div>

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
						online agora <span>{#TOTAL_ONLINE}</span>
					</div>
				</div>
				<!--

				<div class="item" data-online="186" data-max-online="600">
					<div class="v-align">
						<a href="https://norebirth.com/topic/580-miracle-x50-server-information/" class="link-about" target="_blank">description</a>
						<div class="name">Miracle</div>
						<div class="chronicle">x50</div>
					</div>
					<div class="circle"><canvas width="144" height="144"></canvas>
					</div>
					<div class="caption">
						current online<span>186</span>
					</div>
				</div>
-->

			</div>



		</div>
	</div>