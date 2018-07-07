<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Ticket" ) == false ) {

   // new Language( str_replace(".class.", ".lang.", basename(__FILE__)), false );
	class Ticket   extends DataBase {
		public function __construct()
		{
		switch(@$_GET['type'])
		{
		case "new":
			$this->open_tickt();
		break;
		default:
			$this->ListTicket();
		break;
		}//$this->ReadTicket();
		}

		private function ReadTicket()
		{ global $Tpl;
		$list ='';
		$status ='<span class="ticket-open">open</span>';
		$id = @$_GET['id'];
		$sql ='
		SELECT [id]
			  ,[username]
			  ,[sector]
			  ,[subject]
			  ,[description]
			  ,[date]
			  ,[ip]
			  ,[status]
		  FROM [dbo].[webTickets] WHERE [username] =\''.$_SESSION[SESSION_NAME].'\' AND [id] = '.$id.'';
			$result = $this->selectDB($sql);
			foreach($result as &$row){				
			$list ='
            <table class="general-table-ui" cellspacing="0">
                <tbody><tr>
                    <th align="left" width="50%">Ticket ID:</th>
                    <td>#'.$row->id.'</td>
                </tr>
                <tr>
                    <th align="left" width="50%">Subject:</th>
                    <td>'.$row->subject.'</td>
                </tr>
                <tr>
                    <th align="left" width="50%">Author:</th>
                    <td>'.$row->username.'</td>
                </tr>
                <tr>
                    <th align="left" width="50%">Create Date:</th>
                    <td>'.date('d-m-Y H:i:s', $row->date).'</td>
                </tr>
                <tr>
                    <th align="left" width="50%">Last Update:</th>
                    <td>never </td>
                </tr>
                <tr>
                    <th align="left" width="50%">Status:</th>
                    <td>'.$status.'</td>
                </tr>
            </tbody></table>
            <br><br>
            <table class="general-table-ui" cellspacing="0">
                <tbody><tr>
                    <th align="left">'.$row->username.':</th>
                   <td align="left">'.$row->description.'</td>
                </tr>
            </tbody>
			<div id="_tickt"></div>
			</table>
            <form action="" method="post">
			<input type="hidden" name="page" value="open-ticket">
			<input type="hidden" name="type" value="repli">
			<input type="hidden" name="rtn" value="_tickt">

			<input type="hidden" name="tickt" value="'.$row->id.'">
                <table class="general-table-ui" cellspacing="0">
                    <tbody>
                    <tr>
                        <td><textarea rows="6" class="form-control" style="width:100%" name="message" required="" title="Enter 10 - 1024 characters" maxlength="1024"></textarea></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="hidden" name="token" value="1473303876">
						<button name="submit" value="submit" class="ui-button button1"><span class="button-left"><span class="button-right">Submit Reply</span></span></button></td>
                    </tr>
                </tbody></table>
            </form>

				';
			}
			$Tpl->set('TICKET',$list);
		}
		
		private function ListTicket()
		{ global $Tpl;
		$list ='';
		
		$sql ='
		SELECT [id]
			  ,[sector]
			  ,[subject]
			  ,[date]
			  ,[ip]
			  ,[status]
		  FROM [dbo].[webTickets] WHERE [username] =\''.$_SESSION[SESSION_NAME].'\'';
			$result = $this->selectDB($sql);
			$list ='<table class="general-table-ui" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <th>Date</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th>Last Update</th>
                  <th>Action</th>
                </tr>
              </tbody>';
			foreach($result as &$row){
			$list .=' <tr>
                    <td>'.date('d-m-Y H:i:s', $row->date).'</td>
                    <td>'.$row->subject.'</td>
                    <td><font color="green">open</font></td>
                    <td>never </td>
                    <td><a href="'.SITEBASE.'/'.SITE_DIR.'/ticket/view/'.$row->id.'">View Ticket</a></td>
                </tr>';	
							}
			$list .='</table>';				
			$Tpl->set('TICKET',$list);
		}
		
		private function open_tickt()
		{ global $Tpl;
		$list ='<form method="post" action="'.SITEBASE.'/'.SITE_DIR.'/ticket/my/" class="ticket" name="submit_ticket">
              <input type="hidden" name="action" value="open-ticket">
              <input type="hidden" name="rtn" value="feedback">
              <div class="form-group">
                <label> Subject: </label>
                <input class="form-control" type="text" name="subject" pattern=".{10,50}" required="" title="Enter 10 - 50 characters" value="" placeholder="Titulo da sua mensagem">
              </div>
              <div class="form-group">
                <label> Message: </label>
                <textarea class="form-control" maxlength="1024" rows="8"  pattern=".{30,1024}" name="message" required title="Enter 30 - 2014 characters" placeholder="Escreva sua mensagem..."></textarea>
              </div>
              <div class="form-group text-right">
                  <input type="hidden" name="token" value="1473299765">
                  <input type="submit" name="submit" class="btn btn-primary" value="Submit Ticket">
              </div>
            </form>';	
			$Tpl->set('TICKET',$list);
		}

}
}
