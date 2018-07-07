<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Vault" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Vault   extends DataBase {
		public function __construct()
		{
			//$this->searchSlotsInVault(3, 3);
			$VirtualVault = new VirtualVault();
			$this->table();
		}
		
		//pucha as informações do bau
		private function GetVaultItensList()
		{//http://www.frienzmu.com/season9/templates/default/img/items/14-95.gif
			$sql = "SELECT Items FROM warehouse WHERE AccountID='".$_SESSION[SESSION_NAME]."'";
			$result1 = $this->selectDB($sql);
			$this->VaultSize =strlen($result1[0]->Items);
			//print($result1[0]->Items."\n\n");
			$size = 3840; 
			/**/
			$query = "SELECT CONVERT(TEXT, CONVERT(VARCHAR(".$size."), Items, 2)) [Items] 
			FROM [".DATABASE."].[dbo].[warehouse]
			 WHERE [AccountID] = '".$_SESSION[SESSION_NAME]."'";
			$result = $this->selectDB($query);
			$item = strtoupper($result[0]->Items);
			
		
			$codeGroup = str_split($item, 32);
			
			
	         foreach($codeGroup as $slot => $code)
            {
		
				if($code != "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"){
						$table[$slot] =["slot" => "1","item" => $code];
				}else{
						$table[$slot] =["slot" => "0","item" => $code];
				}
			}

			//print_r($codeGroup);
			$this->codeGroup = $table;
		}

		//ler o item txt para puchar informações
		private function LoadItemInfo()
		{
		$this->item_info = array();
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "".SITE_DIR."/ServerFiles/item/item.txt","r");
		while (!feof($handle))
		{
			$ItemInfo = fscanf($handle, '%d %d %d %d %d %d %d %d "%[^"]"');
			if(strpos($ItemInfo[0],"//") === false && isset($ItemInfo[0]))
			{
				if(!isset($ItemInfo[1]))
				{
					if($ItemInfo[0] !== "end")
					{
						$itemType = $ItemInfo[0];
					}
				}else
				{
					$this->item_info[$itemType][$ItemInfo[0]] = 
					array(
					"Slot" => $ItemInfo[1],
					"Skill" => $ItemInfo[2],
					"X" => $ItemInfo[3],
					"Y" => $ItemInfo[4],
					"Serial" => $ItemInfo[5],
					"Option" => $ItemInfo[6],
					"Drop" => $ItemInfo[7],
					"Name" => $ItemInfo[8]);
				}
				
			}
		}
		@fclose($handle);
		}
	
		//gera uma tabela para visualizaçao dos itens
		private function table()
		{	global $Tpl;
			$p = 0;
			$this->GetVaultItensList();//chama a classe bau
			$this->LoadItemInfo(); //le o arquivo item.txt

			//teste
			$slot = 0;		
			$table = '<table style="table-layout: fixed;margin: 0;padding: 0;width: 192px;background: url(templates/'.TEMPLATE_DIR.'/img/warehouse/warehouse_item_block.jpg);"><tbody>';	
			for($y = 0; $y < 15; $y++){//percorre o bau na vertical partindo de 0
				$table .= '<tr>';
			
				for($x = 0; $x < 8; $x++)//Corre o bau na horizontal
				{
					if($this->codeGroup[$slot]['slot'] != 2){
						
					if($this->codeGroup[$slot]['item'] !="FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")
					{	$this->cpos($this->codeGroup[$slot]['item']);//pucha as informaçõs do item
					$item_type = $this->item[0]['itemtype'];
					$item_id = $this->item[0]['id'];

						$ty = @$this->item_info[$item_type][$item_id]['Y'];
						$tx = @$this->item_info[$item_type][$item_id]['X'];

					$table .= '<td rowspan="'.$ty.'" colspan="'.$tx.'">
					<center  data-toggle="modal" data-target=".bs-example-modal-sm">
					<img src="templates/'.TEMPLATE_DIR.'/img/itens/'.$this->item[0]['itemtype'].'-'.$this->item[0]['id'].'.gif" class="img-responsive" title="'.@$this->item_info[$item_type][$item_id]['Name'].'" alt="'.@$this->item_info[$item_type][$item_id]['Name'].'">
					
					</center>
					</td>';
						$xslot = $slot;
						for($xx =0; $xx < $tx; $xx++){
							$this->codeGroup[$xslot]['slot'] = 2;

							$yslot = $xslot;
							for($yy = 1; $yy < $ty; $yy++){
							$yslot = $yslot+8;
							
							$this->codeGroup[$yslot]['slot'] = 2;
							}
							
							$xslot++;
						}

							//end largura
					}
					else{
								$table .= '<td><img src="templates/'.TEMPLATE_DIR.'/img/warehouse/warehouse_block.jpg"  class="img-responsive"></td>';
						}
					
					}

					$slot++;
				}
				$table .= '</tr>';
			}
			
		$table .= '</tbody></table>';	
		//print_r($this->codeGroup);
		$Tpl->set('VAULT',$table);
		//Vai verificar se tem algum lugar com spaço vazio para o novo item
		//$this->find_find_space($this->codeGroup);	
		//$sX = 3; //altura
		//$sY = 2;
		//$r = $this->searchSlotsInVault($sX, $sY);
		//print_r($r);
		}//end table

		// extrai as informações basicas do item
		function cpos($item)
		{
			
		$item = (substr($item, 0, 2) == '0x') ? $item = substr($item, 2) : $item = $item;
		$item_lenght =strlen($item);
		$item_split[] = array('id'			=> hexdec(substr($item,	0, 2)), 			// Item Id
							  'option'		=> hexdec(substr($item,	2, 2)),				// Item Option Date
							  'dur'			=> hexdec(substr($item, 4, 2)),				// Item Durability
							  'serial'		=> ($item_lenght == 32) ? substr($item, 6, 8) : substr($item,	9,	5),						// Item Serial Number
							  'exe'			=> hexdec(substr($item,	14,	2)),			// Item Excellent Info
							  'ancient'		=> hexdec(substr($item, 16, 2)),			// Item Ancient Info
							  'cat'			=> hexdec(substr($item,	18,	2)),			// Item Cat
							  'refinery'	=> hexdec(substr($item, 19,	1)),			// Item Refinery Info
							  'itemtype'	=> floor(hexdec(substr($item, 18, 2))/16)); // Item Type		
			
			
		$this->item =	$item_split;

		

		}//end cpos
		



		private function load_space_table()
		{	$p = 0;
			$this->GetVaultItensList();//chama a classe bau
			$this->LoadItemInfo(); //le o arquivo item.txt

			//teste
			$slot = 0;		
			for($y = 0; $y < 15; $y++){//percorre o bau na vertical partindo de 0
			
				for($x = 0; $x < 8; $x++)//Corre o bau na horizontal
				{
					if($this->codeGroup[$slot]['slot'] != 2){
						
					if($this->codeGroup[$slot]['item'] !="FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")
					{
					$this->cpos($this->codeGroup[$slot]['item']);//pucha as informaçõs do item
					$item_type = $this->item[0]['itemtype'];
					$item_id = $this->item[0]['id'];


						$ty = @$this->item_info[$item_type][$item_id]['Y'];
						$tx = @$this->item_info[$item_type][$item_id]['X'];

						$xslot = $slot;
						for($xx =0; $xx < $tx; $xx++){
							$this->codeGroup[$xslot]['slot'] = 2;

							$yslot = $xslot;
							for($yy = 1; $yy < $ty; $yy++){
							$yslot = $yslot+8;
							$this->codeGroup[$yslot]['slot'] = 2;
							}
							
							$xslot++;
						}

							//end largura
					}
					
					}

					$slot++;
				}
			}
			
		return
		$this->codeGroup;
		}//end table


	   	public function searchSlotsInVault($sX, $sY)
   		{
			$this->load_space_table();
		    $slot = 0;
			$msg = 'Não tem espaço';
            for($y = 0; $y < 15; $y++)
            {
                for($x = 0; $x < 8; $x++)
                {
                    if($this->codeGroup[$slot]['slot'] == 0)
                    {
                        $free = true;
						$Yslot = $slot;
                        if($y+$sY <= 15 && $x+$sX <= 8) 
                        {
                            for($cY = 0; $cY < $sY; $cY++)
                            {

                                if($this->codeGroup[$Yslot]['slot'] != 0){ $free = false; break; }
								//print("Y: ". $cY ." - ". $sY ." : Slot -> ". $Yslot ."<br>");
								$Xslot = $Yslot;
							    for($cX = 0; $cX < $sX; $cX++)
                                {
                                   if($this->codeGroup[$Xslot]['slot'] != 0){ $free = false; break; }
									//print("X: ". $cX ." - ". $sX ." : Slot -> ". $Xslot ."<br>");
							
								$Xslot++;
                                }		                               
								$Yslot =8+$Yslot;
								
                            }
							//print("<br>");
                            //if($free == true) print("<br>".$slot);
                        }
				   	if($free == true){
					//$msg = 'temos espaço para um item '.$sX.' por '.$sY.' no slot: '. $slot .''; 
					break;}
                   }

                    $slot++;
                }       
            }
			
            print($msg);	
		}
					
		}
}

