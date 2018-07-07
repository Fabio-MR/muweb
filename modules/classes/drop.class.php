<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Drop" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Drop   extends DataBase {
		public function __construct()
		{ Global $Tpl;
		if(!empty($_GET['item'])){
		$this->ShopDrop($_GET['item']);}
		else{
			$Tpl->set('DROP',"Escolha uma categoria.");
		}
			
		}
		
		
		function ShopDrop($bag)
		{Global $Tpl;
		$file =$_SERVER['DOCUMENT_ROOT'] . "".SITE_DIR."/ServerFiles/drops/".$bag.".txt";
		if (file_exists($file)) {
		$result = "O arquivo nao foi encontrado";	
		}else
		{
		$handle = fopen($file,"r");
		//print($_SERVER['DOCUMENT_ROOT'] . "".SITE_DIR."/ServerFiles/drops/".$bag.".txt");
		//exit;
		$result = '<table class="general-table-ui" cellspacing="0" width="100%">';
		$result .='
		<tr>
			<td>Nome</td>
			<td>Max. Level</td>
			<td>Skill</td>
			<td>Luck</td>
			<td>Option</td>
			<td>Max. Exelent</td>
		</tr>';
		while (!feof($handle))
		{
			$ItemInfo = fscanf($handle, ' %d %d %d %d %d %d %d %d');
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
				$result .= '
				<tr>
				<td>'.$this->ItemName($ItemInfo[0],$ItemInfo[1]).'</td>
				<td>'.$ItemInfo[3].'</td>
				<td>'.$ItemInfo[4].'</td>
				<td>'.$ItemInfo[5].'</td>
				<td>'.$ItemInfo[6].'</td>
				<td>'.$ItemInfo[7].'</td>
				</tr>';		   
				}

			}
		}
		$result .= '</table>';
		
		@fclose($handle);
		
		}
		$Tpl->set('DROP',$result);			
		}

		private function ItemName($cat,$id)
		{
		$this->item = array();
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
					$this->item[$itemType][$ItemInfo[0]] = 
					array(
					"Slot" => $ItemInfo[1],
					"Skill" => $ItemInfo[2],
					"X" => $ItemInfo[3],
					"Y" => $ItemInfo[4],
					"Serial" => $ItemInfo[5],
					"Option" => $ItemInfo[6],
					"Drop" => $ItemInfo[7],
					"Name" => $ItemInfo[8]);				}
				
			}
		}
		@fclose($handle);
		return
		$this->item[$cat][$id]['Name'];
		}
		}
}

