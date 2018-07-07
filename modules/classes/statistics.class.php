<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Statistics" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Statistics extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
		switch(@$_GET['load'])
		{
		case "server_status":
		$this->ServerStatus();
		break;
		case "server_online":
		$this->CountUserOnline();
		break;
		
		}
		}

		private function ServerStatus()
		{
		$server ='<div class="realm_st realm_st_bg">
				  <div class="realmst_head">
					<div class="realm_name"><span class="online"></span>Server PvP</div>
					<p class="realm-desc">Online Players: 0</p>
				  </div>
				</div>
				<div class="realm_st realm_st_bg2">
				  <div class="realmst_head">
					<div class="realm_name"><span class="online"></span>Server Non-PvP</div>
					<p class="realm-desc">Online Players: 0</p>
				  </div>
				</div>';
				//echo $server;
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
