<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Item" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Item   extends DataBase {
		public function __construct()
		{
			if($_SESSION[SESSION_NAME] == 'fabiomr'){
				//$z = $this->GenerateItemSerial();
			//print($z);
			}
		}

		public function LoadItemInfo()
		{
		$this->item_info = array();
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "".SITE_DIR."/ServerFiles/item/item.txt","r");
		while (!feof($handle))
		{
			$ItemInfo = fscanf($handle, '%d %s %d %d %d %d %d %d "%[^"]" %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d %d');
			if(strpos($ItemInfo[0],"//") === false && isset($ItemInfo[0]))
			{
				if(!isset($ItemInfo[1]))
				{
					if($ItemInfo[0] !== "end")
					{
						$itemType = $ItemInfo[0];
					}
				} /*
				else
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
					"Name" => $ItemInfo[8]
					);
				
				} */
				else
				{
					$this->item_info[$itemType][$ItemInfo[0]] = array("Slot" => $ItemInfo[1], "Skill" => $ItemInfo[2], "X" => $ItemInfo[3], "Y" => $ItemInfo[4], "Serial" => $ItemInfo[5], "Option" => $ItemInfo[6], "Drop" => $ItemInfo[7], "Name" => $ItemInfo[8]);
					
					if($itemType != 14)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["Level"] = $ItemInfo[9];
						$this->item_info[$itemType][$ItemInfo[0]]["LevelSpecial"] = $ItemInfo[9];
					}
					else
					{
						$this->item_info[$itemType][$ItemInfo[0]]["Value"] = $ItemInfo[9];
						$this->item_info[$itemType][$ItemInfo[0]]["Level"] = $ItemInfo[10];
						$this->item_info[$itemType][$ItemInfo[0]]["LevelSpecial"] = $ItemInfo[10];
					}
					
					if($itemType <= 5)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["DmgMin"] = $ItemInfo[10];
						$this->item_info[$itemType][$ItemInfo[0]]["DmgMax"] = $ItemInfo[11];
						$this->item_info[$itemType][$ItemInfo[0]]["AttackSpeed"] = $ItemInfo[12];
						$this->item_info[$itemType][$ItemInfo[0]]["Durability"] = $ItemInfo[13];
						$this->item_info[$itemType][$ItemInfo[0]]["MagicDur"] = $ItemInfo[14];
						$this->item_info[$itemType][$ItemInfo[0]]["MagicPwr"] = $ItemInfo[15];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqLevel"] = $ItemInfo[16];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqStr"] = $ItemInfo[17];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqAgi"] = $ItemInfo[18];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqEne"] = $ItemInfo[19];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqVit"] = $ItemInfo[20];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqCom"] = $ItemInfo[21];
						$this->item_info[$itemType][$ItemInfo[0]]["Type"] = $ItemInfo[22];
						$this->item_info[$itemType][$ItemInfo[0]]["DW"] = $ItemInfo[23];
						$this->item_info[$itemType][$ItemInfo[0]]["DK"] = $ItemInfo[24];
						$this->item_info[$itemType][$ItemInfo[0]]["EL"] = $ItemInfo[25];
						$this->item_info[$itemType][$ItemInfo[0]]["MG"] = $ItemInfo[26];
						$this->item_info[$itemType][$ItemInfo[0]]["DL"] = $ItemInfo[27];
						$this->item_info[$itemType][$ItemInfo[0]]["SU"] = $ItemInfo[28];
						$this->item_info[$itemType][$ItemInfo[0]]["RF"] = $ItemInfo[29];
					}
					if($itemType == 5)
						$this->item_info[$itemType][$ItemInfo[0]]["Durability"] = $ItemInfo[14];
					
					if($itemType >= 6 && $itemType <= 12)
						$this->item_info[$itemType][$ItemInfo[0]]["Defense"] = $ItemInfo[10];

					if($itemType >= 6 && $itemType <= 11)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["Durability"] = $ItemInfo[12];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqLevel"] = $ItemInfo[13];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqStr"] = $ItemInfo[14];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqAgi"] = $ItemInfo[15];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqEne"] = $ItemInfo[16];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqVit"] = $ItemInfo[17];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqCom"] = $ItemInfo[18];
						$this->item_info[$itemType][$ItemInfo[0]]["Type"] = $ItemInfo[19];
						$this->item_info[$itemType][$ItemInfo[0]]["DW"] = $ItemInfo[20];
						$this->item_info[$itemType][$ItemInfo[0]]["DK"] = $ItemInfo[21];
						$this->item_info[$itemType][$ItemInfo[0]]["EL"] = $ItemInfo[22];
						$this->item_info[$itemType][$ItemInfo[0]]["MG"] = $ItemInfo[23];
						$this->item_info[$itemType][$ItemInfo[0]]["DL"] = $ItemInfo[24];
						$this->item_info[$itemType][$ItemInfo[0]]["SU"] = $ItemInfo[25];
						$this->item_info[$itemType][$ItemInfo[0]]["RF"] = $ItemInfo[26];	
					}
					
					if($itemType == 6)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["DefRate"] = $ItemInfo[11];
					}
					if($itemType >= 7 && $itemType <= 9)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["MagicDef"] = $ItemInfo[11];
					}
					if($itemType >= 10 || $itemType <= 11)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["Speed"] = $ItemInfo[11];
					}					
					if($itemType == 12)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["Durability"] = $ItemInfo[11];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqLevel"] = $ItemInfo[12];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqEne"] = $ItemInfo[13];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqStr"] = $ItemInfo[14];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqAgi"] = $ItemInfo[15];
						$this->item_info[$itemType][$ItemInfo[0]]["ReqCom"] = $ItemInfo[16];
						$this->item_info[$itemType][$ItemInfo[0]]["Zen"] = $ItemInfo[17];
						$this->item_info[$itemType][$ItemInfo[0]]["DW"] = $ItemInfo[18];
						$this->item_info[$itemType][$ItemInfo[0]]["DK"] = $ItemInfo[19];
						$this->item_info[$itemType][$ItemInfo[0]]["EL"] = $ItemInfo[20];
						$this->item_info[$itemType][$ItemInfo[0]]["MG"] = $ItemInfo[21];
						$this->item_info[$itemType][$ItemInfo[0]]["DL"] = $ItemInfo[22];
						$this->item_info[$itemType][$ItemInfo[0]]["SU"] = $ItemInfo[23];
						$this->item_info[$itemType][$ItemInfo[0]]["RF"] = $ItemInfo[24];						
					}
					if($itemType == 13)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["ReqLevel"] = $ItemInfo[9];
						$this->item_info[$itemType][$ItemInfo[0]]["Durability"] = $ItemInfo[10];
						$this->item_info[$itemType][$ItemInfo[0]]["Ice"] = $ItemInfo[11];
						$this->item_info[$itemType][$ItemInfo[0]]["Poison"] = $ItemInfo[12];
						$this->item_info[$itemType][$ItemInfo[0]]["Lightning"] = $ItemInfo[13];
						$this->item_info[$itemType][$ItemInfo[0]]["Fire"] = $ItemInfo[14];
						$this->item_info[$itemType][$ItemInfo[0]]["Earth"] = $ItemInfo[15];
						$this->item_info[$itemType][$ItemInfo[0]]["Wind"] = $ItemInfo[16];
						$this->item_info[$itemType][$ItemInfo[0]]["Water"] = $ItemInfo[17];
						$this->item_info[$itemType][$ItemInfo[0]]["Type"] = $ItemInfo[18];
						$this->item_info[$itemType][$ItemInfo[0]]["DW"] = $ItemInfo[19];
						$this->item_info[$itemType][$ItemInfo[0]]["DK"] = $ItemInfo[20];
						$this->item_info[$itemType][$ItemInfo[0]]["EL"] = $ItemInfo[21];
						$this->item_info[$itemType][$ItemInfo[0]]["MG"] = $ItemInfo[22];
						$this->item_info[$itemType][$ItemInfo[0]]["DL"] = $ItemInfo[23];
						$this->item_info[$itemType][$ItemInfo[0]]["SU"] = $ItemInfo[24];
						$this->item_info[$itemType][$ItemInfo[0]]["RF"] = $ItemInfo[25];
					}
					if($itemType == 15)
					{
						$this->item_info[$itemType][$ItemInfo[0]]["ReqLevel"] = $ItemInfo[10];
						$this->item_info[$itemType][$ItemInfo[0]]["Enery"] = $ItemInfo[11];
						$this->item_info[$itemType][$ItemInfo[0]]["Zen"] = $ItemInfo[12];
						$this->item_info[$itemType][$ItemInfo[0]]["DW"] = $ItemInfo[13];
						$this->item_info[$itemType][$ItemInfo[0]]["DK"] = $ItemInfo[14];
						$this->item_info[$itemType][$ItemInfo[0]]["EL"] = $ItemInfo[15];
						$this->item_info[$itemType][$ItemInfo[0]]["MG"] = $ItemInfo[16];
						$this->item_info[$itemType][$ItemInfo[0]]["DL"] = $ItemInfo[17];
						$this->item_info[$itemType][$ItemInfo[0]]["SU"] = $ItemInfo[18];
						$this->item_info[$itemType][$ItemInfo[0]]["RF"] = $ItemInfo[19];
					}						   
				}
			}
		}
		@fclose($handle);
		
		return $this->item_info;
		}

		public function LoadSkillInfo()
		{
		$this->skill_info = array();
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "".SITE_DIR."/ServerFiles/Skill.txt","r");
		while (!feof($handle))
		{
			$ItemInfo = fscanf($handle, '%d "%[^"]" %d %d %d %d %d %d %d');
			if(strpos($ItemInfo[0],"//") === false && isset($ItemInfo[0]))
			{
				
					$this->skill_info[$ItemInfo[0]] = 
					array(
				//	"Index" => $ItemInfo[0],
					"Name" => $ItemInfo[1],
					//"Damage" => $ItemInfo[2],
					"MP" => $ItemInfo[3]//,
					//"BP" => $ItemInfo[4],
					//"Range" => $ItemInfo[5],
					//"Radio" => $ItemInfo[6],
					//"Delay" => $ItemInfo[7]
					);
			}
		}
		@fclose($handle);
		
		return $this->skill_info;
		}
	
		// extrai as informações basicas do item
		public function ExploItem($item)
		{
		$item = (substr($item, 0, 2) == '0x') ? $item = substr($item, 2) : $item = $item;
		$item_lenght =strlen($item);
		$this->item = array('id'			=> hexdec(substr($item,	0, 2)), 			// Item Id
							  'option'		=> hexdec(substr($item,	2, 2)),				// Item Option Date
							  'dur'			=> hexdec(substr($item, 4, 2)),				// Item Durability
							  'serial'		=> ($item_lenght == 32) ? substr($item, 6, 8) : substr($item,	9,	5),						// Item Serial Number
							  'exe'			=> hexdec(substr($item,	14,	2)),			// Item Excellent Info
							  'ancient'		=> hexdec(substr($item, 16, 2)),			// Item Ancient Info
							  'cat'			=> hexdec(substr($item,	18,	2)),			// Item Cat
							  'refinery'	=> hexdec(substr($item, 19,	1)),			// Item Refinery Info
							  'itemtype'	=> floor(hexdec(substr($item, 18, 2))/16)); // Item Type		
			 {			
		
		$this->item2 	= array( 'harmonyoption' 	=>  hexdec(substr($item, 20, 1)), 	// Harmony Option Info
									'harmonyvalue'		=>  hexdec(substr($item, 21, 1)),	// Harmony Option Value
									'Socket1'			=>	substr($item, 22, 2), 			// Socket #1
									'Socket2'			=>	substr($item, 24, 2), 			// Socket #2
									'Socket3'			=>	substr($item, 26, 2), 			// Socket #3
									'Socket4'			=>	substr($item, 28, 2), 			// Socket #4
									'Socket5'			=>	substr($item, 30, 2));			// Socket #5		
					$this->item = array_merge ($this->item,$this->item2);
						}
			
			
			
	
				return $this->item;

		}



		//----------------------------------------------------------------------------------------//
		//family = categoria
		//index = id do item
	   /**
		* @desc get harmony options name.
		*/
		public static function getHarmony($family, $type, $level)
		{
			if($family >= 0 && $family <= 4) $family = 1;
			elseif($family == 5) $family = 2;
			elseif($family >= 6 || $family <= 11) $family = 3;
			else $family = 0;
			
			switch($family)
			{    // 0 : Não tem , 1 : Weapons, 2 : Staffs, 3 : Sets/Shields
				case 0:
					$options = array(
							0 => array("name" => "No option 0", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							1 => array("name" => "No option 1", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							2 => array("name" => "No option 2", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							3 => array("name" => "No option 3", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							4 => array("name" => "No option 4", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							5 => array("name" => "No option 5", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							6 => array("name" => "No option 6", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							7 => array("name" => "No option 7", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							8 => array("name" => "No option 8", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							9 => array("name" => "No option 9", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							10 => array("name" => "No option 10", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							11 => array("name" => "No option 11", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							12 => array("name" => "No option 12", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							13 => array("name" => "No option 13", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							14 => array("name" => "No option 14", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							15 => array("name" => "No option 15", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
					); 
					break;
				case 1:
					$options = array(
							0 => array("name" => "No option 0", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							1 => array("name" => "Min Attack Power +", 
									   0 => 2,
									   1 => 3,
									   2 => 4,
									   3 => 5,
									   4 => 6,
									   5 => 7,
									   6 => 9,
									   7 => 11,
									   8 => 12,
									   9 => 14,
									   10 => 15,
									   11 => 16,
									   12 => 17,
									   13 => 20,
									   14 => 100000,
									   15 => 110000,
							),
							2 => array("name" => "Max Attack Power +", 
									   0 => 3,
									   1 => 4,
									   2 => 5,
									   3 => 6,
									   4 => 7,
									   5 => 8,
									   6 => 10,
									   7 => 12,
									   8 => 14,
									   9 => 17,
									   10 => 20,
									   11 => 23,
									   12 => 26,
									   13 => 29,
									   14 => 100000,
									   15 => 110000,
							),
							3 => array("name" => "Need Strength -", 
									   0 => 6,
									   1 => 8,
									   2 => 10,
									   3 => 12,
									   4 => 14,
									   5 => 16,
									   6 => 20,
									   7 => 23,
									   8 => 26,
									   9 => 29,
									   10 => 32,
									   11 => 35,
									   12 => 37,
									   13 => 40,
									   14 => 100000,
									   15 => 110000,
							),
							4 => array("name" => "Need Agility -", 
									   0 => 6,
									   1 => 8,
									   2 => 10,
									   3 => 12,
									   4 => 14,
									   5 => 16,
									   6 => 20,
									   7 => 23,
									   8 => 26,
									   9 => 29,
									   10 => 32,
									   11 => 35,
									   12 => 37,
									   13 => 40,
									   14 => 100000,
									   15 => 110000,
							),
							5 => array("name" => "Attack (Max, Min) +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 7,
									   7 => 8,
									   8 => 9,
									   9 => 11,
									   10 => 12,
									   11 => 14,
									   12 => 16,
									   13 => 19,
									   14 => 0,
									   15 => 0,
							),
							6 => array("name" => "Critical Damage +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 12,
									   7 => 14,
									   8 => 16,
									   9 => 18,
									   10 => 20,
									   11 => 22,
									   12 => 24,
									   13 => 30,
									   14 => 0,
									   15 => 0, 
							),
							7 => array("name" => "Skill Power +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 12,
									   10 => 14,
									   11 => 16,
									   12 => 18,
									   13 => 22,
									   14 => 0,
									   15 => 0,
							),
							8 => array("name" => "Attack % Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 5,
									   10 => 7,
									   11 => 9,
									   12 => 11,
									   13 => 14,
									   14 => 0,
									   15 => 0,
							),
							9 => array("name" => "SD - Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 3,
									   10 => 5,
									   11 => 7,
									   12 => 9,
									   13 => 10,
									   14 => 0,
									   15 => 0,
							),
							10 => array("name" => "SD Ignore Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 10,
									   14 => 0,
									   15 => 0,
							),
							11 => array("name" => "No option 11", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							12 => array("name" => "No option 12", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							13 => array("name" => "No option 13", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							14 => array("name" => "No option 14", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							15 => array("name" => "No option 15", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
					); 
					break;
				case 2:
					$options = array(
							0 => array("name" => "No option 0", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							1 => array("name" => "Magic Power +", 
									   0 => 6,
									   1 => 8,
									   2 => 10,
									   3 => 12,
									   4 => 14,
									   5 => 16,
									   6 => 17,
									   7 => 18,
									   8 => 19,
									   9 => 21,
									   10 => 23,
									   11 => 25,
									   12 => 27,
									   13 => 31,
									   14 => 100000,
									   15 => 110000,
							),
							2 => array("name" => "Need Strength -", 
									   0 => 6,
									   1 => 8,
									   2 => 10,
									   3 => 12,
									   4 => 14,
									   5 => 16,
									   6 => 20,
									   7 => 23,
									   8 => 26,
									   9 => 29,
									   10 => 32,
									   11 => 35,
									   12 => 37,
									   13 => 40,
									   14 => 100000,
									   15 => 110000,
							),
							3 => array("name" => "Need Agility -", 
									   0 => 6,
									   1 => 8,
									   2 => 10,
									   3 => 12,
									   4 => 14,
									   5 => 16,
									   6 => 20,
									   7 => 23,
									   8 => 26,
									   9 => 29,
									   10 => 32,
									   11 => 35,
									   12 => 37,
									   13 => 40,
									   14 => 100000,
									   15 => 110000,
							),
							4 => array("name" => "Skill Power +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 7,
									   7 => 10,
									   8 => 13,
									   9 => 16,
									   10 => 19,
									   11 => 22,
									   12 => 25,
									   13 => 30,
									   14 => 0,
									   15 => 0,
							),
							5 => array("name" => "Critical Damage +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 10,
									   7 => 12,
									   8 => 14,
									   9 => 16,
									   10 => 18,
									   11 => 20,
									   12 => 22,
									   13 => 28,
									   14 => 0,
									   15 => 0,
							),
							6 => array("name" => "SD - Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 4,
									   10 => 6,
									   11 => 8,
									   12 => 10,
									   13 => 13,
									   14 => 0,
									   15 => 0,
							),
							7 => array("name" => "Attack % Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							8 => array("name" => "SD Ignore Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							9 => array("name" => "No option 9", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							10 => array("name" => "No option 10", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							11 => array("name" => "No option 11", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							12 => array("name" => "No option 12", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							13 => array("name" => "No option 13", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							14 => array("name" => "No option 14", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							15 => array("name" => "No option 15", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
					); 
					break;
				case 3:
					$options = array(
							0 => array("name" => "No option 0", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							1 => array("name" => "Def Power +", 
									   0 => 3,
									   1 => 4,
									   2 => 5,
									   3 => 6,
									   4 => 7,
									   5 => 8,
									   6 => 10,
									   7 => 12,
									   8 => 14,
									   9 => 16,
									   10 => 18,
									   11 => 20,
									   12 => 22,
									   13 => 25,
									   14 => 100000,
									   15 => 110000,
							),
							2 => array("name" => "Max AG +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 4,
									   4 => 6,
									   5 => 8,
									   6 => 10,
									   7 => 12,
									   8 => 14,
									   9 => 16,
									   10 => 18,
									   11 => 20,
									   12 => 22,
									   13 => 25,
									   14 => 0,
									   15 => 0,
							),
							3 => array("name" => "Max HP +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 7,
									   4 => 9,
									   5 => 11,
									   6 => 13,
									   7 => 15,
									   8 => 17,
									   9 => 19,
									   10 => 21,
									   11 => 23,
									   12 => 25,
									   13 => 30,
									   14 => 0,
									   15 => 0,
							),
							4 => array("name" => "HP Auto Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 1,
									   7 => 2,
									   8 => 3,
									   9 => 4,
									   10 => 5,
									   11 => 6,
									   12 => 7,
									   13 => 8,
									   14 => 0,
									   15 => 0,
							),
							5 => array("name" => "MP Auto Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 1,
									   10 => 2,
									   11 => 3,
									   12 => 7,
									   13 => 8,
									   14 => 0,
									   15 => 0,
							),
							6 => array("name" => "Def Success Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 3,
									   10 => 4,
									   11 => 5,
									   12 => 6,
									   13 => 8,
									   14 => 0,
									   15 => 0,
							),
							7 => array("name" => "Dmg - Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 3,
									   10 => 4,
									   11 => 5,
									   12 => 6,
									   13 => 7,
									   14 => 0,
									   15 => 0,
							),
							8 => array("name" => "SD Rate +", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 5,
									   14 => 0,
									   15 => 0,
							),
							9 => array("name" => "No option 9", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							10 => array("name" => "No option 10", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							11 => array("name" => "No option 11", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							12 => array("name" => "No option 12", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							13 => array("name" => "No option 13", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							14 => array("name" => "No option 14", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
							15 => array("name" => "No option 15", 
									   0 => 0,
									   1 => 0,
									   2 => 0,
									   3 => 0,
									   4 => 0,
									   5 => 0,
									   6 => 0,
									   7 => 0,
									   8 => 0,
									   9 => 0,
									   10 => 0,
									   11 => 0,
									   12 => 0,
									   13 => 0,
									   14 => 0,
									   15 => 0,
							),
					); 
					break;
			}
			return $options[$type]["name"].$options[$type][$level];
		}
				
		/**
		* @desc get refine options name.
		*/
		public static function getRefine($family, $index)
		{
			if($family >= 0 && $family <= 6) $type = 6;
			elseif($family == 7) $type = 1;
			elseif($family == 8) $type = 2;
			elseif($family == 9) $type = 3;
			elseif($family == 10) $type = 4;
			elseif($family == 11) $type = 5;
			else 
				$type = 0;    
			
			switch($type)
			{
				case 0: 
					return (object) array(
							"name" => "No option",
							"opt0" => "No Refinery 1º Options",
							"opt1" => "No Refinery 2º Options",
					); 
					break;
				case 1: 
					return (object) array(
							"name" => "Helms",
							"opt0" => "SD Recovery Rate +20",
							"opt1" => "Defense Success Rate +10",
					); 
					break;
				case 2: 
					return (object) array(
							"name" => "Armors",
							"opt0" => "SD Auto Recovery",
							"opt1" => "Def Success Rate +10",
					); 
					break;
				case 3: 
					return (object) array(
							"name" => "Pants",
							"opt0" => "Def Skill +200",
							"opt1" => "Def Success Rate +10",
					); 
					break;
				case 4: 
					return (object) array(
							"name" => "Gloves",
							"opt0" => "Max HP +200",
							"opt1" => "Def Success Rate +10",
					); 
					break;
				case 5: 
					return (object) array(
							"name" => "Boots",
							"opt0" => "Max SD +700",
							"opt1" => "Def Success Rate +10",
					); 
					break;
				case 6: 
					return (object) array(
							"name" => "Weapons",
							"opt0" => "Additional Dmg +200",
							"opt1" => "Pow Success Rate +10",
					); 
					break;
			}
		}
		
		/**
		* @desc get excellents options name.
		*/		
		public static function getExcellents($family, $index)
		{
				if($family == 0 || $family == 1 || $family == 2 || $family == 3 || $family == 4 || $family == 5) 
					$type = 1;     
				elseif($family == 6 || $family == 7 || $family == 8 || $family == 9 || $family == 10 || $family == 11) 
					$type = 2;    
				elseif($family == 12)
				{
					if($index >= 3 && $index <= 6) $type = 3; //Asas level 2
					if($index >= 36 && $index <= 43) $type = 7; //Asas level 3
					if($index >= 200 && $index <= 215) $type = 7; //Asas level 4
					if($index >= 130 && $index <= 134) $type = 3; //Small Asas
				}     
				elseif($family == 13)
				{
					if($index >= 8 && $index <= 9) $type = 5; //Rings
					if($index >= 12 && $index <= 13) $type = 6; //Pendants
					if($index >= 20 && $index <= 24) $type = 5; //Rings
					if($index >= 25 && $index <= 28) $type = 6; //Pendants
					if($index >= 33) $type = 3; //Capa Dark Lord
					if($index >= 37) $type = 4; //Fenrir
				}
				else 
					$type = 0;    
				
				switch($type)
				{
					case 0: 
						return (object) array(
								"name" => "No effect",
								"opt0" => "No effect",
								"opt1" => "No effect",
								"opt2" => "No effect",
								"opt3" => "No effect",
								"opt4" => "No effect",
								"opt5" => "No effect",
						);
						break;
					case 1: 
						return (object) array(
								"name" => "EXE WEAPONS",
								"opt0" => "Increases recovery rate of mana (Mana / 8)",
								"opt1" => "Increases recovery rate of life (Life / 8)",
								"opt2" => "Increase the speed of magical damage +7",
								"opt3" => "Increase magical damage +1%",
								"opt4" => "Increase magic damage + level/20",
								"opt5" => "Success in excellent damage +10%",
						);
					case 2: 
						return (object) array(
								"name" => "EXE SETS",
								"opt0" => "Increased rate of acquisition of Zen +40%",
								"opt1" => "Success of Defense +10%",
								"opt2" => "Mirrors in 5% Damage Received",
								"opt3" => "Lowers the damage by +4%",
								"opt4" => "Increase mana +4%",
								"opt5" => "Increases in life +4%",
						);
						break;
					case 3: 
						return (object) array(
								"name" => "EXE WINGS",
								"opt0" => "Life increased by +125",
								"opt1" => "Mana increased by +125",
								"opt2" => "Defense of the opponent ignored by 3%",
								"opt3" => "Stamina increased by +50",
								"opt4" => "Increase the speed of magic damage to +5",
								"opt5" => "No effect",
						);
					case 4: 
						return (object) array(
								"name" => "EXE FENRIR",
								"opt0" => "+Damage",
								"opt1" => "+Defense",
								"opt2" => "+Illusion",
								"opt3" => "No effect",
								"opt4" => "No effect",
								"opt5" => "No effect",
						);
						break;
					case 5: 
						return (object) array(
								"name" => "RINGS",
								"opt0" => "Increases zens who fall into +40%",
								"opt1" => "+10% Defensive success rank",
								"opt2" => "Returns the blow +5%",
								"opt3" => "Received low blow +4%",
								"opt4" => "Increase mana +4%",
								"opt5" => "Increases in life +4%",
						);
					case 6: 
						return (object) array(
								"name" => "PENDANTS",
								"opt0" => "Increase mana after killing monster + mana / 8",
								"opt1" => "Increases life after killing monster + life / 8",
								"opt2" => "Increases attack speed +7",
								"opt3" => "Adds +2% damage",
								"opt4" => "+ Increases damage level/20",
								"opt5" => "+10% Defensive success rank",
						);
					case 7: 
						return (object) array(
								"name" => "EXE WINGS S4",
								"opt0" => "Ignore the Power of Defensive Opponent 5%",
								"opt1" => "5% Chance to return the damage",
								"opt2" => "5% Chance of a lifetime to recover",
								"opt3" => "5% Chance to recover all mana",
								"opt4" => "No effect",
								"opt5" => "No effect",
						);
						break; 
				}
			}
	
		public static function getOption($family, $index)
		{
				if($family == 0 || $family == 1 || $family == 2 || $family == 3 || $family == 4 || $family == 5) 
					$type = 1;     
				elseif($family == 6 || $family == 7 || $family == 8 || $family == 9 || $family == 10 || $family == 11) 
					$type = 2;    
				elseif($family == 12)
				{
					if($index >= 3 && $index <= 6) $type = 3; //Asas level 2
					if($index >= 36 && $index <= 43) $type = 7; //Asas level 3
					if($index >= 200 && $index <= 215) $type = 7; //Asas level 4
					if($index >= 130 && $index <= 134) $type = 3; //Small Asas
				}     
				elseif($family == 13)
				{
					if($index >= 8 && $index <= 9) $type = 5; //Rings
					if($index >= 12 && $index <= 13) $type = 6; //Pendants
					if($index >= 20 && $index <= 24) $type = 5; //Rings
					if($index >= 25 && $index <= 28) $type = 6; //Pendants
					if($index >= 33) $type = 3; //Capa Dark Lord
					if($index >= 37) $type = 4; //Fenrir
				}
				else 
					$type = 0; 
					
				switch($type)
				{
					case 0: 
						return (object) array(
								"name" => "No effect",
								"opt0" => "No effect",
						);
						break;
					case 1: 
						return (object) array(
								"name" => "EXE WEAPONS",
								"opt0" => "Dano adicional +28",
						);
					case 2: 
						return (object) array(
								"name" => "EXE SETS",
								"opt0" => "Defesa adcional +28",
							);
						break;
					case 3: 
						return (object) array(
								"name" => "EXE WINGS",
								"opt0" => "Recuperação automatica HP 7%	",
						);
					case 4: 
						return (object) array(
								"name" => "EXE FENRIR",
								"opt0" => "+Damage",
						);
						break;
					case 5: 
						return (object) array(
								"name" => "RINGS",
								"opt0" => "Dano Magico adicional",
						);
					case 6: 
						return (object) array(
								"name" => "PENDANTS",
								"opt0" => "Recuperação automatica HP 7%	",
							);
					case 7: 
						return (object) array(
								"name" => "EXE WINGS S4",
								"opt0" => "Recuperação automatica HP 7%	",
						);
						break; 
				}
				
		//Recuperação automatica HP 7%		
				
				
		}

		public static function getSocket()
		{
						return (object) array(
								"FE" => "Nenhum desgaste de itens",
								//armas
								"1F" => "Relâmpago (Aumenta o dano critico +30)",
								"51" => "Relâmpago (Aumenta o dano critico +1)",
								"83" => "Relâmpago (Aumenta o dano critico +1)",
								"B5" => "Relâmpago (Aumenta o dano critico +1)",
								"E7" => "Relâmpago (Aumenta o dano critico +1)",
								//set
								"0D" => "Agua (Diminui o dano do inimigo em 4%) ",
								"3F" => "Agua (Diminui o dano do inimigo em 1%)",
								"71" => "Agua (Diminui o dano do inimigo em 1%) ",
								"A3" => "Agua (Diminui o dano do inimigo em 1%)",
								"D5" => "Agua (Diminui o dano do inimigo em 1%)",


								);
								
										}
    		
		public function getClassEquip($family, $index)
		{ global $CLASS_CHARACTERS;
		//$CLASS_CHARACTERS['CLASSCODES'][num]
		         /* [DW] =&gt; 0
                    [DK] =&gt; 1
                    [EL] =&gt; 0
                    [MG] =&gt; 1
                    [DL] =&gt; 1
                    [SU] =&gt; 0
                    [RF] =&gt; 
					*/
		$Item = $this->LoadItemInfo();
		//$class[] = (object) '';
	switch($Item[$family][$index]['DW']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['1']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['2']];	
		break;
		case 3:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['3']];	
		break;
				}
				
	switch($Item[$family][$index]['DK']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['16']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['17']];	
		break;
		case 3:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['18']];	
		break;
				}
				
	switch($Item[$family][$index]['EL']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['32']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['33']];	
		break;
		case 3:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['34']];	
		break;
				}
				
	switch($Item[$family][$index]['MG']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['48']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['50']];	
		break;

				}
				
	switch($Item[$family][$index]['DL']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['64']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['66']];	
		break;
				}
				
	switch($Item[$family][$index]['SU']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['80']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['81']];	
		break;
		case 3:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['82']];	
		break;
				}
				
	switch($Item[$family][$index]['RF']){
		case 1:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['96']];	
		break;
		case 2:
		$class[] = ["character" => $CLASS_CHARACTERS['CLASSCODES']['98']];	
		break;
				}
/**/ 
				return $class;
		}
		
		public function GenerateItemSerial()
		{
			$sql="EXEC [".DATABASE."].[dbo].[WZ_GetItemSerial]";
			$serial = $this->execPDO($sql);
			
			$SERIAL = strtoupper(dechex($serial));
			 
			while(strlen($SERIAL) < 8){
				$SERIAL = "0".$SERIAL;
			} 
			return $SERIAL;
		}

		
		}
}

