<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "ChangePassword" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class ChangePassword extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->ChangePasswordCheck();
		}
		
		private function ChangePasswordCheck()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 

			$sql ='
			SELECT [memb_guid]
			  ,[memb___id]
			  ,[memb__pwd]
			  ,[mail_addr]
			  ,[fpas_ques]
			  ,[fpas_answ]
			  ,[bloc_code]
			  ,[AccountLevel]
			  ,[AccountExpireDate]
  FROM [dbo].[MEMB_INFO]
  WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'
			';
			$result = $this->selectDB($sql);
			
			if(empty($password) || empty($new_password) || empty($confirm_new_password)){
			$msg .= "Você deve preenxer todos os campos<br />";
			$error = true;
			}		
			
			if($result[0]->memb__pwd != $password){
			$msg .= "A senha antiga, nao confere com a senha digitada<br />";
			$error = true;
			}
			
			if($result[0]->memb__pwd == $new_password){
			$msg .= "A senha atual nao pode ser igual a senha antiga<br />";
			$error = true;
			}		
			
			if($confirm_new_password != $new_password){
			$msg .= "As senhas não conferem<br />";
			$error = true;
			}		
		
			if(strlen($new_password) < 4 || strlen($new_password) > 10)
			{
				$AccRegister13 = "A senha deve ter entre 4 e 10 letras e/ou números.";
				$return .= $AccRegister13."<br />";
				$error = true;
			}			
			
			if(!ctype_alnum($new_password))
			{
				$AccRegister14 = "Não use caracteres especiais em sua senha. Apenas letras (A-Z , a-z) e/ou números são permitidos.";
				$return .= $AccRegister14."<br />";
				$error = true;
			}
			if(!$error){
				$sql ='UPDATE [dbo].[MEMB_INFO] SET [memb__pwd] = \''.$new_password.'\' WHERE  [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
				$result = $this->updateDB($sql);
				if($result){
					$msg ="Senha alterada com sucesso!!!";
					}else{
					$msg ="Desculpe nao foi possivel efetuar a troca da senha no momento.";
				}
			}
			
			$this->returnMsg($type,$rtn,$msg);
			
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
