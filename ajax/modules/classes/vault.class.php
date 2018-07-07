<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Vault" ) == false ) {
	//new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
    class Vault extends DataBase {
		private $tpmResult = NULL;
		public function __construct()
		{
			$this->check_item();
		}
		
		// bau virtua para o game

		//carrega os itens do bau para um array
		private function GetVaultItensList()
		{	$sql = "SELECT Items FROM warehouse WHERE AccountID='".$_SESSION[SESSION_NAME]."'";
			$result1 = $this->selectDB($sql);
			$this->VaultSize =strlen($result1[0]->Items);
			//print($result1[0]->Items."\n\n");
			$size = 3840; //tamanho do bau
			/**/
			$query = "SELECT CONVERT(TEXT, CONVERT(VARCHAR(".$size."), Items, 2)) [Items] 
			FROM [".DATABASE."].[dbo].[warehouse]
			 WHERE [AccountID] = '".$_SESSION[SESSION_NAME]."'";
			$result = $this->selectDB($query);
			$item = strtoupper($result[0]->Items);

			$codeGroup = str_split($item, 32);
			//percorre os slots do bau marcando os slots ocupados
			foreach($codeGroup as $slot => $code)
            {
		
				if($code != "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"){
						$table[$slot] =["slot" => "1","item" => $code];
				}else{
						$table[$slot] =["slot" => "0","item" => $code];
				}
			}

			//retorna um array com todos os slots do bau
			$this->table = $table;
		}
		
		
		private function check_item()
		{
			$Item		=	new Item(); //classe item
			$ItemInfo	=	$Item->LoadItemInfo();
			
			foreach ($_POST as $key => $value){$$key = $value;} 
			
		$sql ='SELECT [Number], [Item], [dbVersion] FROM [dbo].[WebWareHouseVirtual] where [Number] = '.$item_id.' AND [AccountId] =\''.$_SESSION[SESSION_NAME].'\'';
		$result = $this->selectDB($sql);
		
			$i = $Item->ExploItem($result[0]->Item);
			$id		= $i['id'];		//id do item
			$cat	= $i['itemtype'];		//categoria do item
			//tamanho do item
			$sX = $ItemInfo[$cat][$id]['X'];
			$sY = $ItemInfo[$cat][$id]['Y'];
			//$msg = $this->load_space_table();
			
			//procuro espaço vazio no bau passando largura e altura
			//retorna o id do slot vazio
			$slot = $this->searchSlotsInVault($sX, $sY);
			if($slot >= 0){
			
			foreach($this->codeGroup as $key => $subarray) {
				if($key == $slot){
      				$msg .=$result[0]->Item;
				}else{
					$msg .=$this->codeGroup[$key]['item'];
				}
			}
			$sql ='UPDATE [dbo].[warehouse] SET [Items] = 0x'.$msg.' WHERE [AccountId] = \''.$_SESSION[SESSION_NAME].'\'';
			$result = $this->updateDB($sql);
			if($result >= 1){
				$del ='DELETE FROM [dbo].[WebWareHouseVirtual] WHERE  [Number] = '.$item_id.' AND [AccountId] =\''.$_SESSION[SESSION_NAME].'\'';
				$this->deleteDB($del);
				$msg ='Item eonviado para o bau do jogo';
			}
			}else{
				$msg ='Você não tem espaço suficiente';
			}
			
			
			
			
			
			$type = 0;
			$this->returnMsg($type,$rtn,$msg);	
		}
		
		//procura e preenxe os spaçõs da tabela
		private function load_space_table()
		{	$Item = new Item(); //instacia a classe Item
			$this->GetVaultItensList();//chama a classe bau
			$ItemInfo	=	$Item->LoadItemInfo(); //Carrega informações do item
			//print_r($ItemInfo);
			$this->codeGroup = $this->table;
			//teste
			$slot = 0;		
	
			for($y = 0; $y < 15; $y++){//percorre o bau na vertical partindo de 0
			
				for($x = 0; $x < 8; $x++)//Corre o bau na horizontal
				{
					//if($this->codeGroup[$slot]['slot'] != 2){}
						
					if($this->codeGroup[$slot]['item'] !="FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")
					{	
					
					
					$i = $Item->ExploItem($this->codeGroup[$slot]['item']);//pucha as informaçõs do item

					$cat = $i['itemtype'];
					$id = $i['id'];

					
						$ty = $ItemInfo[$cat][$id]['Y'];
						$tx = $ItemInfo[$cat][$id]['X'];
						
//print('item '.$cat.' - id '.$id.' - name '.$ItemInfo[$cat][$id]['Name'].'
//'); 
					
						$xslot = $slot;
						for($xx = 0; $xx < $tx; $xx++){
							$this->codeGroup[$xslot]['slot'] = 1;
							$this->codeGroup[$xslot]['x'] = $tx;
							$this->codeGroup[$xslot]['y'] = $ty;
							$this->codeGroup[$xslot]['cat'] = $cat;
							$this->codeGroup[$xslot]['id'] = $id;
							
							
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
								//slot vazio
						}
					
					$slot++;
				}

			}
			
		//print_r($table);
		//Vai verificar se tem algum lugar com spaço vazio para o novo item
		//$this->find_find_space($this->codeGroup);	

		return $this->codeGroup;
		//print_r($r);
		}//end table

	
		public function searchSlotsInVault($sX, $sY)
   		{//procura espaço vazio no bau baseado na altura e largura do item a ser adicionado
			$this->load_space_table();//carrega o array do bau

		    $slot = 0; // inicia a variavel $slot como zero
			$free -1; //definido free como -1 pois ainda não temos um slot
            for($y = 0; $y < 15; $y++)
            {//percorre os slots do bau de cima para baixo
                for($x = 0; $x < 8; $x++)
                {
                    if($this->codeGroup[$slot]['slot'] == 0)
                    {//percorre os slots do bau 1 a 1 da esquerda para a direita
						$Yslot = $slot;
                        if($y+$sY <= 15 && $x+$sX <= 8) 
                        {							
                        $free = $slot; // salva o numero do slot vazio
							
                            for($cY = 0; $cY < $sY; $cY++)
                            {
								//verifica se o slot atual esta vazio
                                if($this->codeGroup[$Yslot]['slot'] != 0){
								//em caso do slot esta ocupado pausa o loop
								$free = -1;  break; }else{
								//continua o loop se nao for encontrado itens
								$Xslot = $Yslot;
							    for($cX = 0; $cX < $sX; $cX++)
                                {
                                   if($this->codeGroup[$Xslot]['slot'] != 0){
									   //checa se o slot esta vazio
									   $free = -1;  break; }
								$Xslot++;
                                }
								
								}//end else
								$Yslot =8+$Yslot;
								
                            }							
                        }
				   	if($free != -1){
					//para o array se um espaço ocupado for encontrado
					break;}
                   }
					//fix for bug send item to slot zero
                    $slot++;
                }       
            }

            return $free;	
		}
		
		private function returnMsg($type,$rtn,$msg)
		{
		$arr = Array(
		 'type' =>		$type,
		 'rtn' =>		$rtn,
		 'msg' =>		$msg
		);
		
		echo json_encode($arr);	
		}		
	}	
}
