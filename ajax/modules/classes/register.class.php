<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Register" ) == false ) {
	new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Register extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
				$this->main();

		}
		
		// funcção principal por onde deve iniciar o registro
		public function main()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 
		$type = 0;
		switch($this->validateInf())
		{
			default:
				$msg = "CONTA CRIADA COM SUCESSO!!!";
				break;
				
		}
			
		//retorna a mensagem
		$this->returnMsg($type,$rtn,$msg);
		}
		
		
		private function validateInf(){
		foreach ($_POST as $key => $value){$$key = $value;} 
		$recaptcha = $_POST['g-recaptcha-response'];
		if(!$this->reCAPTCHA($recaptcha)) {return 1;} // não validou o captcha
		//usuario, email ou senha em branco
		if(empty($reg_login) || empty($memb__pwd) || empty($mail_addr)){return 2;}
		// as senhas não confere
		if ($memb__pwd != $memb__pwd2){return 3;}
		//Tamanho da senha e diferente do permitido
		if(strlen($memb__pwd) < 4 || strlen($memb__pwd) > 10){ return 4;}
		// senha so pode conter letras e numeros
		if(!ctype_alnum($memb__pwd)){ return 5;}
		//verifica se o email informado e o re email conferem 
		if ($mail_addr != $mail_addr2){ return 6;}
		// verifica se foi digitado um email valido 
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $mail_addr)){ return 7;}
		//Login pode conter somente letras e numeros
		if(!ctype_alnum($reg_login)){return 8;}
		// verifica o tamanho do login
		if(strlen($reg_login) < 4 || strlen($reg_login) > 10){ return 9;}
			
		}
		
		
		
		// verifica se o captcha foi verificado
		private function  reCAPTCHA($recaptcha) {
		//reCAPTCHA	
		$ip = $_SERVER['REMOTE_ADDR'];
		$var = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.CAPTCHASECRETKEY.'&response='.$recaptcha.'&remoteip=$ip');
		$response = json_decode($var, true);

		return $response['success'];

		}
		
		// verifica se o email ja não esta registrado no banco de dados
        private function checkemail(){
		$sql = "SELECT memb___id FROM MEMB_INFO WHERE memb___id = '$reg_login'";
		$result = $this->selectDB($sql);
		return count($result);
		}

		
		//Cria a noca conta
		private function registerAccount()
		{
			
			$sql ="INSERT INTO ". DATABASE .".dbo.MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,post_code,addr_info,addr_deta,tel__numb,mail_addr,phon_numb,fpas_ques,fpas_answ,job__code, appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code)
			VALUES 
('$reg_login','$memb__pwd','$memb_name','$sno__numb','s-n','11111','','0','$mail_addr','','$fpas_ques','$fpas_answ','1','2003-11-23','2003-11-23','2003-11-23','2003-11-23','1','0','1')";

			$result = $this->insertDB($sql);

			if($result > 0){
			$date = date('M d Y h:i');
			$date = date('M d Y h:i', strtotime("+7 days",strtotime($date)));			
$sql ='UPDATE '. DATABASE .'.[dbo].[MEMB_INFO] SET [AccountLevel] = \'1\',[AccountExpireDate] = \''.$date.'\'
 WHERE [memb___id] = \''.$reg_login.'\'';
			$result = $this->updateDB($sql);	
				
			$type = 0;
			$return .="Cadastro efetuado com sucesso";
			}else{
			$return .="Desculpe nao foi possivel efetuar o cadastro no momento.";
			}
			
		
		}
		
		

		
		private function returnMsg($type,$rtn,$msg)
		{
		$arr = Array(
		 'type' =>		$type,
		 'rtn' =>		$rtn,
		 'msg' =>		$msg
		);
		
		echo json_encode($arr);	
		}
		
	}	
}
