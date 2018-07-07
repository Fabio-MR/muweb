<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Rename" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Rename extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->VerifName();
		}
		
		private function VerifName()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 
		$type ='1';
		if(strlen($newname) < 4) {$msg .='Nome muito curto, por favor digite um nome maior. <br>';};
		if(strlen($newname) > 10) {$msg .='Nome muito longo, por favor digite um nome menor. <br>';};
		
		if (!preg_match('/^[a-zA-Z0-9_]+$/', $newname)) { $msg .= "<br>Somente letras e números.<br>"; }
		
		$BLOK[] = (object) ['name'=>'gm_'];
		$BLOK[] = (object) ['name'=>'md_'];
		$BLOK[] = (object) ['name'=>'sub_'];
		$BLOK[] = (object) ['name'=>'adm_'];
		
		
		foreach($BLOK as &$row){
		if (preg_match('/^'.$row->name.'/', strtolower($newname))) { $msg .= '<br>Voce não pode usar <strong>'.$row->name.'</strong>, no seu nome.<br>'; }
		}
	
		//$msg .='Renomear personagem '.$character.' para '.$newname.'';
		$sql = 'SELECT  count(*) as Total  FROM  Character WHERE Name =\''.$newname.'\'';
		$result = $this->selectDB($sql);
		if($result[0]->Total > 0){
			$msg ='Nome em uso por favor escolha outro...';
		}
		else{
		//	$msg ='você pode usar este nome';
		$sql = "EXEC [".DATABASE."].[dbo].[WZ_RenameCharacter] '".$_SESSION[SESSION_NAME]."','$oldname','$newname'";
		$this->insertDB($sql);			
			$sql2 = 'SELECT  count(*) as Total  FROM  Character WHERE Name =\''.$newname.'\'';
			$result = $this->selectDB($sql2);
				if($result[0]->Total > 0){
					$type ='0';
					$msg ='Nome alterado com sucesso!!!';
				}else{
				$msg ='Desculpe não foi possivel executar a solicitação, tente novamente mais tarde.';
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
