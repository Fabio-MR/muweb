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
			case 0:
				$msg = REGISTER_MSG_00;
				break;
			case 1:
				$msg = REGISTER_MSG_01;
				break;
			case 2:
				$msg = REGISTER_MSG_02;
				break;
			case 3:
				$msg = REGISTER_MSG_03;
				break;
			case 4:
				$msg = REGISTER_MSG_04;
				break;
			case 5:
				$msg = REGISTER_MSG_05;
				break;
			case 6:
				$msg = REGISTER_MSG_06;
				break;
			case 7:
				$msg = REGISTER_MSG_07;
				break;
			case 8:
				$msg = REGISTER_MSG_08;
				break;
			case 9:
				$msg = REGISTER_MSG_09;
				break;
			case 10:
				$msg = REGISTER_MSG_10;
				break;
			case 11:
				$msg = REGISTER_MSG_11;
				break;
			case 999:
				$msg = REGISTER_MSG_999;
				break;
				
		default:
		$msg = REGISTER_MSG_ERROR;
		break;
				
		}
			
		//retorna a mensagem
		$this->returnMsg($type,$rtn,$msg);
		}
		
		
		private function validateInf(){
		foreach ($_POST as $key => $value){$$key = $value;} 
		$recaptcha = $_POST['g-recaptcha-response'];
		//if($this->reCAPTCHA($recaptcha)) {return 1;} // não validou o captcha
		//usuario, email ou senha em branco
		if(empty($reg_login) || empty($reg_password) || empty($reg_email)){return 2;}
		// as senhas não confere
		if ($reg_password != $reg_repassword){return 3;}
		//Tamanho da senha e diferente do permitido
		if(strlen($reg_password) < 4 || strlen($reg_password) > 10){ return 4;}
		// senha so pode conter letras e numeros
		if(!ctype_alnum($reg_password)){ return 5;}
		//verifica se o email informado e o re email conferem 
		if ($reg_email != $reg_reemail){ return 6;}
		// verifica se foi digitado um email valido 
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $reg_email)){ return 7;}
		//Login pode conter somente letras e numeros
		if(!ctype_alnum($reg_login)){return 8;}
		// verifica o tamanho do login
		if(strlen($reg_login) < 4 || strlen($reg_login) > 10){ return 9;}
		//verifica se o email ja esta cadastrado
		if($this->checkemail($reg_email)){ return 10;}
		// verifica se a conta ja esta cadastrada
		if($this->checkLogin($reg_login)){ return 11;}
		
		$sno__numb = "1234567";	
			
		$result = $this->registerAccount($reg_login,$reg_password,$reg_nick,$sno__numb,$reg_email,NULL,NULL);	
		if($result){ return 999;}
			else{
				return 0;
			}
			
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
        private function checkemail($mail_addr){
		$sql = "SELECT mail_addr FROM MEMB_INFO WHERE mail_addr = '$mail_addr'";
		$result = $this->selectDB($sql);
			if(count($result) > 0) return true;
		return false;
		}

		// verifica se o email ja não esta registrado no banco de dados
        private function checkLogin($reg_login){
		$sql = "SELECT memb___id FROM MEMB_INFO WHERE memb___id = '$reg_login'";
		$result = $this->selectDB($sql);
					if(count($result) > 0) return true;
		return false;
		}

		
		//Cria a noca conta
		private function registerAccount($reg_login,$reg_password,$memb_name,$sno__numb,$reg_email,$fpas_ques,$fpas_answ)
		{
			$sql ="INSERT INTO ". DATABASE .".dbo.MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,post_code,addr_info,addr_deta,tel__numb,mail_addr,phon_numb,
			fpas_ques,fpas_answ,job__code, appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code)
			VALUES 
('$reg_login','$reg_password','$memb_name','$sno__numb','s-n','11111','','0','$reg_email','','$fpas_ques','$fpas_answ','1','2003-11-23','2003-11-23','2003-11-23','2003-11-23','1','0','1')";

			
			$result = $this->insertDB($sql);

			if(count($result) > 0) return true;
			return false;
				/*
			$date = date('M d Y h:i');
			$date = date('M d Y h:i', strtotime("+7 days",strtotime($date)));			
$sql ='UPDATE '. DATABASE .'.[dbo].[MEMB_INFO] SET [AccountLevel] = \'1\',[AccountExpireDate] = \''.$date.'\'
 WHERE [memb___id] = \''.$reg_login.'\'';
			$result = $this->updateDB($sql);	
				*/

			
		
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
