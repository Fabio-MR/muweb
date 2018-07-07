{#INCLUDE:header}
<body>
	{#INCLUDE:header[LOGOUT]}
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
      <label><i>Login:</i><input class="text-box" name="login" placeholder="Enter login" type="text"></label>
      <label><i>Password:</i><input class="text-box" name="password" placeholder="Enter password" type="password"></label>
      <div class="spacer2"></div>
      <!--- Google Captcha --->
      <div class="g-recaptcha" data-theme="dark" data-sitekey="6Le8ITAUAAAAAJtLhIxpFV4eZLiHdfP0cvsuUc8I"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Le8ITAUAAAAAJtLhIxpFV4eZLiHdfP0cvsuUc8I&amp;co=aHR0cHM6Ly9tdS5ub3JlYmlydGguY29tOjQ0Mw..&amp;hl=pt-BR&amp;v=v1529908317173&amp;theme=dark&amp;size=normal&amp;cb=7qx1t02sgbqs" width="304" height="78" role="presentation" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
      
      <div class="spacer1"></div>
      
      <div class="center">
        <a href="signup"><i>Registration</i></a>
        &nbsp;&nbsp;&nbsp;
        <a href="forgot"><i>Forgot password</i></a>
      </div>
        
      <div class="spacer3"></div>
      <div class="center"><input class="nice-button" type="submit" name="enter" value="Login"></div>
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