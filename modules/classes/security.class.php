<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Security" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Security {
		public function __construct()
		{                           
			foreach ($_POST as $key => $value){$_POST[$key] = $this->format($value);} 
			foreach ($_GET as $key => $value){$_GET[$key] = $this->format($value);} 

		}

		public function format($value)
		{
		$f = str_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $value);	
		$f = htmlentities($f, ENT_QUOTES);
		return $f;
		}
		private function log_g()
		{/*
			$fp=@fopen("logs_.txt", "a");
			@fwrite($fp, serialize($POST));
			@fclose($fp);	
			*/
		}
	}
	
}

