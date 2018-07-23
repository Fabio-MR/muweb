<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Statistics" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Statistics extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{ global $Tpl;
		 
		 $Tpl->set("SERVERSTATUS",$this->ServerStatus());
		 $Tpl->set("ACTIVEDAY",$this->activeLast24Hours());
		 $Tpl->set("TOTALGAMEMASTER",$this->gameMasters());
		 $Tpl->set("TOTALACCOUNTS",$this->totalAccounts());
		 $Tpl->set("TOTALGUILDS",$this->totalGuilds());
		 
		 $Tpl->set("SERVERVERSION",VERSION);  // versão do servidor -> settings
			
		 
		 //informações do castle sieg
			/*

			Fortress status	{#CRYWOLFSTATUS}
			Attack time	{#CRYWOLFATTACK}
			Castle Siege	NewAgeZ
			Castle owner	{#WONERCS}
			Attack time	{#CSATTACK}
			Siege participants	{#CSPARTICIPANTS}

			*/
		}

		private function ServerStatus()
		{
			//online
			return 'offline';
		}
		
		
		//online agora
		private function CountUserOnline()
		{
			$sql = "SELECT count(1) as Total  FROM ".DATABASE.".dbo.MEMB_STAT WHERE Connectstat = 1";
			$result = $this->selectDB($sql);
			if(count($result) > 0) return $result[0]->Total;
			return 0;
		}
		
		// numero de players online nas ultimas 24 horas
		private function activeLast24Hours()
		{
			$sql = 'SELECT count(*) as Total  FROM [dbo].[MEMB_STAT] WHERE [ConnectTM] BETWEEN  \''.date("Y-m-d", mktime(0,0,0, date("m"), date("d")-1, date("y"))).'\' AND \''.date("Y-m-d").'\'';
			$result = $this->selectDB($sql);
			if(count($result) > 0) return $result[0]->Total;
			return 0;			
		}
		
		// total de contas criadas
		private function totalAccounts()
		{		
			$sql = "SELECT count(1) as Total FROM ".DATABASE.".dbo.MEMB_INFO";
			$result = $this->selectDB($sql);
			if(count($result[0]->Total)>0) return $result[0]->Total;
			return 0;
		}
		
		//total de guilds
		private function totalGuilds()
		{
			$sql ="SELECT count(1) as Total from ".DATABASE.".dbo.Guild";
			$result = $this->selectDB($sql);
			if(count($result[0]->Total)>0) return $result[0]->Total;
			return 0;

		}
		
		// retorna o total de game masters no servidor
		private function gameMasters()
		{
			
			return 1;
		}
	}	
}
