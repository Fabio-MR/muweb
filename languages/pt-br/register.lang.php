<?php
/**
* Aqui ser�o definidos os textos da classe ldRegister do site.
*/
DEFINE("REGISTER_LOGOUT_FOR_REGISTER", "Erro: Voc� precisa deslogar do site para criar uma nova conta.");

DEFINE("REGISTER_EMPTY_INPUTS", "Erro: Algum campo foi deixado em branco!");
DEFINE("REGISTER_INCORRECT_SECURITY_CODE", "Erro: Digite o c&oacute;digo corretamente.");
DEFINE("REGISTER_DO_NOT_USE_SYMBOLS_LOGIN", "Erro: N&atilde;o use s&iacute;mbolos no login.");      
DEFINE("REGISTER_DO_NOT_USE_SYMBOLS_PASSWORD", "Erro: N&atilde;o use s&iacute;mbolos na senha.");      
DEFINE("REGISTER_DO_NOT_USE_SYMBOLS_REPASSWORD", "Erro: N&atilde;o use s&iacute;mbolos na confirma&ccedil;&atilde;o da senha.");      
DEFINE("REGISTER_LOGIN_INVALID_SIZE", "Erro: N&atilde;o use mais de 10 caracters no login.");      
DEFINE("REGISTER_EMAIL_IN_USE", "<font color=\"#D82020\">Erro: Email em uso!</font>");
DEFINE("REGISTER_LOGIN_IN_USE", "Erro: Login em uso!");
DEFINE("REGISTER_PASSWORD_NOT_MATCH", "Erro: As Senhas n&atilde;o conferem!");
DEFINE("REGISTER_WRITE_VALID_EMAIL", "Erro: Digite um e-mail v&aacute;lido!");
DEFINE("REGISTER_EMAIL_NOT_MATCH", "Erro: Os E-mails n&atilde;o conferem");

DEFINE("REGISTER_BONUS_PACKET_DETAILS", "Itens que esse pacote possui");
DEFINE("REGISTER_SUCCESS_REGISTER_BONUS_ITEMS", "Foi creditado na sua conta o b�nus de item: %s");

DEFINE("REGISTER_SUCCESS_REGISTER_BONUS_VIP", "Parab�ns!<br />Voc� foi premiado com %d dias de %s!<br />V�lidade: <strong>%s</strong><br /><em>Obrigado.</em>");
DEFINE("REGISTER_SUCCESS_REGISTER", "<strong>Cadastro realizado com sucesso!</strong><br />Login: <strong>%s</strong><br />Senha: <strong>%s</strong><br />Pergunta Secreta: <strong>%s</strong><br />Resposta Secreta: <strong>%s</strong><br />Obrigado.<br />Tenha um bom jogo.");

DEFINE("CREATE_ACCOUNT_ACTIVE_NOT_EXISTS_ACCOUNT", "Essa conta n�o existe!");
DEFINE("CREATE_ACCOUNT_ACTIVE_HAS_ACTIVE", "Essa conta j� foi ativada!");
DEFINE("CREATE_ACCOUNT_ACTIVE_SUCCESS", "Sua conta foi ativada com sucesso!<br />Obrigado, tenha um bom jogo!");
DEFINE("CREATE_ACCOUNT_ACTIVE_ERROR_HASH", "Sua conta n�o foi ativada devido o c�digo de ativa��o estar incorreto!<br />Caso queira re-enviar o link de ativa��o, <a href='?page=register&resendActivateEmail=%s'>clique aqui</a> para enviar-lo.");

DEFINE("CREATE_ACCOUNT_ACTIVE_EMAIL_SUBJECT", "Ativa��o de conta");
DEFINE("CREATE_ACCOUNT_ACTIVE_EMAIL_BODY", "Aten��o!<br />Esse e-mail � uma mensagem automatica gerada pelo ".TITLE_SITE."!<br /><br />Seu Login de acesso �: %s<br /><br />Sua Senha de acesso �: %s<br /><br />Sua pergunta secreta �: %s<br />Sua resposta secreta �: %s<br /><br />Para ativar sua conta clique no link abaixo: <a href='%s'>%s</a><br /><br />Tenha um bom jogo!<br />Equipe ".TITLE_SITE.".<br />");
DEFINE("CREATE_ACCOUNT_ACTIVE_EMAIL_BODY_PARTIAL", "Aten��o!<br />Esse e-mail � uma mensagem automatica gerada pelo ".TITLE_SITE."!<br /><br />Seu Login de acesso �: %s<br /><br />Para ativar sua conta clique no link abaixo: <a href='%s'>%s</a><br /><br />Tenha um bom jogo!<br />Equipe ".TITLE_SITE.".<br />");

DEFINE("CREATE_ACCOUNT_EMAIL_SUBJECT", "Cria��o de conta");
DEFINE("CREATE_ACCOUNT_EMAIL_BODY", "Aten��o!<br />Esse e-mail � uma mensagem automatica gerada pelo ".TITLE_SITE."!<br /><br />Seu Login de acesso �: %s<br /><br />Sua Senha de acesso �: %s<br /><br />Sua pergunta secreta �: %s<br />Sua resposta secreta �: %s<br /><br />Tenha um bom jogo!<br />Equipe ".TITLE_SITE.".<br />");

DEFINE("CREATE_ACCOUNT_EMAIL_SEND_INFO_ACTIVE_SUCCESS", "Foram enviadas as instru��es de ativa��o de conta para o seu e-mail!");
DEFINE("CREATE_ACCOUNT_EMAIL_SEND_INFO_ACTIVE_ERROR", "Erro ao enviar os dados de ativa��o de conta para o seu e-mail!");

DEFINE("CREATE_ACCOUNT_EMAIL_SEND_INFO_SUCCESS", "Foram enviado os dados da sua conta para seu e-mail!");
DEFINE("CREATE_ACCOUNT_EMAIL_SEND_INFO_ERROR", "Erro ao enviar os seus dados para o seu e-mail!");

?>