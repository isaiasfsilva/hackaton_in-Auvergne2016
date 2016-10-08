<?php

define('GUSER', 'sogreenhackaton@hotmail.com');  // <-- Insira aqui o seu GMail
define('GPWD', '12345678sg');        // <-- Insira aqui a senha do seu GMail

require_once('class.phpmailer.php');

function smtpmailer($para, $de_nome, $assunto, $corpo) {
    global $error;
    $mail = new PHPMailer();
    $mail->IsSMTP();        // Ativar SMTP
    $mail->SMTPDebug = 0;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
    $mail->SMTPAuth = true;     // Autenticação ativada
    $mail->SMTPSecure = 'tls';  // SSL REQUERIDO pelo GMail
    $mail->Host = 'smtp.live.com'; // SMTP utilizado
    $mail->Port = 587;          // A porta 587 deverá estar aberta em seu servidor
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom(GUSER, $de_nome);
    $mail->Subject = $assunto;
    $mail->Body = $corpo;
    $mail->IsHTML(true);



    $mail->AddAddress($para);
    if(!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}


function limpa_mascara($texto){
    return preg_replace('/[^0-9]/', '', $texto);
}

function validarEMAIL($email){
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    return false;
 }else{
   return true;
 }
}

function gerarSenha($tamanho=9, $forca=0) {
  $vogais = '0123456789';
  $senha = '';
  for ($i = 0; $i < $tamanho; $i++) {
      $senha .= $vogais[(rand() % strlen($vogais))];
  }
  return $senha;
}








?>