<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Rankings" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Rankings   extends DataBase {
		public function __construct()
		{   Global $Tpl;                        
			switch(@$_GET['type'])
			{
					case "characters":
					$this->gerateRankingCharacter();
					$RankingName ="personagens";
					break;
					case "duels":
					$this->gerateRankingDuels();
					$RankingName ="duelos";
					break;
					case "guilds":
					$this->gerateRankingGuilds();
					$RankingName ="Guilds";
					break;
					case "bloodcastle":
					$this->gerateRankingBloodCastle();
					$RankingName ="Blood Castle";
					break;
					//gerateRankingChaosCastle
					case "chaoscastle":
					$this->gerateRankingChaosCastle();
					$RankingName ="Chaos castle";
					break;					
					case "devilsquare":
					$RankingName ="Devil Square";
					$this->gerateRankingDevilSquare();
					break;
					case "illusiontemple":
					$this->gerateRankingDevilSquare();
					$RankingName ="Illusion Temple";
					break;
					case "monster":
					$this->gerateRankingMonster();
					$RankingName ="Kill Monster";
					break;
					
				    default:
					$this->gerateRankingCharacter();
					$RankingName ="personagens";
					break;
				
			}
			
			$Tpl->set("RAKING-NAME", $RankingName);
			$Tpl->set("ResultRankings", $this->returnRanking);
			$this->ListActiveRanking();

		}


        private function gerateRankingCharacter()
        { global $CLASS_CHARACTERS;
			switch(@$_GET['class'])
			{
				case "wizard":
				$where ='AND [Class] IN (1,2,3)';
				break;
				case "knight":
				$where ='AND [Class] IN (16,17,18)';
				break;
				case "elf":
				$where ='AND [Class] IN (31,32,33)';
				break;
				case "summoner":
				$where ='AND [Class] IN (80,81,82)';
				break;
				case "gladiator":
				$where ='AND [Class] IN (48,50)';
				break;
				case "lord":
				$where ='AND [Class] IN (64,65)';
				break;
				default:
				$where ='';
				break;
			}
			$sql ='SELECT TOP 100
			[m].[MasterLevel]
			,[c].[Name]
			,[cLevel]
			,[Class]
			,[Experience]
			,[PkCount]
			,[PkLevel]
			,[PkTime]
			,[CtlCode]
			,[ResetCount]
			,[MasterResetCount]
			,[resetsWeek]
			,[resetsMonth]
			FROM [dbo].[Character] [c] INNER JOIN [dbo].[MasterSkillTree] [m] ON [c].[Name] = [m].[Name]
			WHERE
			[CtlCode] = 0 
			'.$where.'
			ORDER BY 
			[MasterResetCount] DESC,
			[ResetCount] DESC,
			[cLevel] DESC,
			[resetsWeek] DESC,
			[resetsMonth] DESC,
			[Experience] DESC';
	  		$result = $this->selectDB($sql);

		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
		          '<table class="topics" cellspacing="0" width="100%">
            		<tbody><tr>
                      <th style="font-weight:bold;">#</th>
                      <th style="font-weight:bold;">Character</th>
                      <th style="font-weight:bold;">Class</th>
                      <th style="font-weight:bold;">Level</th>
                      <th style="font-weight:bold;">Master Level</th>
                      <th style="font-weight:bold;">Resets</th>
                    </tr></tbody>';
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->cLevel.'</td>
              <td>'.$row->MasterLevel.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;
		}
					
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}
		
        private function gerateRankingScore()
		{
			/*
			Characters Score ranking is a special ranking based on multiple factors. Total score is counted from character's level, master level, reset, grand reset, stats, achievements, duels, gens and couple events (BC, DS, CC and IT).
			
			<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Level</th><th style="font-weight:bold;">Master Level</th><th style="font-weight:bold;">Reset [Grand Reset]</th><th>Score</th><th style="font-weight:bold;">Country</th></tr>
			*/
			
		}
		
        private function gerateRankingGuilds()
		{	
		$sql ='SELECT TOP 100 G_Name,G_Master,G_Score,G_Mark,G_Union from Guild order by G_Score desc';
  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
  		$i=1;
		$this->returnRanking  =
		          '<table class="topics" cellspacing="0" width="100%">
					<thead>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Guild Name</th>
					  <th style="font-weight:bold;">Guild Logo</th>
					  <th style="font-weight:bold;">Guild Master</th>
					  <th>Total Scores</th>
					  <th style="font-weight:bold;">Total Members</th>
					</tr>
					</thead>';
		
		foreach($result as $row){		
			$this->returnRanking  .=
		          '<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">'.$row->G_Name.'</th>
					  <th style="font-weight:bold;"><img src="'.SITEBASE.'/'.SITE_DIR.'/ajax/index.php?page=logoGuildDecode&decode='.$row->G_Mark.'&s=26" width="25px"></th>
					  <th style="font-weight:bold;">'.$row->G_Master.'r</th>
					  <th>'.$row->G_Score.'</th>
					  <th style="font-weight:bold;">Total Levels</th>
					</tr>';
			
		}
		$this->returnRanking  .='</table>';
		return 		$this->returnRanking;
		}
		
		private function gerateRankingOnlinePlayers()
		{
			/*
			<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Level</th><th style="font-weight:bold;">Master Level</th><th style="font-weight:bold;">Reset [Grand Reset]</th><th style="font-weight:bold;">Location</th><th style="font-weight:bold;">Server</th><th style="font-weight:bold;">Country</th></tr>
			*/
		}
		
		private function gerateRankingLevel()
		{
		/*
		<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Level</th></tr>
		*/	
		}
		
		private function gerateRankingMaster()
		{
/*
<tr><th style="font-weight:bold;" #=""></th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Master Level</th></tr>
*/

		}
		
		private function gerateRankingResets()
		{
/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Resets</th></tr>
*/

		}
		
		private function gerateRankingGrandResets()
		{
		/*
	<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Grand Resets</th></tr>	
		*/	
		}
		
		private function gerateRankingKillers()
		{
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Kills</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		}
		
		private function gerateRankingDuels()
		{global $CLASS_CHARACTERS;
		$sql ='SELECT c.[Name],[Class],[WinScore],[LoseScore]
  FROM [dbo].[RankingDuel] d INNER JOIN [Character] c on  c.[Name] = d.[Name] ORDER BY [WinScore] DESC, [LoseScore] ASC
';
  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
	'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Wins</th>
					  <th style="font-weight:bold;">Losses</th>
					  <th style="font-weight:bold;">Win Ratio</th>
					  <th style="font-weight:bold;">Country</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			
			
			$ratio = ($row->WinScore*100)/($row->WinScore+$row->LoseScore);
			
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->WinScore.'</td>
              <td>'.$row->LoseScore.'</td>
              <td>'.$ratio.'%</td>
              <td><img src="'.SITEBASE.'/'.SITE_DIR.'/templates/default/images/blank.png" class="flag-icon flag-icon-br" alt="Turkey" title="Turkey"></td>
               </tr>';
			   $i++;
		}
					
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;

		}
		
		private function gerateRankingOnline()
		{
		/*
	<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Online Time</th><th style="font-weight:bold;">Country</th></tr>	
		*/	
		}
		
		private function gerateRankingGens()
		{
		/*
		<div class="cont-image"><div class="rankings_menu_filter"><a href="http://www.frienzmu.com/rankings/gens/" class="active">ALL</a><a href="http://www.frienzmu.com/rankings/gens/filter/duprian/">Duprian</a><a href="http://www.frienzmu.com/rankings/gens/filter/vanert/">Vanert</a></div><div class="container_3 account-wide" align="center"><table class="topics" cellspacing="0" width="100%"><tbody><tr><th rowspan="2" width="10%"><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d1.png"></th><th rowspan="2" width="10%">Duprian</th><td width="30%">12,118 Points</td><td width="30%">11,937 Points</td><th rowspan="2" width="10%">Vanert</th><th rowspan="2" width="10%"><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v1.png"></th></tr><tr><td>50%</td><td>50%</td></tr></tbody></table></div><div class="container_3 account-wide" align="center"><table class="topics" cellspacing="0" width="100%"><tbody><tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;" colspan="2">Rank</th><th style="font-weight:bold;">Contribution</th><th style="font-weight:bold;">Country</th></tr><tr><td>1</td><td><a href="http://www.frienzmu.com/profile/player/req/4f75544c6157/">OuTLaW</a></td><td>Fist Master</td><td>Grand Duke</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v1.png" title="Gens Vanert" alt="Gens Vanert"></td><td>5025</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>2</td><td><a href="http://www.frienzmu.com/profile/player/req/426a6a6a4b/">BjjjK</a></td><td>Fist Master</td><td>Grand Duke</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d1.png" title="Gens Duprian" alt="Gens Duprian"></td><td>5012</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>3</td><td><a href="http://www.frienzmu.com/profile/player/req/4c696f6e6865617274/">Lionheart</a></td><td>Lord Emperor</td><td>Duke</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d2.png" title="Gens Duprian" alt="Gens Duprian"></td><td>5001</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>4</td><td><a href="http://www.frienzmu.com/profile/player/req/486172656b6574/">Hareket</a></td><td>Blade Master</td><td>Lieutenant</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v12.png" title="Gens Vanert" alt="Gens Vanert"></td><td>1100</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>5</td><td><a href="http://www.frienzmu.com/profile/player/req/4b41524144415949/">KARADAYI</a></td><td>Blade Master</td><td>Sergeant</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v13.png" title="Gens Vanert" alt="Gens Vanert"></td><td>387</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>6</td><td><a href="http://www.frienzmu.com/profile/player/req/4971587049/">IqXpI</a></td><td>Blade Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>180</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>7</td><td><a href="http://www.frienzmu.com/profile/player/req/42726176656865617274/">Braveheart</a></td><td>Blade Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>82</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>8</td><td><a href="http://www.frienzmu.com/profile/player/req/43654c4c6154/">CeLLaT</a></td><td>Fist Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>70</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>9</td><td><a href="http://www.frienzmu.com/profile/player/req/48656c6c/">Hell</a></td><td>Lord Emperor</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>65</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-ro" alt="Romania" title="Romania"></td></tr><tr><td>10</td><td><a href="http://www.frienzmu.com/profile/player/req/5261646973736f6e/">Radisson</a></td><td>Dark Lord</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>40</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-az" alt="Azerbaijan" title="Azerbaijan"></td></tr><tr><td>11</td><td><a href="http://www.frienzmu.com/profile/player/req/54694d654b6565506552/">TiMeKeePeR</a></td><td>Fist Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>40</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>12</td><td><a href="http://www.frienzmu.com/profile/player/req/496d4b616e53697a/">ImKanSiz</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>35</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>13</td><td><a href="http://www.frienzmu.com/profile/player/req/4b616850655f534d/">KahPe_SM</a></td><td>Dimension Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>20</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>14</td><td><a href="http://www.frienzmu.com/profile/player/req/41706f63614c79707365/">ApocaLypse</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>20</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>15</td><td><a href="http://www.frienzmu.com/profile/player/req/6a6576656c63616e6176/">jevelcanav</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>20</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>16</td><td><a href="http://www.frienzmu.com/profile/player/req/44415251/">DARQ</a></td><td>Rage Fighter</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-ar" alt="Argentina" title="Argentina"></td></tr><tr><td>17</td><td><a href="http://www.frienzmu.com/profile/player/req/53686571696c444c/">SheqilDL</a></td><td>Lord Emperor</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-vn" alt="Viet Nam" title="Viet Nam"></td></tr><tr><td>18</td><td><a href="http://www.frienzmu.com/profile/player/req/53656e746574696b/">Sentetik</a></td><td>High Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>19</td><td><a href="http://www.frienzmu.com/profile/player/req/5465614d5374615272/">TeaMStaRr</a></td><td>Dimension Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-aq" alt="Antarctica" title="Antarctica"></td></tr><tr><td>20</td><td><a href="http://www.frienzmu.com/profile/player/req/4368617373/">Chass</a></td><td>Bloody Summoner</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>21</td><td><a href="http://www.frienzmu.com/profile/player/req/426c6f6f64/">Blood</a></td><td>Dimension Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>15</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>22</td><td><a href="http://www.frienzmu.com/profile/player/req/7465646459/">teddY</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>23</td><td><a href="http://www.frienzmu.com/profile/player/req/54654b4c69446552/">TeKLiDeR</a></td><td>Blade Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-ro" alt="Romania" title="Romania"></td></tr><tr><td>24</td><td><a href="http://www.frienzmu.com/profile/player/req/426c7565447265616d/">BlueDream</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>25</td><td><a href="http://www.frienzmu.com/profile/player/req/426f6c64/">Bold</a></td><td>Soul Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>26</td><td><a href="http://www.frienzmu.com/profile/player/req/54656e677269/">Tengri</a></td><td>Rage Fighter</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>27</td><td><a href="http://www.frienzmu.com/profile/player/req/54657374534d/">TestSM</a></td><td>Grand Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-" alt="" title=""></td></tr><tr><td>28</td><td><a href="http://www.frienzmu.com/profile/player/req/426f7373/">Boss</a></td><td>Blade Knight</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-es" alt="Spain" title="Spain"></td></tr><tr><td>29</td><td><a href="http://www.frienzmu.com/profile/player/req/426a6a4b/">BjjK</a></td><td>Dimension Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>30</td><td><a href="http://www.frienzmu.com/profile/player/req/5468616e61746f73/">Thanatos</a></td><td>Lord Emperor</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-bg" alt="Bulgaria" title="Bulgaria"></td></tr><tr><td>31</td><td><a href="http://www.frienzmu.com/profile/player/req/5468617454686548656c/">ThatTheHel</a></td><td>Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-vn" alt="Viet Nam" title="Viet Nam"></td></tr><tr><td>32</td><td><a href="http://www.frienzmu.com/profile/player/req/426a6f726e/">Bjorn</a></td><td>Fist Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-gb" alt="United Kingdom" title="United Kingdom"></td></tr><tr><td>33</td><td><a href="http://www.frienzmu.com/profile/player/req/426c6164654b696e67/">BladeKing</a></td><td>Blade Knight</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-ar" alt="Argentina" title="Argentina"></td></tr><tr><td>34</td><td><a href="http://www.frienzmu.com/profile/player/req/5468452d536d/">ThE-Sm</a></td><td>Dark Wizard</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>35</td><td><a href="http://www.frienzmu.com/profile/player/req/546865426c6f6f64/">TheBlood</a></td><td>Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>36</td><td><a href="http://www.frienzmu.com/profile/player/req/63656d31393834/">cem1984</a></td><td>Blade Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>37</td><td><a href="http://www.frienzmu.com/profile/player/req/63656d33343335/">cem3435</a></td><td>Dark Wizard</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>38</td><td><a href="http://www.frienzmu.com/profile/player/req/546865446576696c/">TheDevil</a></td><td>Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>39</td><td><a href="http://www.frienzmu.com/profile/player/req/5468654b696e67564e/">TheKingVN</a></td><td>Blade Knight</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-vn" alt="Viet Nam" title="Viet Nam"></td></tr><tr><td>40</td><td><a href="http://www.frienzmu.com/profile/player/req/636579636579/">ceycey</a></td><td>Blade Master</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-ro" alt="Romania" title="Romania"></td></tr><tr><td>41</td><td><a href="http://www.frienzmu.com/profile/player/req/5468654f72646572/">TheOrder</a></td><td>Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>42</td><td><a href="http://www.frienzmu.com/profile/player/req/4275666978/">Bufix</a></td><td>Elf</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-pl" alt="Poland" title="Poland"></td></tr><tr><td>43</td><td><a href="http://www.frienzmu.com/profile/player/req/427572616b/">Burak</a></td><td>Dark Lord</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>44</td><td><a href="http://www.frienzmu.com/profile/player/req/546869734973536d67/">ThisIsSmg</a></td><td>Magic Gladiator</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>45</td><td><a href="http://www.frienzmu.com/profile/player/req/54686f6d6173/">Thomas</a></td><td>Dark Knight</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>46</td><td><a href="http://www.frienzmu.com/profile/player/req/30314a694e/">01JiN</a></td><td>Summoner</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>47</td><td><a href="http://www.frienzmu.com/profile/player/req/4141546f6d/">AATom</a></td><td>Dark Knight</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-vn" alt="Viet Nam" title="Viet Nam"></td></tr><tr><td>48</td><td><a href="http://www.frienzmu.com/profile/player/req/54687970686f6e/">Thyphon</a></td><td>Summoner</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>49</td><td><a href="http://www.frienzmu.com/profile/player/req/54697272656b/">Tirrek</a></td><td>Dark Wizard</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/v14.png" title="Gens Vanert" alt="Gens Vanert"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr><tr><td>50</td><td><a href="http://www.frienzmu.com/profile/player/req/41626179/">Abay</a></td><td>Rage Fighter</td><td>Private</td><td><img class="rankings-gens-img" src="http://www.frienzmu.com/templates/default/img/d14.png" title="Gens Duprian" alt="Gens Duprian"></td><td>10</td><td><img src="http://www.frienzmu.com/templates/default/style/images/blank.png" class="flag-icon flag-icon-tr" alt="Turkey" title="Turkey"></td></tr></tbody></table><div class="rankings-update-time">Last Updated @ 01/09/2016, 22:55</div></div>
  </div>
		*/	
		}
		
		private function gerateRankingVotes()
		{
		/*
		<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Votes</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		}
		
		private function gerateRankingAchievements()
		{
		/*
		<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Completed</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		}
		
		private function gerateRankingMarried()
		{
		/*
		<tr><th style="font-weight:bold;">Character #1</th><th style="font-weight:bold;">Character #2</th></tr>
		*/	
		}
		
		private function gerateRankingDevilSquare()
		{global $CLASS_CHARACTERS;
		$sql = 'SELECT Top 100 r.[Name] ,r.[Score],c.Class, c.ResetCount FROM [dbo].[RankingDevilSquare] r INNER JOIN
 Character c ON c.Name = r.Name ORDER BY [Score] DESC';
	  	$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
		'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Scores</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Resets</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->Score.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;			
		}
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Played</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}		
		private function gerateRankingBloodCastle()
		{global $CLASS_CHARACTERS;
		$sql = 'SELECT Top 100 r.[Name] ,r.[Score],c.Class, c.ResetCount FROM [dbo].[RankingBloodCastle] r INNER JOIN
 Character c ON c.Name = r.Name ORDER BY [Score] DESC';
	  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
	'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Scores</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Resets</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->Score.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;			
		}
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Played</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}
				
		private function gerateRankingChaosCastle()
		{global $CLASS_CHARACTERS;
		$sql = 'SELECT Top 100 r.[Name] ,r.[Score],c.Class, c.ResetCount FROM [dbo].[RankingChaosCastle] r INNER JOIN
 Character c ON c.Name = r.Name ORDER BY [Score] DESC';
	  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
	'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Scores</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Resets</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->Score.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;			
		}
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Played</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}		
		
		private function gerateRankingMonster()
		{global $CLASS_CHARACTERS;
		$sql = 'SELECT Top 100 r.[Name] ,r.[Score],c.Class, c.ResetCount FROM [dbo].[RankingMonster] r INNER JOIN
 Character c ON c.Name = r.Name ORDER BY [Score] DESC';
	  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
	'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Scores</th>
					  <th style="font-weight:bold;">Resets</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->Score.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;			
		}
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Played</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}		
		
		private function gerateRankingIllusionTemple()
		{global $CLASS_CHARACTERS;
		$sql = 'SELECT Top 100 r.[Name] ,r.[Score],c.Class, c.ResetCount FROM [dbo].[RankingIllusionTemple] r INNER JOIN
 Character c ON c.Name = r.Name ORDER BY [Score] DESC';
	  		$result = $this->selectDB($sql);
		//print("<!-- ".$sql." -->");
		$this->returnRanking  ='';
  		$i=1;
		$this->returnRanking  .=
	'<table class="topics" cellspacing="0" width="100%">
            <tbody>
					<tr>
					  <th style="font-weight:bold;">#</th>
					  <th style="font-weight:bold;">Character</th>
					  <th style="font-weight:bold;">Scores</th>
					  <th style="font-weight:bold;">Class</th>
					  <th style="font-weight:bold;">Resets</th>
					</tr>
			</tbody>';
		
		foreach($result as $row){
			$this->returnRanking  .='
			 <tr>
             <td>'.$i.'</td>
             <td><a href="'.SITEBASE.'/'.SITE_DIR.'/profile/player/req/61646979616d616e73/">'.$row->Name.'</a></td>
             <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
             <td>'.$row->Score.'</td>
              <td>'.$row->ResetCount.'</td>
               </tr>';
			   $i++;			
		}
		/*
<tr><th style="font-weight:bold;">#</th><th style="font-weight:bold;">Character</th><th style="font-weight:bold;">Class</th><th style="font-weight:bold;">Points</th><th style="font-weight:bold;">Played</th><th style="font-weight:bold;">Country</th></tr>
		*/	
		$this->returnRanking .='</table>';	
		return 		$this->returnRanking;
		}		
		private function gerateRankingCsHistory()
		{
		/*
<tr><th style="font-weight:bold;">Period</th><th style="font-weight:bold;">Owner Guild</th><th style="font-weight:bold;">Guild Master</th><th style="font-weight:bold;">Losses</th></tr>		
		*/	
		}		

		private function ListActiveRanking()
		{ global $Tpl;
		$RANKING[] = (object) ["URL" => 'characters',"NAME" => 'Top Characters',"FILTER" => '1',];
		$RANKING[] = (object) ["URL" => 'guilds',"NAME" => 'Top Guilds',"FILTER" => '0',];
		$RANKING[] = (object) ["URL" => 'duels',"NAME" => 'Top Duelos',"FILTER" => '0',];
		
		#$RANKING[] = (object) ["URL" => 'gens',"NAME" => 'Top Gens',"FILTER" => '0',];
		#$RANKING[] = (object) ["URL" => 'gens',"NAME" => 'Top Gens',"FILTER" => '0',];
		
		$RANKING[] = (object) ["URL" => 'devilsquare',"NAME" => 'Devil Square',"FILTER" => '0',];
		$RANKING[] = (object) ["URL" => 'bloodcastle',"NAME" => 'Blood Castle',"FILTER" => '0',];
		$RANKING[] = (object) ["URL" => 'chaoscastle',"NAME" => 'Chaos Castle',"FILTER" => '0',];
		$RANKING[] = (object) ["URL" => 'illusiontemple',"NAME" => 'Illusion Temple',"FILTER" => '0',];
		$RANKING[] = (object) ["URL" => 'monster',"NAME" => 'Kill Monster',"FILTER" => '0',];
		//$RANKING[] = (object) ["URL" => 'cshistory',"NAME" => 'Castle Siege',"FILTER" => '0',];
		//
		
		$list ='';
		foreach ($RANKING as &$row){
			$list .='<a class="nice-button" href="ratings/'.$row->URL.'/">'.$row->NAME.'</a>';
		}
		//<a class="nice-button" href="ratings/users/">
		
		$Tpl->set('RANKINGS',$list);
		}
		
		private function FilterRanking()
		{
			
		}
	}
	
}

