<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Captcha" ) == false ) 
{
	class Captcha {
	    public function __construct()
        {
            $md5Hash = md5(rand(0, 999)); 
            $securityCode = strtolower(substr($md5Hash, 0, 8)); 

            $_SESSION["SecurityCode"] = $securityCode;

            $width  = 262;
            $height = 30; 

            $image = imagecreate($width, $height);  

            $white = imagecolorallocate($image, 0x0e, 0x05, 0x05);
            $black = imagecolorallocate($image, 0xff, 0xff, 0xff);
            $grey  = imagecolorallocate($image, 0xff, 0xff, 0xff);
            
            imagefill($image, 0, 0, $black); 
            imagestring($image, 15, 30, 3, $securityCode, $white); 
            imagerectangle($image, 0, 0, $width - 1, $height - 1, $grey);  

            header("Content-Type: image/jpeg"); 
            imagejpeg($image);
            imagedestroy($image);
        }	
	}	
}
