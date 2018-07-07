<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Unstuck" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Unstuck extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->move_character();
		}
		
		private function move_character()
		{ global $MAPS;
		foreach ($_POST as $key => $value){$$key = $value;} 
		if (!array_key_exists($map, $MAPS)) { //verifica se o mapa foi selecionado
		$error = true;
		$type =1;
		$msg .= "Selecione um mapa valido </br>";
		}
		if(empty($character)){
		$error = true;
		$type = 1;
		$msg .= "Selecione um personagem valido </br>";
		}
		//is online?
		$sql = 'SELECT [ConnectStat] FROM [dbo].[MEMB_STAT] WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
		$result = $this->selectDB($sql);
		
		if($result[0]->ConnectStat >= 1 or empty($result)){
		$error = true;
		$type = 1;
		$msg .= "Por favor desconet sua conta do jogo e tente novamente. </br>";
		}
		
		if($error != true){
		$sql = 'UPDATE [dbo].[Character] SET 
		[MapNumber] = '.$MAPS[$map]->id.'
		  ,[MapPosX] = '.$MAPS[$map]->X.'
		  ,[MapPosY] = '.$MAPS[$map]->Y.'
		 WHERE  [AccountID] = \''.$_SESSION[SESSION_NAME].'\' and [Name] = \''.$character.'\'
 ';
			$result = $this->updateDB($sql);
			if($result >= 1){
			$msg = 'Personagem movido com sucesso!';	
			}else{
			$msg = 'Desculpe não foi possivel mover seu personagem no momento!';	
			}
			
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
