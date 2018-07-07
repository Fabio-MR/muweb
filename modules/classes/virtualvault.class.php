<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "VirtualVault" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class VirtualVault   extends DataBase {
		public function __construct()
		{

		$this->List_itens();

		}

		public function List_itens()
		{ global $Tpl;
		$Item		=	new Item(); //Instacia a classe item
		$ItemInfo	=	$Item->LoadItemInfo(); //Carrega informações do item
		$sql ='SELECT [Number], [Item], [dbVersion] FROM [dbo].[WebWareHouseVirtual] where [AccountId] =\''.$_SESSION[SESSION_NAME].'\'';
		$result = $this->selectDB($sql);
		$itens ='';
		if(!empty($result)){
		foreach($result as &$row){
			$i = $Item->ExploItem($row->Item);
			$id		= $i['id'];		//id do item
			$cat	= $i['itemtype'];		//categoria do item
			
			//print('id:'.$id.'- cat '.$cat.'');
			
			$name = $ItemInfo[$cat][$id]['Name'];
			$itens .= '
			
			  <form>
			  <input type="hidden" name="page"	value="vault" />
			  <input type="hidden" name="action"	value="vault" />
			  <input type="hidden" name="rtn"	value="feedback" />
			  <input type="hidden" name="item_id"	value="'.$row->Number.'" />
			  <div class="input-group">
  <div class="form-control" aria-label="'.$name.'">'.$name.'</div>
  <div class="input-group-btn">
    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-chevron-right"></span></button>
  </div>
</div>
			  
			  </form>
  ';
		}}
		else{
		$itens ='Sem itens para mostrar. <br> Aqui ficam os itens comprados em nosso Shopping.';	
		}
		
		$Tpl->set('VAULT[VIRTUAL]',$itens);
		}

		}
}

