<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
// Переменные, которые отправляет пользователь
$goodName = $_POST['goodName'];
$goodAmount = $_POST['goodAmount'];

$email_message = '
    <html>
    <body>
    <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Клиент добавил дополнительный товар</p>
    <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">К последнему заказу был добавлен товар: ' . $goodName  . ', количество: ' . $goodAmount . '</p>
    </body>
    </html>
    ';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $msg = "ok";
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";                                          
    $mail->SMTPAuth   = true;
    // Настройки вашей почты
    $mail->Host       = 'ssl://smtp.yandex.ru'; // SMTP сервера GMAIL
    $mail->Username   = 'example@yandex.ru'; // Логин на почте
    $mail->Password   = 'example'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('example@yandex.ru', 'Название сайта'); // Адрес самой почты и имя отправителя
    // Получатель письма
    $mail->addAddress('example@yandex.ru');  

        // Само письмо
        // -----------------------
        $mail->isHTML(true);
    
        $mail->Subject = 'Новое сообщение';
        $mail->Body    = $email_message;
// Проверяем отравленность сообщения
if ($mail->send()) {
    echo "$msg";
} else {
echo "Товар не был добавлен. Ошибка в настройках почты сайта";
}
} catch (Exception $e) {
    echo "Товар не был добавлен. Причина ошибки: {$mail->ErrorInfo}";
}