<?php	ob_start();
	 	session_start();
	
		//error_reporting(0);
		error_reporting(E_ALL | E_STRICT);//E_ALL | E_STRICT
		date_default_timezone_set ('America/Sao_Paulo');
		header('Content-Type: text/html; charset=UTF-8');

		include('modules/autoload.php');
		include('config/settings.php');
		$Security = new Security();
		//$db = new DataBase(); //Faz a conexão com o banco de dados.
		$Tpl = new Tpl(); //Chama a classe template.
		$General = new General();
		switch(@$_GET['page'])
		{
		case "logout":
		session_destroy();
		echo'<script>window.location="'.SITEBASE.'/'.SITE_DIR.'";</script>';
		break;	
				
		case "logoGuildDecode":
		$Gmark = new Gmark($_GET['decode'], 130);
		exit;
		break;
		//case "server":
		//$Statistics = new Statistics();
		//break;
		// teste
		
		case "vault":
		$Vault = new Vault();
		break;
		
		case "lottery":
 		 
       $Tpl->open("templates/".TEMPLATE_DIR."/lottery.tpl.php");	
		break;
		case "onlines":
		$Onlines = new Onlines();
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/onlines.tpl.php");	
		break;
		case "profile":
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/player.tpl.php");	
		break;
		case "contact":
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/contact.tpl.php");	
		break;
		case "downloads":
		case "files":
 		 
		$Downloads = new Downloads();
        $Tpl->open("templates/".TEMPLATE_DIR."/downloads.tpl.php");	
		break;		
		case "shopping":
		 
		$Shopping = new Shopping();
        $Tpl->open("templates/".TEMPLATE_DIR."/shopping.tpl.php");	
		break;	
		case "shopping-details":
		 
		$Shopping = new Shopping();
        $Tpl->open("templates/".TEMPLATE_DIR."/shopping-details.tpl.php");	
		break;	
		
		/* Painel de controle */
		case "usercp":
		$Usercp = new Usercp();
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp.tpl.php");	
		break;
		case "usercp[menu]":
		if(!empty($_SESSION[SESSION_NAME])){
        	$Tpl->open("templates/".TEMPLATE_DIR."/menu-usercp.tpl.php");}else{
				echo'';
				exit;
			}
		break;
		case "usercp[reset]":
		$Usercp = new Usercp('Reset');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-reset.tpl.php");	
		break;
		case "usercp[greset]":
		$Usercp = new Usercp('Master Reset');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-greset.tpl.php");	
		break;
		case "usercp[addstats]":
		$Usercp = new Usercp('Adicionar pontos');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-addstats.tpl.php");	
		break;
		case "usercp[resetstats]":
		$Usercp = new Usercp('Redistribuir pontos');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-resetstats.tpl.php");	
		break;
		case "usercp[unstuck]":
		$Usercp = new Usercp('Mover personagem');
		$Usercp->map_list();
		$Usercp->character_list();
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-unstuck.tpl.php");	
		break;
		case "usercp[clearpk]":
		$Usercp = new Usercp('Limpar PK');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-clearpk.tpl.php");	
		break;
		case "usercp[achievements]":
		$Usercp = new Usercp('Conquistas');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-achievements.tpl.php");	
		break;
		case "usercp[webbank]":
		$Usercp = new Usercp('Web Bank');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-webbank.tpl.php");	
		break;
		case "usercp[market]":
		$Usercp = new Usercp('Lojas');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-market.tpl.php");	
		break;
		case "usercp[exchange]":
		$Usercp = new Usercp('Exchange');
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-exchange.tpl.php");	
		break;
		
		case "usercp[rename]":
		$Usercp = new Usercp('Renomear personagem');
		$Usercp->character_list();
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-rename.tpl.php");	
		break;
		
		case "usercp[mypassword]":
		 
		$Usercp = new Usercp('Minha senha');
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-mypassword.tpl.php");	
		break;
		case "usercp[vip]":
		 
		$Usercp = new Usercp('Vip');
		$Vip = new Vip();
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-vip.tpl.php");	
		break;

		case "usercp[vault]":
		 
		$Usercp = new Usercp('Bau');
		
		$Vault = new Vault();
		//visualização bau do jogo
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-vault.tpl.php");	
		break;
		//myemail
		case "usercp[myemail]":
		 
		$Usercp = new Usercp('Meu Email');
        $Tpl->open("templates/".TEMPLATE_DIR."/usercp-myemail.tpl.php");	
		break;
		
		
		
		
		case "ticket":
		$Ticket = new Ticket();
		 
	    $Tpl->open("templates/".TEMPLATE_DIR."/ticket.tpl.php");	
		break;			
		
		case "rankings":
			case "ratings":
		 
		$Rankings = new Rankings();
        $Tpl->open("templates/".TEMPLATE_DIR."/rankings.tpl.php");	
		break;			
		case "notice":
		$Notice = new Notice();
		$Notice->ListNotice('100');
		$Notice->ReadNotice(@$_GET['notice']);
        $Tpl->open("templates/".TEMPLATE_DIR."/home.tpl.php");	
		break;			
		case "changelogs":
		 
        $Tpl->open("templates/".TEMPLATE_DIR."/changelogs.tpl.php");	
		break;			
		case "about":
		case "server":
 		 
       $Tpl->open("templates/".TEMPLATE_DIR."/about.tpl.php");	
		break;			
		case "drop":
		 
		$Drop = new Drop();
        $Tpl->open("templates/".TEMPLATE_DIR."/drop.tpl.php");	
		break;			
		 
		case "tos":
        $Tpl->open("templates/".TEMPLATE_DIR."/tos.tpl.php");	
		break;			
		case "rules":
  		 
      $Tpl->open("templates/".TEMPLATE_DIR."/rules.tpl.php");	
		break;			
		//Donation
		case "donation":
 		 
       $Tpl->open("templates/".TEMPLATE_DIR."/donation.tpl.php");	
		break;	
		case "pagseguro":
		 
		if(isset($_SESSION[SESSION_NAME]) == true)
		{
  		$PagSeguro = new PagSeguro();
		$Tpl->open("templates/".TEMPLATE_DIR."/pagseguro.tpl.php");	
		}else{
        $Tpl->open("templates/".TEMPLATE_DIR."/login.tpl.php");	
			}
		break;	
		case "paypal":
		 
		if(isset($_SESSION[SESSION_NAME]) == true)
		{
 		$PagSeguro = new PagSeguro();
		$Tpl->open("templates/".TEMPLATE_DIR."/paypal.tpl.php");	
		}else{
        $Tpl->open("templates/".TEMPLATE_DIR."/login.tpl.php");	
			}
		break;	
		
				
		case "register":
			case "signup":		
    		 
    $Tpl->open("templates/".TEMPLATE_DIR."/register.tpl.php");	
		break;		
		case "login":
		case "signin":
 		 
       $Tpl->open("templates/".TEMPLATE_DIR."/login.tpl.php");	
		break;	
		case "info":
  		 
      $Tpl->open("templates/".TEMPLATE_DIR."/info.tpl.php");	
		break;	
		case "ts3":
   		 
     $Tpl->open("templates/".TEMPLATE_DIR."/ts3.tpl.php");	
		break;
		
		case "castlesieg":
   		 
		$CastleSieg = new CastleSieg(); 
     	$Tpl->open("templates/".TEMPLATE_DIR."/castlesieg.tpl.php");	
		break;
		case "modelo":
   		 
     	$Tpl->open("templates/".TEMPLATE_DIR."/modelo.tpl.php");	
		break;	
		break;
		case "statistic":
   		 
     	$Tpl->open("templates/".TEMPLATE_DIR."/statistic.tpl.php");	
		break;	
		case "classes":
   		 
     	$Tpl->open("templates/".TEMPLATE_DIR."/classes.tpl.php");	
		break;	
		default:
		 
		$Notice = new Notice();
		$Notice->ListNotice();
		$Home = new Home();
        $Tpl->open("templates/".TEMPLATE_DIR."/home.tpl.php");	
		break;	
		}
		// EXIBE O SITE
		$Tpl->show();  
		
		if(!empty($_GET['invited'])){
		setcookie("INVITED_BY","".$_GET['invited']."");
		
		}
		
		if(!empty($_COOKIE['INVITED_BY'])){
		echo "Convidado por ".$_COOKIE['INVITED_BY'];
		print_r($_COOKIE);
		}
		ob_end_flush();