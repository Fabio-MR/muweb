<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Register" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Register extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			//$this->returnMsg();
			$this->registerNow();
		}
		
        private function registerNow()
        {
		foreach ($_POST as $key => $value){$$key = $value;} 
		$return ="";
		$AccRegister01 = "Você deixou campos obrigatórios em branco. Por favor, confira.";
		
		$AccRegister02 = "As senhas que você usou são diferentes! Por favor digite as duas senhas IGUAIS!";
		
		$AccRegister03 = "Código digitado incorretamente!";
		
		$AccRegister04 = "Não use caracteres especiais em seu nome de usuário. Apenas letras (A-Z , a-z) e/ou números são permitidos.";
		
		$AccRegister05 = "São necessários 7 NÚMEROS para a <strong>chave de segurança</strong>";
		
		$AccRegister06 = "O e-mail ([mail_addr]) já foi usado em nosso banco de dados. Por favor use outro endereço de e-mail!";
		
		$AccRegister07 = "O nome de usuário (".$memb___id.") já está sendo usado! Por favor, escolha outro nome de usuário.";
		
		$AccRegister08 = "Não foi possível criar seu cadastro neste momento. Por favor tente mais tarde ou informe o suporte.";
		
		$AccRegister09 = "Olá, [memb_name]!<br />Sua conta foi criada com sucesso!<br />Obrigado por se juntar a nós!<br />Esperamos que você tenha momentos felizes e descontraídos jogando em nossos servidores.<br />Estamos enviando um e-mail neste exato momento explicando como validar seu endereço e-mail.<br />Quaisquer dúvidas poderão ser tiradas em nosso sistema de suporte no próprio site.<br /><br />Divirta-se!<br /><br /><br />";
		
		$AccRegister10 = "Os e-mails digitados não conferem! Por favor digite os dois e-mails IGUAIS!";
		
		$AccRegister11 = "O e-mail digitado parece inválido. Verifique se digitou corretamente.";
		
		$AccRegister12 = "O nome de usuário deve ter entre 4 e 10 letras e/ou números.";
		
		$AccRegister13 = "A senha deve ter entre 4 e 10 letras e/ou números.";
		
		$AccRegister14 = "Não use caracteres especiais em sua senha. Apenas letras (A-Z , a-z) e/ou números são permitidos.";
		
		
		$AccRegister15 = "Cadastro no MuRuby"; //Mail Confirmation Subject
		
		//Mail Confirmation Content (html enabled)
		$AccRegister16 = "<p>Ol&aacute;, [memb_name]!</p><p>Você registrou-se recentemente no MuRuby.</p><p>Para ativar sua conta, é necessário que você abra o link abaixo em seu navegador:<br />http://www.muruby.net/?c=MailActivate/[verify_hash]/[memb___id]<br /><a href='http://www.muruby.net/?c=MailActivate/[verify_hash]/[memb___id]'>ATIVAR CONTA</a></p><p>Lembrando seus dados:<br />Nome de Usuário: [memb___id]<br />Senha: (oculta) <br />E-mail: [mail_addr] <br />Pergunta Secreta: [fpas_ques] <br />Resposta Secreta: [fpas_answ] <br /><b>NÃO ESQUEÇA SEUS DADOS, PRINCIPALMENTE SUA SENHA!<br />É A ÚNICA FORMA DE MANTER SUA CONTA SEMPRE ATIVA E SEGURA!</b><br /><br />
		<p>Agradecemos a preferência,</p><p>Equipe MuRuby</p><p>* Esta mensagem foi gerada automaticamente em nossos servidores, por favor não responda.</p>";

			
		//reCAPTCHA	
		$ip = $_SERVER['REMOTE_ADDR'];
		$var = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.CAPTCHASECRETKEY.'&response='.g-recaptcha-response.'&remoteip=$ip');
		$response = json_decode($var, true);
		if(!$response[success]){
						$return .= "Voce nao marcou o capcha<br />";
			$error = true;
		}
			
		if(empty($memb___id) || empty($memb__pwd) || empty($mail_addr))
		{
			$return .= $AccRegister01."<br />";
			$error = true;
		}
		
		if ($memb__pwd != $memb__pwd2)
		{
			$return .= $AccRegister02."<br />";
			$error = true;
		}
		
		if(strlen($memb__pwd) < 4 || strlen($memb__pwd) > 10)
		{
			$return .= $AccRegister13."<br />";
			$error = true;
		}
		
		if(!ctype_alnum($memb__pwd))
		{
			$return .= $AccRegister14."<br />";
			$error = true;
		}
		
		if ($mail_addr != $mail_addr2)
		{
			$return .= $AccRegister10."<br />";
			$error = true;
		}
		
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $mail_addr))
		{
			$return .= $AccRegister11 . "<br />";
			$error = true;
		}
		/*
		if ($_SESSION["SecurityCode"] != $code2)
		{
			$return .= $AccRegister03."<br />";
			$error = true;
		}
		*/
		if(!ctype_alnum($memb___id))
		{
			$return .= $AccRegister04."<br />";
			$error = true;
		}
		
		if(strlen($memb___id) < 4 || strlen($memb___id) > 10)
		{
			$return .= $AccRegister12."<br />";
			$error = true;
		}
		
		if(!is_numeric($sno__numb) || strlen($sno__numb) != 7)
		{
			$return .= $AccRegister05."<br />";
			$error = true;
		}
		
		if(isset($AccRegisterOneEmail) && $AccRegisterOneEmail)
		{
			$result = $this->selectDB("SELECT memb_guid FROM MEMB_INFO WHERE mail_addr = '$mail_addr'");
			if(count($result) > 0)
			{
				$return .= $AccRegister06."<br />";
				$error = true;
			} 
		}
		
		$sql = "SELECT memb___id FROM MEMB_INFO WHERE memb___id = '$memb___id'";
		$result = $this->selectDB($sql);
		if(count($result) > 0)
		{
			$return .= $AccRegister07."<br />";
			$error = true;
		}
		if(@$error == false){
			$sql ="INSERT INTO ". DATABASE .".dbo.MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,post_code,addr_info,addr_deta,tel__numb,mail_addr,phon_numb,fpas_ques,fpas_answ,job__code, appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code)
			VALUES 
('$memb___id','$memb__pwd','$memb_name','$sno__numb','s-n','11111','','0','$mail_addr','','$fpas_ques','$fpas_answ','1','2003-11-23','2003-11-23','2003-11-23','2003-11-23','1','0','1')";

			$result = $this->insertDB($sql);

			if($result > 0){
			$date = date('M d Y h:i');
			$date = date('M d Y h:i', strtotime("+7 days",strtotime($date)));			
$sql ='UPDATE '. DATABASE .'.[dbo].[MEMB_INFO] SET [AccountLevel] = \'1\',[AccountExpireDate] = \''.$date.'\'
 WHERE [memb___id] = \''.$memb___id.'\'';
			$result = $this->updateDB($sql);	
				
			$type = 0;
			$return .="Cadastro efetuado com sucesso";
			}else{
			$return .="Desculpe nao foi possivel efetuar o cadastro no momento.";
			}
			
		}else{
			$type = 1;
			$return .='Desculpe não foi possivel efetuar o seu cadastro<br>';
		}
		
				$this->returnMsg($type,$rtn,$return);
		}
        private function resendActivateEmail()
        {
		
		}
		private function activeAccount()
		{
			
		}
		
		private function returnMsg($type,$rtn,$msg)
		{
		$arr = Array(
		 'type' =>		$type,
		 'rtn' =>	$rtn,
		 'msg' =>		$msg
		);
		
		echo json_encode($arr);	
		}
		
	}	
}
