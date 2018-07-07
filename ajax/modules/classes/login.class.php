<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Login" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Login extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->loginCheck();
		}
		
		private function loginCheck()
		{
			foreach ($_POST as $key => $value){$$key = $value;} 
			$msg ='';
			if(empty($login))$msg .= "<strong>Login em branco</strong>";
			elseif(empty($password)) $msg .= "<strong>Senha em branco</strong>";
			$sql ='SELECT [memb___id], [memb__pwd] FROM [dbo].[MEMB_INFO] WHERE [memb___id] = \''.$login.'\'';
			$result = $this->selectDB($sql);
				if($result[0]->memb__pwd == $password){
				$_SESSION[SESSION_NAME]= $login;
				$type ='0';
				$msg .=' Login efatuado com sucesso! <br> <script>window.location="'.SITEBASE.'/'.SITE_DIR.'/usercp/";</script>';
				}
				else{
				$msg .=' Login ou senha incorretos, verifique os dados digitados e tente novamente.';
				$type = '1';
				}
				$this->returnMsg($type,$rtn,$msg);

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
