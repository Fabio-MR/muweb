<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Gmark" ) == false ) 
{
	class Gmark {
			private $mark;
			private $img;
			private $px;
			private $size;
	    public function __construct($mark, $size)
        {
	
		if($size > 100) $size = 100;
		$this->size = $size;
		$this->createImage();
		if(strlen($mark) != 64) 
		{
			imagecolorallocate($this->img, 255, 255, 255);
			$this->getMarkX();	 
		} 
		else 
		{
			imagecolorallocatealpha($this->img, 255, 255, 255, 127);
			$this->mark = str_split($mark);
			$this->getMark();
		}
        }	
		
		
	private function getMarkX() 
	{
		imagefilledrectangle($this->img, 0, 0, $this->size, $this->size, imagecolorallocate($this->img, 255, 255, 255));
		$red = imagecolorallocate($this->img, 255, 0, 0);
		imageline($this->img, 0, 0, $this->size, $this->size, $red);
		imageline($this->img, 0, $this->size, $this->size, 0, $red);
	}
	private function createImage() 
	{
		$this->img = imagecreate($this->size, $this->size);
		$this->px = $this->size/8;  
	}
	private function getMark() 
	{
		$y = 0; $x = 0;
		foreach($this->mark as $i => $new) 
		{
			if(ctype_xdigit($new) == false) 
			{
				$this->getMarkX();
				break;
			}
			if($i == 0) { $x = 0; } 
			elseif(($i % 8) == 0) { $y += $this->px; $x = 0;}
			else { $x += $this->px; }
			$tempColor = $this->getColor($new);
			if($tempColor != false) $cor = imagecolorallocate($this->img, $tempColor[0], $tempColor[1], $tempColor[2]);
			else $cor = imagecolorallocatealpha($this->img, 255, 255, 255, 127);
			imagefilledrectangle($this->img, $x, $y, $x+$this->px, $y+$this->px, $cor);
		}
	}
	private function getColor($str) 
	{
		switch(strtolower($str)) 
		{
			case(1) : return(array(0 ,0, 0)); break;
			case(2) : return(array(128, 128, 128)); break;
			case(3) : return(array(255, 255, 255)); break;
			case(4) : return(array(254, 0, 0)); break;
			case(5) : return(array(255, 127, 0)); break;
			case(6) : return(array(255, 255, 0)); break;
			case(7) : return(array(128, 255, 0)); break;
			case(8) : return(array(0, 255, 1)); break;
			case(9) : return(array(0, 254, 129)); break;
			case("a") : return(array(0, 255, 255)); break;
			case("b") : return(array(0, 128, 255)); break;
			case("c") : return(array(0, 0, 254)); break;
			case("d") : return(array(127, 0, 255)); break;
			case("e") : return(array(255, 0, 254)); break;
			case("f") : return(array(255,0 ,128)); break;
			default : return(false); break;
		}
	}
	public function __destruct() 
	{
		header("Content-Type: image/png", true);
		imagepng($this->img, null, 9);
		imagedestroy($this->img);
	}
	}	
}
