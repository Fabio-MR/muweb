<?php	ob_start();
	 	session_start();
		error_reporting(0);//E_ALL | E_STRICT
		date_default_timezone_set ('America/Sao_Paulo');
		header('Content-type: application/json');
		include('modules/autoload.php');
		include('../config/settings.php');
		$Security = new Security();
		if(@$_GET['page'] == "captcha"){$Captcha = new Captcha();}
		if(@$_GET['page'] == "logoGuildDecode"){$Gmark = new Gmark($_GET['decode'], 130);}
		
		$Bloc = new Bloc();
		if($Bloc->get_connect_stat() > 0){
		foreach ($_POST as $key => $value){$$key = $value;} 
		$arr = Array(
		 'type' =>		'1',
		 'rtn' =>		$rtn,
		 'msg' =>		"Desconect sua conta do jogo antes de prosseguir."
		);
		echo json_encode($arr);	
		exit;
		}
		switch(@$_POST['action'])
		{
		case "login":
		$Login = new Login();
		break;
		case "vip": // Compar vip
		$Vip = new Vip();
		break;
		case "register":
		$Register = new Register();
		break;	
		case "shopping":
		$Shopping = new Shopping();
		break;	
		case "vault":
		$Vault = new Vault();
		break;	
		case "unstuck":
		$Unstuck = new Unstuck();
		break;	
		case "rename":
		$Rename = new Rename();
		break;	
		case "change-email":
		$ChangEmail = new ChangEmail();
		break;	
		case "change-password":
		$ChangePassword = new ChangePassword();
		break;	
		case "open-ticket":
		$Ticket = new Ticket();
		break;	
		default:
				echo "Opa pagina ajax";
		foreach ($_POST as $key => $value){echo $key ."=". $value."<br>" ;} 
		break;
		}
			