<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Usercp" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Usercp   extends DataBase {
		public function __construct($page='')
		{   global $Tpl;                        
		if(empty($_SESSION[SESSION_NAME])){
				echo'<script>window.location="'.SITEBASE.'/'.SITE_DIR.'/login/";</script>';
		}else{
			$this->dv_member_ur();
			$this->account_basic_info();
		}
		
		$Tpl->set('PAGE',$page);
		}
		
		function account_basic_info()
		{   Global $Tpl;  
			$sql ='
			SELECT [memb_guid]
			  ,[memb___id]
			  ,[memb__pwd]
			  ,[memb_name]
			  ,[sno__numb]
			  ,[post_code]
			  ,[addr_info]
			  ,[addr_deta]
			  ,[tel__numb]
			  ,[phon_numb]
			  ,[mail_addr]
			  ,[fpas_ques]
			  ,[fpas_answ]
			  ,[job__code]
			  ,[appl_days]
			  ,[modi_days]
			  ,[out__days]
			  ,[true_days]
			  ,[mail_chek]
			  ,[bloc_code]
			  ,[ctl1_code]
			  ,[AccountLevel]
			  ,[AccountExpireDate]
  FROM [dbo].[MEMB_INFO]
  WHERE [memb___id] =\''.$_SESSION[SESSION_NAME].'\'
			';
			$result = $this->selectDB($sql);
			
			if(count($result) <= 0){
				print('Errro usuario nao encontrado');
			}else{
				$Tpl->set('USERNAME',$result[0]->memb_name);
				$Tpl->set('USER',$_SESSION[SESSION_NAME]);
				$Tpl->set('USEREMAIL',$result[0]->mail_addr);
				$Tpl->set('FPASQUES',$result[0]->fpas_ques);
				

				$this->info_ammount();
			}
		}

		private function info_ammount()
		{   global $Tpl;
$sql ='SELECT [WCoinC],[WCoinP],[GoblinPoint] FROM [dbo].[CashShopData] WHERE [AccountID] =\''.$_SESSION[SESSION_NAME].'\'';
	
		$result = $this->selectDB($sql);
		if(count($result) > 0){
		$Tpl->set('AMOUNT[1]',$result[0]->WCoinC);
		$Tpl->set('AMOUNT[2]',$result[0]->WCoinP);
		$Tpl->set('AMOUNT[3]',$result[0]->GoblinPoint);			
		}else{
		$Tpl->set('AMOUNT[1]','0');
		$Tpl->set('AMOUNT[2]','0');
		$Tpl->set('AMOUNT[3]','0');			
			
		}

		
		}
		
		public function map_list()
		{ global $Tpl, $MAPS;
	
		$li ='<option value="">Selecione um mapa</option>';
		foreach( $MAPS as &$map){
			
			$li .='<option value="'.$map->id.'">'.$map->name.'</option>';
		}

		$Tpl->set('RESULT[MAP]',$li);
		}
		
		public function character_list()
		{ global $Tpl;
			$sql ='SELECT [Name] FROM [dbo].[Character] WHERE  [AccountID] = \''.$_SESSION[SESSION_NAME].'\'';
			$result = $this->selectDB($sql);
			$li ='<option value="">Selecione um personagem</option>';
			foreach($result as &$row){
			$li .= '<option value="'.$row->Name.'">'.$row->Name.'</option>';
			}
			
			$Tpl->set('RESULT[CHARACTER]',$li);
		}
		
		public function dv_member_ur()
		{
		$sql ='SELECT [id] ,[url] FROM [dbo].[web_dv] WHERE [owner] = \''.$_SESSION[SESSION_NAME].'\'';	
		$result = $this->selectDB($sql);
		if(count($result) > 0){
		//print('Você é um divulgador');	
		}else{
		//print('gostaria de se tornar um divulgador mu ruby e ganhar premios?');	
		}
		
		
		}
		
	}
	
}

