{#INCLUDE:header}
	<body>
		{#DIV[LOGIN_LOGOUT]}
		<div id="container">

			<div class="wrapper">
				{#INCLUDE:sidebar}
				<div id="content">

					<div class="article">
						<!--
                        <div id="warn-info">With our unique <a href="https://norebirth.com/topic/927-rampage-x20-progressive-content/">progressive system</a> it's never too late to join the Rampage server!</div>
-->
						<h2><i class="icons icon-key"></i>Account registration</h2>
						<div class="spacer3"></div>
						<!-- main -->
						<div class="main">
							<form method="post" action="post/signup">
								<input type="hidden" name="action" value="register">
								<input type="hidden" name="rtn" value="register">


								<label><i class="required-caption">Login:</i><input class="text-box inHelp" type="text" name="reg_login" placeholder="Account login" title="Login length from 4 to 10 letters. Only latin letters and numbers. Used for log-in for website and game." value=""></label>
								<label><i class="required-caption">Nome completo:</i><input class="text-box inHelp" type="text" name="reg_nick" placeholder="Account display name" title="Nickname length from 4 to 10 letters. Only latin letters and numbers. Used for log-in for forums." value=""></label>
								<label><i class="required-caption">Senha:</i><input class="text-box inHelp" type="password" name="reg_password" placeholder="Account password" title="Password length from 6 to 10 letters."></label>
								<label><i class="required-caption">Confirme a senha:</i><input class="text-box inHelp" type="password" name="reg_repassword" placeholder="Account password" title="Passwords have to match."></label>

								<label><i class="required-caption">E-mail:</i><input class="text-box inHelp" type="text" name="reg_email" placeholder="Electronic mail" title="Required to enter your real e-mail." value=""></label>
								<label><i class="required-caption">Confirme seu e-mail:</i><input class="text-box inHelp" type="text" name="reg_reemail" placeholder="Electronic mail" title="E-mails must match." value=""></label>
								<label><i>Invite code:</i><input class="text-box inHelp" type="text" name="reg_invite" placeholder="Referral code" title="Not necessary. Enter your recruitment code to receive bonuses." value=""></label>

								<div class="spacer2"></div>
								<!--- Google Captcha --->
								<span id="register"></span>
								<div class="g-recaptcha" data-sitekey="6Lfs0WIUAAAAAK_C3efwpOS1nKQbIdWIUFj9Q7gh"></div>

								<div class="spacer2"></div>
								Ao se inscrever, você concorda com as <a href="rules?tab=1" target="_blabk">Regras do servidor</a>, <a href="rules?tab=2" target="_blabk">Terms de uso</a> e <a href="rules?tab=3" target="_blabk">Politica de privacidade</a>.

								<div class="spacer3"></div>
								<div class="center"><input class="nice-button" type="submit" name="enter" value="Create account">
								</div>
							</form>

							<div class="spacer3"></div>

							<h4>Opções adicionais:</h4>
							<div class="spacer2"></div>
							<ul class="listen">
								<li><a href="forgot">Redefinir senha</a>
								</li>
								<li><a href="resender">Reenviar email de verificação</a>
								</li>
							</ul>

						</div>
						<!-- /main -->
						
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		{#INCLUDE:footer}
	</body>
	</html>