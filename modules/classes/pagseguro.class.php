<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "PagSeguro" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class PagSeguro   extends DataBase {
		public function __construct()
		{ Global $Tpl;
		
			$Tpl->set('PAGSEGURO[EMAIL]','servermr@hotmail.com');
			$Tpl->set('USER[LOGIN]',$_SESSION[SESSION_NAME]);
			$Tpl->set('USER[EMAIL]',$this->userEmail());
		}
		
		public function userEmail()
		{
		$sql ='SELECT [memb___id]
      ,[mail_addr]
  FROM [dbo].[MEMB_INFO] WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
		$result = $this->selectDB($sql);
		$email = $result[0]->mail_addr;
		return $email;
		}


				}
}

