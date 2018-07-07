<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Ticket" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Ticket   extends DataBase {
		public function __construct()
		{
			
			$this->OpenTicket();
		
		}

		private function OpenTicket()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 
		
		$ip = $_SERVER["REMOTE_ADDR"]; //pega o ip do usuario
		$username = $_SESSION[SESSION_NAME];
		$character ="0";
		$subject = trim($subject);	
		$message = trim($message);
		$date = time();	
		$msg = "";	

		if(empty($subject) || strlen($subject) < 10)
		{
		$msg .="O assundo da mensage deve ter no minimo 10 caracteres.<br>";	
		$error = true;	
		}
		
		if(empty($message) || strlen($message) < 10)
		{
		$msg .="Sua mensagem deve ter no minimo 50 caracteres.<br>";	
		$error = true;	
		}
	
		if(@$error == false){
		$sql ="INSERT INTO [dbo].[webTickets]
           ([username]
           ,[character]
           ,[sector]
           ,[subject]
           ,[description]
           ,[date]
           ,[ip]
           ,[status])
     VALUES
           ('$username'
           ,'$character'
           ,'0'
           ,'$subject'
           ,'$message'
           ,'$date'
           ,'$ip'
           ,'1')";
		$return = $this->insertDB($sql);
		if($return >= 1){
			$type ="1";
				$msg .='<script>window.location="'.SITEBASE.'/'.SITE_DIR.'/ticket/";</script>';
		}else{
			$type ="0";
			$msg = "Ocorreu um erro ao enviar sua mensagem por favor atualize a pagina e tente novamente.";//."<br>Erro nao foi possivel abrir o tickt";			
		}		
		}else{
			$type ="1";
			$msg .= "Atualize a pagina e tente novamente";						
		}

			$this->returnMsg($type,$rtn,$msg);
		}

		private function ReadTicket()
		{
			
			
		}
		
		private function ListTicket()
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
