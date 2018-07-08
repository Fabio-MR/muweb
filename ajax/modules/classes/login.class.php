<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Login" ) == false ) {
	new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Login extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->main();
		}
		
		public function main()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 
		$type = 0;
		switch($this->validateInf())
		{
			case 0:
				$msg = LOGIN_MSG_00;
				break;
			case 1:
				$msg = LOGIN_MSG_01;
				break;
			case 2:
				$msg = LOGIN_MSG_02;
				break;
			case 3:
				$msg = LOGIN_MSG_03;
				break;
			case 999:
				$msg = LOGIN_MSG_999;
				break;
			
				
			default:
				$msg = LOGIN_MSG_ERROR;
				break;
		}
			
		//retorna a mensagem
		$this->returnMsg($type,$rtn,$msg);
		}
		
		
		private function validateInf(){
		foreach ($_POST as $key => $value){$$key = $value;} 
			
			// verificar captcha	
			$recaptcha = $_POST['g-recaptcha-response'];
			if(!$this->reCAPTCHA($recaptcha)) {return 1;} 	
			//login em branco
			if(empty($login)) return 2;
			//senha em branco
			if(empty($password)) return 3;
			//faz o login
			$login = $this->loginCheck($login,$password);
			if($login){ return 999;} //login efetuado com sucesso
			else { return 0;} //login ou senha incorretos
	
		return -1;
		}
		
		// verifica se o captcha foi verificado
		private function  reCAPTCHA($recaptcha) {
		//reCAPTCHA	
		$ip = $_SERVER['REMOTE_ADDR'];
		$var = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.CAPTCHASECRETKEY.'&response='.$recaptcha.'&remoteip=$ip');
		$response = json_decode($var, true);

		return $response['success'];

		}		
		
		
		private function loginCheck($login,$password)
		{
			foreach ($_POST as $key => $value){$$key = $value;} 
			$msg ='';
			$sql ='SELECT [memb___id], [memb__pwd] FROM [dbo].[MEMB_INFO] WHERE [memb___id] = \''.$login.'\'';
			$result = $this->selectDB($sql);
				if($result[0]->memb__pwd == $password){
				$_SESSION[SESSION_NAME]= $login;
				return 1;
				}
				else{
				return 0;
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
