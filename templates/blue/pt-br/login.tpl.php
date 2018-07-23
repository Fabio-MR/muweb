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
						<h2><i class="icons icon-signin"></i>Authorization</h2>
						<div class="spacer3"></div>


						<div class="main">
							<form method="post" action="post/signin">
								<input type="hidden" name="action" value="login">
								<input type="hidden" name="rtn" value="login">

								<label><i>Login:</i><input class="text-box" name="login" placeholder="Enter login" type="text"></label>
								<label><i>Password:</i><input class="text-box" name="password" placeholder="Enter password" type="password"></label>
								<div class="spacer2"></div>
								<!--- Google Captcha --->
								<div class="g-recaptcha" data-sitekey="6Lfs0WIUAAAAAK_C3efwpOS1nKQbIdWIUFj9Q7gh"></div>

								<span id="login"></span>

								<div class="spacer1"></div>

								<div class="center">
									<a href="signup"><i>Registration</i></a> &nbsp;&nbsp;&nbsp;
									<a href="forgot"><i>Forgot password</i></a>
								</div>

								<div class="spacer3"></div>
								<div class="center"><input class="nice-button" type="submit" name="enter" value="Login">
								</div>
							</form>

						</div>









					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>

		{#INCLUDE:footer}
	</body>
	</html>