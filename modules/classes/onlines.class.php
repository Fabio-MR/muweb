<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Onlines" ) == false ) {
	new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Onlines extends DataBase {
		public function __construct()
		{ global $Tpl;
			$Tpl->set('ONLINES',$this->list_online());
		}
		
		private function list_online()
		{ global $CLASS_CHARACTERS;
		$sql ='SELECT [Character].[Name]
	  ,[cLevel]
      ,[Class]
      ,[ServerName]
      ,[ConnectTM]
      ,[OnlineHours]
	  ,[ResetCount]
	  ,[MasterResetCount]
	  ,[MasterLevel]
  FROM [dbo].[MEMB_STAT]
  INNER JOIN [dbo].[AccountCharacter] ON [dbo].[AccountCharacter].[Id] = [dbo].[MEMB_STAT].[memb___id]
  INNER JOIN [dbo].[Character] ON [dbo].[Character].[Name] = [dbo].[AccountCharacter].[GameIDC]
  INNER JOIN [dbo].[MasterSkillTree] ON [dbo].[MasterSkillTree].[Name] = [dbo].[Character].[Name]
  WHERE  [ConnectStat] = 1 ORDER BY [ResetCount] DESC, [MasterResetCount] DESC';
			$return ='
			<table class="table table-hover" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <th style="font-weight:bold;">#</th>
                  <th style="font-weight:bold;">Character</th>
                  <th style="font-weight:bold;">Class</th>
                  <th style="font-weight:bold;">Level[Master Level]</th>
                  <th style="font-weight:bold;">Reset [Grand Reset]</th>
                </tr>
              </tbody>';
 			$result = $this->selectDB($sql);
			$i =1;
			foreach($result as &$row){
			$row->Class = $row->Class ? : 0;
			$return .='
			<tr>
                <td>'.$i.'</td>
                <td><a href="#">'.$row->Name.'</a></td>
                <td>'.$CLASS_CHARACTERS['CLASSCODES'][''.$row->Class.''].'</td>
                <td>'.$row->cLevel.'<span class="small">['.$row->MasterLevel.']</span></td>
                <td>'.$row->ResetCount.'<span class="small">['.$row->MasterResetCount.']</span></td>
            </tr>';
			$i++;
			}
 		 $return .='</table>';
		 
		 return $return;
  	
		}
	}	
}

