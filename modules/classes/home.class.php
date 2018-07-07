<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Home" ) == false ) {
 
    new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Home   extends DataBase {
		public function __construct()
		{
		if(RANKINGSGENS == true){
		$this->ScoreGens();
			}
		//$this->CsInfo();
		$this->text_home();

		}
		public function text_home()
		{ global $Tpl;
		
		$Tpl->set('LAST_NEWS_TITLE',LAST_NEWS_TITLE);
		$Tpl->set('LAST_NEWS_SHOW_ALL',LAST_NEWS_SHOW_ALL);
		
		}
		
		public function ScoreGens()
		{ Global $Tpl;
		$sql ='SELECT SUM([Contribution]) as Total FROM [dbo].[Gens_Rank] where [Family] = 1';
		$DUPRIAN = $this->selectDB($sql);
		$sql ='SELECT SUM([Contribution]) as Total FROM [dbo].[Gens_Rank] where [Family] = 2';
		$VARNET = $this->selectDB($sql);
		
		$sql ='SELECT SUM([Family]) as Total FROM [dbo].[Gens_Rank] where [Family] = 1';
		$DUPRIANFamily = $this->selectDB($sql);
		$sql ='SELECT SUM([Family]) as Total FROM [dbo].[Gens_Rank] where [Family] = 2';
		$VARNETFamily = $this->selectDB($sql);


		$sql ='SELECT Top 1 [Name] FROM [dbo].[Gens_Rank] WHERE [Family] =1 ORDER BY [Contribution] DESC';
		$DUPRIANMEMBER = $this->selectDB($sql);
		$sql ='SELECT Top 1 [Name] FROM [dbo].[Gens_Rank] WHERE [Family] =2 ORDER BY [Contribution] DESC';
		$VARNETMEMBER = $this->selectDB($sql);


			$Tpl->set('DUPRIAN',$DUPRIAN[0]->Total);
			$Tpl->set('VARNET',$VARNET[0]->Total);
			$Tpl->set('DUPRIAN[TOTAL]',$DUPRIANFamily[0]->Total);
			$Tpl->set('DUPRIAN[MEMBER]',$DUPRIANMEMBER[0]->Name);
			$Tpl->set('VARNET[TOTAL]',$VARNETFamily[0]->Total);
			$Tpl->set('VARNET[MEMBER]',$VARNETMEMBER[0]->Name);	
		
		
		}

		public function CsInfo()
		{ Global $Tpl,$MuCastleData;
		$sql ='SELECT [G_Master]
		,[G_Mark]
	  ,[SIEGE_END_DATE]
      ,[OWNER_GUILD]
      ,[MONEY]
      ,[TAX_HUNT_ZONE]
  FROM [dbo].[MuCastle_DATA] M INNER JOIN [dbo].Guild G ON G.G_Name = M.OWNER_GUILD';
		$result = $this->selectDB($sql);
		foreach($result as &$row){
		$G_Master = $row->G_Master;
		$G_Mark = $row->G_Mark;
		$SIEGE_END_DATE = $row->SIEGE_END_DATE;
		$OWNER_GUILD = $row->OWNER_GUILD;
		$MONEY = $row->MONEY;
		$TAX_HUNT_ZONE = $row->TAX_HUNT_ZONE;
					}
					
		$date = new DateTime($SIEGE_END_DATE);
		$start = $date->format('d-m-Y');	
		
		//Return Tpl			
		$Tpl->set('G_Master',$G_Master);
		$Tpl->set('G_Mark',$G_Mark);
		$Tpl->set('SIEGE_END_DATE',$start .' 17:00');
		$Tpl->set('OWNER_GUILD',$OWNER_GUILD);
		$Tpl->set('MONEY',$MONEY);
		$Tpl->set('TAX_HUNT_ZONE',$TAX_HUNT_ZONE);
		}
	
				}
}

