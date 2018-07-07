<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Og" ) == false ) {
 
   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Og   extends DataBase {
		public function __construct($title=TITLE,$description=DESCRIPTION,$page=NULL)
		{
		$this->SetOg($title,$description);

		}
		
		public function SetOg($title,$description)
		{ Global $Tpl;
		$url = "http://".$_SERVER['HTTP_HOST']."/".$_SERVER['REQUEST_URI'];
		$Tpl->set('OG[URL]',$url);
		$Tpl->set('TITLE',$title);
		$Tpl->set('OG[TITLE]',$title);
		$Tpl->set('OG[SITENAME]',SITENAME);
		$Tpl->set('OG[DESCRIPTION]',$description);
		$this->ogImage();
		}
		
		public function ogImage()
		{	global $Tpl;
		$result ='
<meta property="og:image" content="http:'.SITEBASE.'/'.SITE_DIR.'/templates/'.TEMPLATE_DIR.'/images/og/6henUOr.jpg" />
<meta property="og:image" content="http:'.SITEBASE.'/'.SITE_DIR.'/templates/'.TEMPLATE_DIR.'/images/og/Ve4ew1A.jpg" />
<meta property="og:image" content="http:'.SITEBASE.'/'.SITE_DIR.'/templates/'.TEMPLATE_DIR.'/images/og/SLsfGJ2.jpg" />
<meta property="og:image" content="http:'.SITEBASE.'/'.SITE_DIR.'/templates/'.TEMPLATE_DIR.'/images/og/NijBjQU.jpg" />';	
			
			$Tpl->set('OG:IMAGE',$result);
		}
		
	}
}

