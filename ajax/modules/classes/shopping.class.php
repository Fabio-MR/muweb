<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Shopping" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Shopping   extends DataBase {
		public function __construct()
		{	
		$this->buy_item();
		}
		
		function buy_item()
		{ global $TABLES_CONFIGS;
		foreach ($_POST as $key => $value){$$key = $value;} 
		$Item		=	new Item(); //Instacia a classe item
		$ItemInfo	=	$Item->LoadItemInfo(); //Carrega informações do item

		$Bloc = new Bloc();
			if($Bloc->get_acoun_bloc() == 1){
			$type = 1;	
			$msg =' Você nao tem permição para efetuar essa compra, entre em contato com o administrador.';	
			} else {
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
  
  		$row = $this->selectDB($sql);
		//$i = $this->L_itens();
		//$v = $i[$id]->cash;
		
		
		$ammount = $TABLES_CONFIGS['WEBCASH'][$row[0]->currency]->columnAmount;
				
		$sql ='SELECT [WCoinC],[WCoinP],[GoblinPoint] FROM [dbo].[CashShopData] WHERE [AccountID] =\''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->selectDB($sql);
		
		if($result[0]->$ammount >= $row[0]->base_price){
		//chegamos ate aqui.
		//hora de ver o que temos do item para montar os add
		//para prosseguir sera nescessario o
		//id do item
		//categoria do item
		
		//opção sockt de acordo com a categoria
		//harmony
		//anciente
		//add roxo
		//CODIGO FUNCIONAL INICIAL

		if($row[0]->max_socket == 0){
			$socket ='0000000000';
			}
		else{
			
			$sql ='SELECT [AccountLevel] FROM [dbo].[MEMB_INFO] WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'';
			$vip = $this->selectDB($sql);
			if($vip[0]->AccountLevel >= 2){
				switch($row[0]->type)
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
		
		$serial = $Item->GenerateItemSerial();
		switch($row[0]->type)
		{
		case 0:		
		$item = strtoupper(dechex($row[0]->id).'EF89'.$serial.'7F000000'.$socket.'');
		break;
		case 1:
		$item = strtoupper(dechex($row[0]->id).'EF4B'.$serial.'7F001000'.$socket.'');
		break;
		case 2:
		$item = strtoupper(dechex($row[0]->id).'EF48'.$serial.'7F002000'.$socket.'');
		break;
		case 3:
		$item = strtoupper(dechex($row[0]->id).'EF67'.$serial.'7F003000'.$socket.'');
		break;
		case 4:
		$item = strtoupper(dechex($row[0]->id).'EF43'.$serial.'7F004000'.$socket.'');
		break;
		case 5:
		$item = strtoupper(dechex($row[0]->id).'6F43'.$serial.'7F005000'.$socket.'');
		break;
		case 6:
		$item = strtoupper(dechex($row[0]->id).'6F45'.$serial.'7F006000'.$socket.'');
		break;
		case 7:
		$item = strtoupper(dechex($row[0]->id).'6F51'.$serial.'7F007000'.$socket.'');
		break;
		case 8:
		$item = strtoupper(dechex($row[0]->id).'6F51'.$serial.'7F008000'.$socket.'');
		break;
		case 9:
		$item = strtoupper(dechex($row[0]->id).'6F51'.$serial.'7F009000'.$socket.'');
		break;
		case 10:
		$item = strtoupper(dechex($row[0]->id).'6F51'.$serial.'7F00A000'.$socket.'');
		break;
		case 11:
		$item = strtoupper(dechex($row[0]->id).'6F51'.$serial.'7F00B000'.$socket.'');
		break;
		case 12://esta comando uma asa
		$item = strtoupper(dechex($row[0]->id).'6FFF'.$serial.'7F00C0000000000000');
		break;
		case 13://este e pendante
		$item = strtoupper(dechex($row[0]->id).'6B61'.$serial.'7F00D0000000000000');
		break;
		//6FFF000000007F00D8000000000000
		//6B61F00CA9007F00D0000000000000
		default: exit; break;
		}
		
		//66EF89000000007F000000FEFEFEFEFE
		if(strlen($item) < 32){
		$item ='0'.$item;	
		}
		$prince = $row[0]->base_price;
		$sql = 'INSERT INTO [dbo].[WebWareHouseVirtual] ([AccountId] ,[Item] ,[dbVersion])
		VALUES (\''.$_SESSION[SESSION_NAME].'\' ,\''.$item.'\' ,\'3\')';
		$sql2 = 'UPDATE [dbo].[CashShopData]
   		SET ['.$ammount.'] = ['.$ammount.'] - '.$row[0]->base_price.'	WHERE  [AccountID] =\''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->insertDB($sql);
		$result = $this->insertDB($sql2);
		if(count($result) > 0)
		{
		//grava os logs	
		//$serial
		$status		= 0;
		$insurance	= 0;
		$pack		= 0;
		$currency	= 0;
		$discCode	= 0;
		$cancellable= 0;
		$serial		= 0000000;
		
		$this->log_buy($_SESSION[SESSION_NAME],$serial,$item,$prince,$status,$insurance,$row[0]->currency,$pack,$currency,$discCode,$cancellable);
		$msg .='compra efetuada com sucesso, o item foi enviado para o seu bau viartual
		<a href="usercp/vault" class="alert-link">ver item no bau</a>';
		$type = 0;			
		}else{
		$msg .='Desculpe ocorreu um erro sua compra não foi efetuada.';
		$type = 1;			
		}
	
		}	
		else{
		$type = 1;	
		$msg =' Creditos insuficientes <br> você precisa de '.$row[0]->base_price.' '.$TABLES_CONFIGS['WEBCASH']['NAME'][$row[0]->currency].', para comprar esse item.';
		}
		
		
		}//end elf bloc
		$this->returnMsg($type,$rtn,$msg);
		}

		function cpos($item)
		{
			
		$item = (substr($item, 0, 2) == '0x') ? $item = substr($item, 2) : $item = $item;
		$item_lenght =strlen($item);
		$item_split[] = array(
			'id'			=> hexdec(substr($item,	0, 2)), 			// Item Id
			'option'		=> hexdec(substr($item,	2, 2)),				// Item Option Date
			'dur'			=> hexdec(substr($item, 4, 2)),				// Item Durability
			'serial'		=> ($item_lenght == 32) ? substr($item, 6, 8) : substr($item,	9,	5),// Item Serial Number
			'exe'			=> hexdec(substr($item,	14,	2)),			// Item Excellent Info
			'ancient'		=> hexdec(substr($item, 16, 2)),			// Item Ancient Info
			'cat'			=> hexdec(substr($item,	18,	2)),			// Item Cat
			'refinery'		=> hexdec(substr($item, 19,	2)),			// Item Refinery Info
			'itemtype'		=> floor(hexdec(substr($item, 18, 2))/16)); // Item Type		
		
		$item_split2[] = array(
			'harmonyoption' 	=>  hexdec(substr($item, 20, 1)), 	// Harmony Option Info
			'harmonyvalue'		=>  hexdec(substr($item, 21, 1)),	// Harmony Option Value
			'Socket1'			=>	substr($item, 22, 2), 			// Socket #1
			'Socket2'			=>	substr($item, 24, 2), 			// Socket #2
			'Socket3'			=>	substr($item, 26, 2), 			// Socket #3
			'Socket4'			=>	substr($item, 28, 2), 			// Socket #4
			'Socket5'			=>	substr($item, 30, 2));			// Socket #5	
		$this->item =	$item_split;

		#24|0|0D|C5|5555555|00|00|C0|00|0000000000
		#01|2|34|56|7891123|45|67|89|10|FF00000000
		#34|0|05|65|5555555|00|00|70|45|FFC9FF01C9
		
		}//end cpos
		
		function log_buy($login,$serial,$item,$prince,$status,$insurance,$ammount,$pack,$currency,$discCode,$cancellable)
		{//grava o log da compra
		$sql ="INSERT INTO [dbo].[Z_WebShopLog]
           ([memb___id]
           ,[serial]
           ,[item]
           ,[date]
           ,[price]
           ,[status]
           ,[insurance]
           ,[amount]
           ,[pack]
           ,[currency]
           ,[discCode]
           ,[cancellable])
     VALUES
           ('$login'
           ,'$serial'
           ,'$item'
           ,GETDATE()
           ,'$prince'
           ,'$status'
           ,'$insurance'
           ,'$ammount'
           ,'$pack'
           ,'$currency'
           ,'$discCode'
           ,'$cancellable')";	
		   $this->insertDB($sql);
		   
		  
		}
		
		private function socket()
		{
			if($cat <= 5){
				
				
			}
			if($cat >= 6 ||  $cat >= 11){
				
				
			}
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


