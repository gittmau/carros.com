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
    // Sanitização dos campos
    $nome     = htmlspecialchars(trim($_POST["nome"] ?? ''));
    $email    = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $celular  = htmlspecialchars(trim($_POST["celular"] ?? ''));
    $mensagem = htmlspecialchars(trim($_POST["mensagem"] ?? ''));

    // Validações
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("E-mail inválido.");
    }
    if (empty($nome) || empty($mensagem)) {
        exit("Por favor, preencha todos os campos obrigatórios.");
    }

    // Instancia PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mauhonorat@gmail.com'; // seu e-mail
        $mail->Password   = 'eliw erlp giqofeje';          // sua senha ou senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom('mauhonorat@gmail.com', 'Mensagem da pagina de contato do site');
        $mail->addAddress('mauhonorat@gmail.com');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = "Mensagem da pagina de contato do site";
        $mail->Body    =
            "Nome: $nome\n" .
            "Email: $email\n" .
            "Celular: $celular\n\n" .
            "Mensagem:\n$mensagem";

        // Envia
        $mail->send();
        echo "<h1 style='color: green;'>✅ Obrigado, $nome! Sua mensagem foi enviada com sucesso.</h1>";
    } catch (Exception $e) {
        echo "<h1 style='color:red;font-family:sans-serif;'> ❌ Ops! Houve um problema ao enviar sua mensagem. Tente novamente: {$mail->ErrorInfo} </h1>";
    }  echo "<a href='contato.html' style='width:150px;display:block;margin:25px auto;background:seagreen;color:#fff;padding:10px;text-decoration:none;font-family:sans-serif;text-align:center'> Voltar a página </a>";
}
?>