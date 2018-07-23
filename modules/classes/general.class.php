<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "General" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class General   extends DataBase {
		public function __construct()
		{   Global $Tpl,$TABLES_CONFIGS;      
		$this->loadDivLoginLogout();
		 
		 
		 
		$Tpl->set('SITENAME',SITENAME);
		$Tpl->set('SERVERNAME',SERVERNAME);
		$Tpl->set('TEMPLATE',TEMPLATE_DIR);
		$Tpl->set('SITEBASE',''.SITEBASE.'/'.SITE_DIR.'');
		
		$Tpl->set('SERVERTIME',date("F d, Y H:i:s"));
		$Tpl->set('FBPAGE',FBPAGE);
		$Tpl->set('YOUTUBE',YOUTUBE);

		//
		$Tpl->set('CASH_NAME','W Coin (c)');
		
		$Tpl->set('VERSION',VERSION);
		$Tpl->set('EXPERIENCE',EXPERIENCE);
		$Tpl->set('DROP',DROP);
		$Tpl->set('SERVERTYPE',SERVERTYPE);
		$Tpl->set('BUGBLESS',BUGBLESS);
		$Tpl->set('MAXRESET',MAXRESET);
		$Tpl->set('AMOUNT[1][NAME]',$TABLES_CONFIGS['WEBCASH']['NAME'][1]);
		$Tpl->set('AMOUNT[2][NAME]',$TABLES_CONFIGS['WEBCASH']['NAME'][2]);
		$Tpl->set('AMOUNT[3][NAME]',$TABLES_CONFIGS['WEBCASH']['NAME'][3]);
		
		$Tpl->set('VIP[1][NAME]',$TABLES_CONFIGS['VIP']['NAME'][1]);
		$Tpl->set('VIP[2][NAME]',$TABLES_CONFIGS['VIP']['NAME'][2]);
		$Tpl->set('VIP[3][NAME]',$TABLES_CONFIGS['VIP']['NAME'][3]);
		
		
#{#VIP[1][NAME]} $TABLES_CONFIGS['VIP']['NAME']
		$Tpl->set('DATE',date('F d, Y  H:i:s'));
		
		
		$this->BasicStat();
		
		$Tpl->set('TOPPLAYERS',$this->TopPlayers());
		$Tpl->set('TOPGUILD',$this->TopGuilds());
		
		} 
		//alterna o menu para usuario logado
		public function loadDivLoginLogout()
		{
			
			global $Tpl;
			if(!isset($_SESSION[SESSION_NAME]))
			{	$divLTemp = fopen("templates/". TEMPLATE_DIR ."/". LANGUAGE_PATH ."/div[logout].tpl.php","r");
				$Tpl->set("DIV[LOGIN_LOGOUT]", fread($divLTemp,filesize("templates/". TEMPLATE_DIR ."/". LANGUAGE_PATH ."/div[LOGOUT].tpl.php")));
					}
			else 
			{
				$divLTemp = fopen("templates/". TEMPLATE_DIR ."/". LANGUAGE_PATH ."/div[login].tpl.php","r");
				$Tpl->set("DIV[LOGIN_LOGOUT]", fread($divLTemp,filesize("templates/". TEMPLATE_DIR ."/". LANGUAGE_PATH ."/div[LOGIN].tpl.php")));
			}		
					
					
		}
		
		public function TopPlayers()
		{ global $CLASS_CHARACTERS;
		$sql ='SELECT TOP 5 [AccountID]
      ,[Name]
      ,[Class]
      ,[ResetCount]
      ,[MasterResetCount]
  		FROM [dbo].[Character] WHERE [CtlCode] = 0 
		ORDER BY 
		[MasterResetCount] DESC,
		[ResetCount] DESC,
		[cLevel] DESC,
		[resetsWeek] DESC,
		[resetsMonth] DESC,
		[Experience] DESC';
			$return ='<ul class="hof">';
			$result = $this->selectDB($sql);
			$i = 1;
			foreach($result as &$row){


			
				
			$return .='
			 <li>
    <a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/'.$row->Name.'/"><strong>'.$row->Name.'</strong></a>&nbsp;-&nbsp; '.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'  <span>'.$row->ResetCount.' ['.$row->MasterResetCount.'] &nbsp; <img src="'.SITEBASE.'/'.SITE_DIR.'/templates/default/images/blank.png" class="flag-icon flag-icon-br" alt="Turkey" title="Turkey"></span> </li>
';
		   $i++;
			}
			$return .='</ul>';
			return $return;
			
		}
		/*
		
		        <ul class="hof">
  <li>
    <a href="{#SITEBASE}/profile/guild/req/KAMIKZE/"><strong>{#NAME}</strong></a>&nbsp;-&nbsp;{#CLASSE}  <span>344 [1] &nbsp; <img src="//www.rubygames.net/teste/web/templates/default/images/blank.png" class="flag-icon flag-icon-br" alt="Turkey" title="Turkey"></span> </li>
</ul>
		*/
		public function TopGuilds()
		{
			$sql ='SELECT TOP 5 G_Name,G_Master,G_Score,G_Mark,G_Union from Guild order by G_Score desc';
			$return ='<ul class="hof">';
			$result = $this->selectDB($sql);
			foreach($result as &$row){
				$tmpLogo = $row->G_Mark;
			$return .='<li>
                  <a href="{#SITEBASE}/profile/guild/req/'.$row->G_Name.'/"><strong>'.$row->G_Name.'</strong></a> <span>'.$row->G_Score.' &nbsp; <img style="width:25px" src="'.SITEBASE.'/'.SITE_DIR.'/ajax/index.php?page=logoGuildDecode&decode='.$tmpLogo.'&s=26"></span> </li>';
			}
			 $return .='</ul>';
			return $return; 
                
		}
		
		public function BasicStat()
		{ Global $Tpl;
			$sql = "SELECT count(1) as Total FROM ".DATABASE.".dbo.MEMB_INFO";
			$result = $this->selectDB($sql);
			$Tpl->set("TOTAL_ACCOUNTS", $result[0]->Total);
			
			$sql = "SELECT count(1) as Total FROM ".DATABASE.".dbo.Character";
			$result = $this->selectDB($sql);
			$Tpl->set("TOTAL_CHARATERS", $result[0]->Total);
		
			$sql ="SELECT count(1) as Total from ".DATABASE.".dbo.Guild";
			$result = $this->selectDB($sql);
			$Tpl->set("TOTAL_GUILD", $result[0]->Total);
			
			$sql = "SELECT count(1) as Total  FROM ".DATABASE.".dbo.MEMB_STAT WHERE Connectstat = 1";
			$result = $this->selectDB($sql);
			$Tpl->set("TOTAL_ONLINE", $result[0]->Total);
			
		//	$sql = "SELECT record  FROM ".DATABASE.".dbo.webRecord ORDER BY record DESC";
		//	$result = $this->selectDB($sql);
		//	$Tpl->set("RECORD_ONLINE", $result[0]->record);


			
		}

				}
}

