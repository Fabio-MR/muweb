<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Vip" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Vip extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->vipCheck();
		}
		// verifica se o suaurio tem dinheiro

		
		private function teste()
		{global $vip,$TABLES_CONFIGS;
		
		foreach ($_POST as $key => $value){$$key = $value;} 
		$v = $vip[$id]->cash;
		$ammount = $TABLES_CONFIGS['WEBCASH'][$v]->columnAmount;
				
		$sql ='SELECT [WCoinC],[WCoinP],[GoblinPoint] FROM [dbo].[CashShopData] WHERE [AccountID] =\''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->selectDB($sql);
		
		if($result[0]->$ammount >= $vip[$id]->prince){
		$msg ='Você tem dinheiro suficiente para comprar <br> preço: '.$vip[$id]->prince.'';
		$type = 0;	
		}	
		else{
		$type = 1;	
		
		$msg ='creditos insuficientes <br> preço: '.$vip[$id]->prince.'';
		}
		
		
		$this->returnMsg($type,$rtn,$msg);	
		}

		// Verifica se o usuario e vip
		private function vipCheck()
		{
		foreach ($_POST as $key => $value){$$key = $value;} 
		$sql ='SELECT AccountLevel FROM MEMB_INFO WHERE memb___id = \''.$_SESSION[SESSION_NAME].'\'';
		$result = $this->selectDB($sql);
		
		if($result[0]->AccountLevel >= 1){
		$msg ='Você ja e vip por favor aguarde seu vip acabar';
		$type = 0;
		$this->returnMsg($type,$rtn,$msg);	
		}else{
		//Chama a classe de compra de vip
		$this->buyVip($id,$rtn);
		}

		}

		private function buyVip($id,$rtn)
		{ global $vip,$TABLES_CONFIGS;
		$v = $vip[$id]->cash;
		$ammount = $TABLES_CONFIGS['WEBCASH'][$v]->columnAmount;
		$database = $TABLES_CONFIGS['WEBCASH'][$v]->database;
		$table = $TABLES_CONFIGS['WEBCASH'][$v]->table;
		
		$sql ='SELECT [WCoinC],[WCoinP],[GoblinPoint] FROM [dbo].[CashShopData] WHERE [AccountID] =\''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->selectDB($sql);
		if($result[0]->$ammount >= $vip[$id]->prince)
		{
		$sql ='UPDATE MEMB_INFO SET AccountLevel = 1, AccountExpireDate = GETDATE() + '.$vip[$id]->days.' WHERE memb___id = \''.$_SESSION[SESSION_NAME].'\'; UPDATE 	'.$database.'.[dbo].'.$table.' SET '.$ammount.' = '.$ammount.'-'.$vip[$id]->prince.' WHERE '.$TABLES_CONFIGS['WEBCASH'][$v]->columnUsername.'=\''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->selectDB($sql);
		//$result = 1;
			if($result >= 1){
			$msg ='Compra efetuada com sucesso.';
			$type = 1;
			}		
		
		}
		else{
		$type = 1;	
		$msg ='creditos insuficientes <br>';			
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
