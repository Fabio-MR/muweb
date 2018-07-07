<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Notice" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Notice   extends DataBase {
		public function __construct()
		{
			
		}

		public function ReadNotice($notice)
		{ global $Tpl;

			if(!empty($notice)){
			$sql ='SELECT [id],[subject],[content],[date] FROM [dbo].[webNotices] WHERE [id] = \''.$notice.'\'';
			$result = $this->selectDB($sql);

//print_r(strlen($result[0]->content));
			$Tpl->set('SHOW[TITLE]',html_entity_decode($result[0]->subject));
			$Tpl->set('SHOW[NOTICE]',html_entity_decode($result[0]->content));
			$title  = strip_tags(html_entity_decode($result[0]->subject));
			$description = strip_tags(html_entity_decode($result[0]->content));
			}else{
			$Tpl->set('SHOW[TITLE]','Noticias');
			$Tpl->set('SHOW[NOTICE]','Selecione uma noticia abaixo');
				}
			$Og = new Og('Noticias','Noticias '.SITENAME.'');

		}
		
		public function ListNotice($TOP=10)
		{ global $Tpl;
		$list ='<ul class="hof">';
		
		$sql ='SELECT TOP '.$TOP.' [id],[subject],[content],[date] FROM [dbo].[webNotices] ORDER BY [id] DESC';
			$result = $this->selectDB($sql);
			
			
			
			foreach($result as &$row){
			$date = date('d/m/Y H:i:s', $row->date); 
			$list .='<li>
                      <p class="glyphicon glyphicon-arrow-right"></p>
                      <a href="'.SITEBASE.'/'.SITE_DIR.'/notice/'.$row->id.'/">'.html_entity_decode($row->subject).'</a> <span>'.$date.'</span> </li>';	
							}
			$list .='</ul>';
			$Tpl->set('LIST[NOTICE]',$list);
		}
		


}
}
