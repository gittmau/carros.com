<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/Exception.php';
require 'vendor/PHPMailer.php';
require 'vendor/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinatario = 'mauhonorat@gmail.com';
    $assunto = "Ficha Cadastral do site";

    // Validação do e-mail
    $email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("E-mail inválido.");
    }

    // Monta o corpo da mensagem com todos os campos do formulário
    $mensagem = "";
    foreach ($_POST as $campo => $valor) {
        $campo_limpo = htmlspecialchars(ucfirst(str_replace("_", " ", $campo)));
        $valor_limpo = htmlspecialchars($valor);
        $mensagem .= "$campo_limpo: $valor_limpo\n";
    }

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mauhonorat@gmail.com'; // Seu e-mail
        $mail->Password   = 'eliw erlp giqofeje';   // Sua senha ou senha de aplicativo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom('mauhonorat@gmail.com', 'Ficha cadastral do site');
        $mail->addAddress($destinatario);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem); // Com quebra de linha visível em HTML

        $mail->send();
        echo "<h1 style='color: green'>✅ Obrigado, seus dados foram enviados com sucesso. </h1>";
    } catch (Exception $e) {
        echo "<h1 style='color:red;font-family:sans-serif'> ❌ Ops! Houve um problema ao enviar sua mensagem. Tente novamente: </h1> {$mail->ErrorInfo}";
    }

    echo "<a href='cadastro.html' style='width:150px;display:block;margin:25px auto;background:seagreen;color:#fff;padding:10px;text-decoration:none;text-align:center;font-family:sans-serif'> Voltar à página </a>";
}
?>