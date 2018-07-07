<div id="header">
		<span id="videoFadeIn"></span>
		<div class="wrapper">
			<ul id="navigation">
				<div class="spacer4"></div>
				<li><a href="news" id="nav-active"><i class="top-icons-news"></i>Home</a>
				</li>
				<li><a href="server"><i class="top-icons-server"></i>About</a>
				</li>
				<li><a href="files"><i class="top-icons-files"></i>Files</a>
				</li>
				<li><a href="rules"><i class="top-icons-rules"></i>Rules</a>
				</li>
				<li><a href="ratings"><i class="top-icons-ratings"></i>Rankings</a>
				</li>
				<li><a href="statistic"><i class="top-icons-statistic"></i>Statistics</a>
				</li>
				<li><a href="#"><i class="top-icons-forum"></i>Forum</a>
				</li>
			</ul>

			<div id="countdown">
				<h2>New progression with increased level cap will be released in</h2>
			</div>
			<script type="text/javascript">
				$( function () {
					var ts = new Date( "July 8, 2018 18:00:00" );
					$( '#countdown' ).countdown( {
						timestamp: ts
					} );
				} );
			</script>
			<div class="lk1">
				<div id="top-info">

					<img src="images/no-avatar.png" alt=""/>

					<p>You are logged in as: <b>{#USERNAME}</b>
					</p>

					<a href="usercp/{#USERNAME}" target="_blank">Profile</a>
					<a href="logout">Exit</a>

				</div>

				<div class="events-box">

					<div id="events-time">
						<h3>Event schedule</h3>
						<div class="spacer"></div>
						<ul id="events">
							<script type="text/javascript" src="templates/{#TEMPLATE}/js/events.js"></script>
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
						<a href="#" class="link-about" target="_blank">description</a>
						<div class="name">{#SERVERNAME}</div>
						<div class="chronicle">{#EXPERIENCE}</div>
					</div>
					<div class="circle"><canvas width="144" height="144"></canvas>
					</div>
					<div class="caption">
						current online<span>{#TOTAL_ONLINE}</span>
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