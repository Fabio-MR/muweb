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
			
			
			/*
			Server status	 Season 4 Special Episode
			Online	0
			Active players 24h	{#ACTIVEDAY}
			Game Masters	{#TOTALGAMEMASTER}
			Accounts	{#TOTALACCOUNTS}
			Guilds	{#TOTALGUILDS}
			Version	{#SERVERVERSION}
			Experience	500x
			Crywolf	NewAgeZ
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
		
		private function CountUserOnline()
		{
			$sql = "SELECT count(1) as Total  FROM ".DATABASE.".dbo.MEMB_STAT WHERE Connectstat = 1";
			$result = $this->selectDB($sql);
			$online ='<p class="status online" id="logon-status2">Online ('.$result[0]->Total.')</p>';
			//Salvar o record de usurios online
			$record ='SELECT [record] FROM [dbo].[webRecord] ORDER BY record DESC';
			$result_record = $this->selectDB($record);
			if($result_record[0]->record < $result[0]->Total){
				$sql ='INSERT INTO [dbo].[webRecord]
           ([record],[date])
     VALUES
           ('.$result[0]->Total.'
           ,'.time().')';
		   	$this->insertDB($sql);
			}
			//end salvar record
			echo $online;
		}
	
	}	
}
