<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "ChangEmail" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class ChangEmail extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->ChangEmailCheck();
		}
		
		private function ChangEmailCheck()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 

		$AccRegister11 = "O e-mail digitado parece inválido. Verifique se digitou corretamente.";
		
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $new_email))
		{
			$msg .= $AccRegister11 . "<br />";
			$error = true;
		}
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
			if($result[0]->mail_addr == $new_email){
			$msg .= "O você deve digitar um email diferete<br />";
			$error = true;
			}
			if(!$error){
			if($result[0]->fpas_ques == $question || $result[0]->fpas_answ == $answer){
				$sql ='UPDATE [dbo].[MEMB_INFO] SET [mail_addr] = \''.$new_email.'\' WHERE  [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
				$result = $this->updateDB($sql);
				if($result){
					$msg ="Email alterado com sucesso!!!";
					}else{
					$msg ="Desculpe nao foi possivel efetuar a troca e email no momento.";
				}
			}else{
				
				$msg ="A resposta secreta esta incorreta...";
			}}
			
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
