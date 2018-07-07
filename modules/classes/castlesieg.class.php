<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "CastleSieg" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class CastleSieg   extends DataBase {
		public function __construct()
		{ 
			$this->CsInfo();
		}
		
		public function CsInfo()
		{ Global $Tpl;
		$sql ='SELECT [G_Master],[G_Union],[G_Mark]
      ,[SIEGE_START_DATE]
      ,[SIEGE_END_DATE]
      ,[SIEGE_GUILDLIST_SETTED]
      ,[SIEGE_ENDED]
      ,[CASTLE_OCCUPY]
      ,[OWNER_GUILD]
      ,[MONEY]
      ,[TAX_RATE_CHAOS]
      ,[TAX_RATE_STORE]
      ,[TAX_HUNT_ZONE]
  FROM [dbo].[MuCastle_DATA] M INNER JOIN [dbo].Guild G ON G.G_Name = M.OWNER_GUILD';
		$result = $this->selectDB($sql);
		foreach($result as &$row){
		$OWNER_GUILD = $row->OWNER_GUILD;
		$MONEY = $row->MONEY;
		$TAX_RATE_CHAOS = $row->TAX_RATE_CHAOS;
		$TAX_RATE_STORE = $row->TAX_RATE_STORE;
		$TAX_HUNT_ZONE = $row->TAX_HUNT_ZONE;
		$SIEGE_END_DATE = $row->SIEGE_END_DATE;
		$SIEGE_START_DATE = $row->SIEGE_START_DATE;
		$G_Mark = $row->G_Mark;
		$G_Master = $row->G_Master;
		$G_Union = $row->G_Union;
		}
  		$Tpl->set('G_Mark',$G_Mark);
		$Tpl->set('G_Master',$G_Master);
		$Tpl->set('G_Union',$G_Union);

		//Return Tpl			
		$Tpl->set('OWNER_GUILD',$OWNER_GUILD);
		$Tpl->set('MONEY',$MONEY);
		$Tpl->set('TAX_RATE_CHAOS',$TAX_RATE_CHAOS);
		$Tpl->set('TAX_RATE_STORE',$TAX_RATE_STORE);
		$Tpl->set('TAX_HUNT_ZONE',$TAX_HUNT_ZONE);
		$Tpl->set('SIEGE_END_DATE',$SIEGE_END_DATE);
		$this->Periods_Sieg($SIEGE_START_DATE);
		$this->Reg_Sieg();
	}
	
		public function GuildInfo($guild)
		{ global $Tpl;
		$sql ='SELECT [G_Name]
      ,[G_Mark]
      ,[G_Score]
      ,[G_Master]
      ,[G_Count]
      ,[G_Notice]
      ,[Number]
      ,[G_Type]
      ,[G_Rival]
      ,[G_Union]
      ,[MemberCount]
  FROM [dbo].[Guild] where [G_Name] =\''.$guild.'\'';	
  		$result = $this->selectDB($sql);
		foreach($result as &$row){
		$G_Mark = $row->G_Mark;
		$G_Master = $row->G_Master;
		$G_Union = $row->G_Union;
		}
  		$Tpl->set('G_Mark',$G_Mark);
		$Tpl->set('G_Master',$G_Master);
		$Tpl->set('G_Union',$G_Union);

		}

		public function Reg_Sieg()
		{ global $Tpl;
		$sql ='SELECT [MAP_SVR_GROUP]
      ,[REG_SIEGE_GUILD]
      ,[REG_MARKS]
      ,[IS_GIVEUP]
      ,[SEQ_NUM]
  FROM [dbo].[MuCastle_REG_SIEGE] WHERE [IS_GIVEUP] = \'0\'';		
		$result = $this->selectDB($sql);
		$reg ='';
		foreach($result as &$row){
			$reg .='     <tr>
                            <th width="50%">'.$row->REG_SIEGE_GUILD.'</th>
                            <th width="50%">'.$row->REG_MARKS.'</th>
                        </tr>';
		}

		$Tpl->set('REG_SIEGE',$reg);
		}
		
		public function Periods_Sieg($SIEGE_START_DATE)
		{ global $Tpl;
			
			$Tpl->set('PHASE1',$this->calc_dat($SIEGE_START_DATE,1).' - '.$this->calc_dat($SIEGE_START_DATE,2));
			$Tpl->set('PHASE2',$this->calc_dat($SIEGE_START_DATE,2).' - '.$this->calc_dat($SIEGE_START_DATE,3));
			$Tpl->set('PHASE3',$this->calc_dat($SIEGE_START_DATE,3).' - '.$this->calc_dat($SIEGE_START_DATE,4));
			$Tpl->set('PHASE4',$this->calc_dat($SIEGE_START_DATE,4).' - '.$this->calc_dat($SIEGE_START_DATE,5));
			$Tpl->set('PHASE5',$this->calc_dat($SIEGE_START_DATE,5).' - '.$this->calc_dat($SIEGE_START_DATE,6));
			$Tpl->set('PHASE6',$this->calc_dat($SIEGE_START_DATE,6).' - '.$this->calc_dat($SIEGE_START_DATE,7));
			$Tpl->set('PHASE7',$this->calc_dat($SIEGE_START_DATE,7).' - '.$this->calc_dat($SIEGE_START_DATE,8));
			$Tpl->set('PHASE8',$this->calc_dat($SIEGE_START_DATE,8).' - '.$this->calc_dat($SIEGE_START_DATE,9));


		}


		private function calc_dat($START_DATE,$PERIOD)
		{ Global $MuCastleData;
		$date = new DateTime($START_DATE);
		$day = $MuCastleData[$PERIOD]['day'];
		$hour = $MuCastleData[$PERIOD]['hour'];
		$minutes = $MuCastleData[$PERIOD]['minute'];
			
		$date->add(new DateInterval('P'.$day.'DPT'.$hour.'H'.$minutes.'M'));
			
		return $date->format('d-m-Y H:i');
		}
				}
}

