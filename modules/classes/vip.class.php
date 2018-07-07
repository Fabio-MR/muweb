<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Vip" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Vip   extends DataBase {
		public function __construct()
		{
		
		$this->list_vip();

		}

		public function list_vip()
		{ global $Tpl, $vip, $TABLES_CONFIGS;
			

			
			$li ='<ul  class="media-list">';
			
			foreach($vip as &$row){
			
			$li .='
					<li class="media" id="_vip_'.$row->id.'">
  <div class="media-left"> <a href=""> <img class="media-object" src="http://i.imgur.com/5tTpGXt.png" alt="..." width="100px"> </a> </div>
  <div class="media-body">
    <h4 class="media-heading">'.$row->name.' '.$row->days.' dias</h4>
    <div class="text-right">
      <form name="vip" method="post">
        <input type="hidden" name="action" value="vip">
        <input type="hidden" name="rtn" value="_vip_'.$row->id.'">
        <input type="hidden" name="id" value="'.$row->id.'">
        <input type="hidden" name="token" value="'.time().'">
        <input type="submit" name="buyvip" value="Comprar Agora" class="btn btn-primary">
      </form>
  </div>
  <p> '.$row->days.' dias | <font color="#b38e47">'.$row->prince.',00</font> '.$TABLES_CONFIGS['WEBCASH']['NAME'][$row->cash].' </p>
  </div>
  <div class="divider row"></div>
</li>
					
					';	
				
			}

			$li .='</ul>';
			
		$Tpl->set('RESULT',$li);	
		}

		}
}

