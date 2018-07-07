<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Bloc" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Bloc extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{

		}
		
		//retorna se a conta esta banida ou não
		public function get_acoun_bloc()
		{//memb___id
			$sql ='SELECT bloc_code FROM MEMB_INFO WHERE memb___id = \''.$_SESSION[SESSION_NAME].'\'';
  			$result = $this->selectDB($sql);
			
			$this->i = $result[0]->bloc_code;
			
			return
			$this->i;
		}
		
		public function get_connect_stat()
		{ $sql = 'SELECT [ConnectStat] FROM [dbo].[MEMB_STAT] WHERE [memb___id] = \''.$_SESSION[SESSION_NAME].'\'';
  			$result = $this->selectDB($sql);
			$this->i = $result[0]->ConnectStat;
			return
			$this->i;		
		}

	}	
}
