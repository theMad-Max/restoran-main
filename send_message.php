<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);
    try {
        // Настройки сервера
        $mail->isSMTP();
        $mail->Host = 'onmaksontop@gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Ваш Gmail
        $mail->Password = 'your-email-password'; // Пароль Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Получатель
        $mail->setFrom('your-email@gmail.com', 'Website');
        $mail->addAddress('recipient@example.com');
        
        // Содержание
        $mail->isHTML(true);
        $mail->Subject = "Новое сообщение от $name";
        $mail->Body    = "Имя: $name<br>Email: $email<br>Сообщение: $message";
        
        $mail->send();
        echo 'Сообщение успешно отправлено!';
    } catch (Exception $e) {
        echo "Ошибка при отправке сообщения: {$mail->ErrorInfo}";
    }
}
?>
