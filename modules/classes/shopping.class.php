<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Shopping" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Shopping   extends DataBase {
		public function __construct()
		{ global $Tpl;
		
			
			if(!empty($_SESSION[SESSION_NAME])){
			//$item	
			if(!empty($_GET['item'])){	//exibe os detalhes do item
			$this->item_details($_GET['item']);
			//informaçoes do painel do usuario
			$UserCP = new Usercp();
			}else{//lista todos os itens
			$this->show_itens();
			$Tpl->set('RESULT',$this->li);
			}
			}else{
			$Tpl->set('RESULT','<div class="aler alert-info box" role="alert"><strong>Atenção:</strong> Você precisa estar logado para acessar nosso webshopping.</div>');
			}
			if(!empty($_GET['category'])){
			$Tpl->set('CT',@$_GET['category']);
			}else{
			$Tpl->set('CT','0');
			}
		}
		//

		private function item_details($id) //exibe os detalhes do item
		{ global $Tpl,$TABLES_CONFIGS;
		$Item		=	new Item(); //Instacia a classe item
		$ItemInfo	=	$Item->LoadItemInfo(); //Carrega informações do item
		
		$sql ='SELECT [idx]
      ,[category_idx]
      ,[type]
      ,[id]
      ,[max_exc_opts]
      ,[currency]
      ,[base_price]
      ,[status]
      ,[min_level]
      ,[max_level]
      ,[addopt]
      ,[skill]
      ,[luck]
      ,[ancient]
      ,[harmony]
      ,[opt380]
      ,[socket_empty]
      ,[max_socket]
      ,[socket_level]
      ,[max_amount]
      ,[sold]
      ,[limit]
      ,[insurance]
      ,[cancellable]
      ,[vip_item]
  FROM [dbo].[Z_WebShopItems] WHERE [idx] = '.$id.'';
  
  		$result = $this->selectDB($sql);
		
		foreach($result as &$row){
		$name = $ItemInfo[$row->type][$row->id]['Name'];
		$Tpl->set('ITEM[ID]',$row->idx);
		$Tpl->set('ITEM[NAME]',$name);
		$Tpl->set('ITEM[PRINCE]',$row->base_price);
		$Tpl->set('ITEM[CASH]',$TABLES_CONFIGS['WEBCASH']['NAME'][$row->currency]);
		$Tpl->set('ITEM[PHOTO]','templates/'.TEMPLATE_DIR.'/img/itens/'.$row->type.'-'.$row->id.'.gif');
		//EXIBE OS DETALHES DO ITEM
		
		//FEFEFEFEFE
		//0000000000
		
		if($row->max_socket == 0){
			$socket ='0000000000';
			}
		else{
			$v ='SELECT [AccountLevel] FROM [dbo].[MEMB_INFO] WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
			$vip = $this->selectDB($v);
			if($vip[0]->AccountLevel >= 2){
				switch($row->type)
				{
				case 0:
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				$socket ='1F5183B5E7';
				break;
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				$socket ='0D3F71A3D5';
				break;
				}
				}else{
				$socket ='FEFEFEFEFE';
			}
			
			
		}
		
		
		switch($row->type)
		{
		case 0:
		$item = strtoupper(dechex($row->id).'EF89000000007F000000'.$socket.'');
		break;
		case 1:
		$item = strtoupper(dechex($row->id).'EF4B000000007F001000'.$socket.'');
		break;
		case 2:
		$item = strtoupper(dechex($row->id).'EF48000000007F002000'.$socket.'');
		break;
		case 3:
		$item = strtoupper(dechex($row->id).'EF67000000007F003000'.$socket.'');
		break;
		case 4:
		$item = strtoupper(dechex($row->id).'EF43000000007F004000'.$socket.'');
		break;
		case 5:
		$item = strtoupper(dechex($row->id).'6F43000000007F005000'.$socket.'');
		break;
		case 6:
		$item = strtoupper(dechex($row->id).'6F45000000007F006000'.$socket.'');
		break;
		case 7:
		$item = strtoupper(dechex($row->id).'6F51000000007F007000'.$socket.'');
		break;
		case 8:
		$item = strtoupper(dechex($row->id).'6F51000000007F008000'.$socket.'');
		break;
		case 9:
		$item = strtoupper(dechex($row->id).'6F51000000007F009000'.$socket.'');
		break;
		case 10:
		$item = strtoupper(dechex($row->id).'6F51000000007F00A000'.$socket.'');
		break;
		case 11:
		$item = strtoupper(dechex($row->id).'6F51000000007F00B000'.$socket.'');
		break;
		case 12://esta comando uma asa
		$item = strtoupper(dechex($row->id).'6FFF000000007F00C0000000000000');
		break;
		case 13://esta comando uma asa
		$item = strtoupper(dechex($row->id).'6B61000000007F00D8000000000000');
		break;
		default: exit; break;
		}
		
		if(strlen($item) < 32){
		$item ='0'.$item;	
		}
		$Tpl->set('ITEM[DETAILS]',$this->Item_option($item));
		}


		
		}
		
		private function Item_option($i)
		{
		$Item		=	new Item(); //Instacia a classe item
		$skill_details	=	$Item->LoadSkillInfo();/*
		 [550] => Array
        (
            [Name] => Add	Drain	Life	Improved	1
            [MP] => 57
        )
		*/ 
		$item_details	=	$Item->LoadItemInfo();/*
		        [29] => Array
                (
                    [Slot] => 0
                    [Skill] => 0
                    [X] => 1
                    [Y] => 2
                    [Serial] => 1
                    [Option] => 0
                    [Drop] => 1
                    [Name] => Scroll	of	Gigantic	Storm
                )
		*/
		
		$get_item	=	$Item->ExploItem($i);
			/*
			if($_SESSION[SESSION_NAME] == 'FabioMR'){
			print_r($get_item);
			}	 
			                    [DW] =&gt; 0
                    [DK] =&gt; 1
                    [EL] =&gt; 0
                    [MG] =&gt; 1
                    [DL] =&gt; 1
                    [SU] =&gt; 0
                    [RF] =&gt; 

			*/	
		$description_item ='';
			
		$CharacterEquip  =	$Item->getClassEquip($get_item['itemtype'],$get_item['id']);
			
			//<span><span class="ItemClassrequirement">Pode ser equipado por Blade Knight</span><br>
			$i=0;
			foreach($CharacterEquip  as &$row){
			$description_item .= '<span><span class="ItemClassrequirement">Pode ser equipado por '.$row['character'].'</span><br>';
			$i++;
			}
			$description_item .= '<br><span class="ItemExcellentOptions">';
			
		/*
			Array
			(
				[id] => 52
				[option] => 108
				[dur] => 133
				[serial] => E2289400
				[exe] => 127
				[ancient] => 0
				[cat] => 128
				[refinery] => 0
				[itemtype] => 8
			)
		*/
		//opções Excellents do item
		$Excellents = $Item->getExcellents($get_item['itemtype'],$get_item['id']);
		
		
		
		
		
		

		/*
		stdClass Object
		(
			[name] => EXE WEAPONS
			[opt0] => Increases recovery rate of mana (Mana / 8)
			[opt1] => Increases recovery rate of life (Life / 8)
			[opt2] => Increase the speed of magical damage +7
			[opt3] => Increase magical damage +1%
			[opt4] => Increase magic damage + level/20
			[opt5] => Success in excellent damage +10%
		)
		*/
		//verifica se o item tem skill
		if($get_item['option'] >= 128){$get_item['option'] -=128; 
		$skill_id	=	@$item_details[$get_item['itemtype']][$get_item['id']]['Skill']; //pega o id da skill no item.txt
		if(!empty($skill_id)){
		$skill_name	=	$skill_details[$skill_id]['Name'];//pega o nome da skill no arquivo skill.txt
		$skill_mana	=	$skill_details[$skill_id]['MP'];//pega valor mana da skill no arquivo skill.txt
		$description_item .= "Skill $skill_name (mana: $skill_mana) <br>";
		}
		}
	
		$level = 0;
		$s = $get_item['option']; //DEFINE O LEVEL DO ITEM
		for($s ; $s >= 8; $s-=8){$level = $level + 1;} $get_item['option'] -=$level*8;
	
		//luck option
		if($get_item['option'] >= 4){ $get_item['option'] -= 4;
		$description_item .= "Luke (taxa de sucesso com Joia da alma +25%)<br>
  						Luke (taxa de dano crítico +5%)<br>";  }		

		//option
		$s = $get_item['option'];
		$option = 0;
		for($s ; $s >= 1; $s-=1){$option = $option + 4; $get_item['option'] -=1; }
		if($get_item['exe'] >= 64){$option = $option + 16;	 $get_item['exe'] -=64; }
		if($option > 0){ //exibe a option do item
		$option = $Item->getOption($get_item['itemtype'],$get_item['id']);
		$description_item	.=$option->opt0; }


		//excellente options 
		if($get_item['exe'] >= 32){ $get_item['exe'] -= 32; $description_item .= "<br>".$Excellents->opt5;}
		if($get_item['exe'] >= 16){ $get_item['exe'] -= 16; $description_item .= "<br>".$Excellents->opt4;}
		if($get_item['exe'] >= 8){ $get_item['exe'] -= 8; $description_item .= "<br>".$Excellents->opt3;}
		if($get_item['exe'] >= 4){ $get_item['exe'] -= 4; $description_item .= "<br>".$Excellents->opt2;}
		if($get_item['exe'] >= 2){ $get_item['exe'] -= 2; $description_item .= "<br>".$Excellents->opt1;}
		if($get_item['exe'] >= 1){ $get_item['exe'] -= 1; $description_item .= "<br>".$Excellents->opt0;}

		//			
		$socket  = $get_item['Socket1'].''.$get_item['Socket2'].''.$get_item['Socket3'].''.$get_item['Socket4'].''.$get_item['Socket5'];


		if($socket != '0000000000'){

		$SocketOption = $Item->getSocket();
		
		//print_r($SocketOption);
		 $description_item .='<p class="ItemSocketTitle"><br>Soquete Informações de opção do item</p>';
if($get_item['Socket1'] != '00'){$description_item .= '<span class="ItemSocketDisabled">Soquete 1: '.$SocketOption->$get_item['Socket1'].'</span><br>';}

if($get_item['Socket2'] != '00'){$description_item .= '<span class="ItemSocketDisabled">Soquete 2: '.$SocketOption->$get_item['Socket2'].'</span><br>';}

if($get_item['Socket3'] != '00'){$description_item .= '<span class="ItemSocketDisabled">Soquete 3: '.$SocketOption->$get_item['Socket3'].'</span><br>';}

if($get_item['Socket4'] != '00'){$description_item .= '<span class="ItemSocketDisabled">Soquete 4: '.$SocketOption->$get_item['Socket4'].'</span><br>';}

if($get_item['Socket5'] != '00'){$description_item .= '<span class="ItemSocketDisabled">Soquete 5: '.$SocketOption->$get_item['Socket5'].'</span><br>';}
		}
		$description_item .= '</div>';
		return $description_item;
		}

		private function show_itens()
		{ global $Tpl,$TABLES_CONFIGS;
		$Item		=	new Item(); //Instacia a classe item
		$ItemInfo	=	$Item->LoadItemInfo(); //Carrega informações do item
		switch(@$_GET['category'])//seleciona uma categoria
		{
			case '1':
			$where = 'WHERE [type] in (0,1,2,3,4,5)';
			break;
			case '2':
			$where = 'WHERE [type] = 6';
			break;
			case '3':
			$where = 'WHERE [type] in (7,8,9,10,11)';
			break;
			case '4':
			$where = 'WHERE [type] = 12';
			break;
			case '5':
			$where = 'WHERE [type] in (13,14,15)';
			break;
			default:
			$where = '';
			break;
		}

		$sql ='SELECT TOP 500 [idx]
      ,[category_idx]
      ,[type]
      ,[id]
      ,[max_exc_opts]
      ,[currency]
      ,[base_price]
      ,[status]
      ,[min_level]
      ,[max_level]
      ,[addopt]
      ,[skill]
      ,[luck]
      ,[ancient]
      ,[harmony]
      ,[opt380]
      ,[socket_empty]
      ,[max_socket]
      ,[socket_level]
      ,[max_amount]
      ,[sold]
      ,[limit]
      ,[insurance]
      ,[cancellable]
      ,[vip_item]
  FROM [dbo].[Z_WebShopItems] '.$where.' ORDER BY [idx] DESC';
  
  			$result = $this->selectDB($sql);
			
			$this->li ='';
			$r = 0;
			foreach($result as &$row){
			$name = $ItemInfo[$row->type][$row->id]['Name'];
			if($r >= 3){
				$this->li .='<div class="row"></div>';
				$r = 1;
				}else {
					$r++;
					}
			$this->li .='<div class="col-sm-6 col-md-4">
					  <div class="thumbnail">
					  <img src="templates/'.TEMPLATE_DIR.'/img/itens/'.$row->type.'-'.$row->id.'.gif">
						<div class="caption text-center">
						  <strong>'.$name.'</strong>
						  <p> <font color="#b38e47">'.$row->base_price.'</font> '.$TABLES_CONFIGS['WEBCASH']['NAME'][$row->currency].'</p>
						  <!--form name="vip" method="post">
							<input type="hidden" name="action" value="shopping">
							<input type="hidden" name="rtn" value="_buy_\'.$row->index.\'">
							<input type="hidden" name="id" value="\'.$row->index.\'">
							<input type="hidden" name="token" value="'.time().'">
							<div id="_buy_\'.$row->index.\'"></div>
							<input type="submit" name="comprar" value="Comprar" class="btn btn-primary btn-block">
						  </form-->
						 <a href="/shopping/details/'.$row->idx.'/" name="comprar" value="Comprar" class="btn btn-primary btn-block">Ver detalhes</a>
						</div>
					  </div>
					</div>';	
				
			}

			
		return $this->li;	
			
		}
		
	}
}

