<?php

if ( ! empty($_POST) && empty($_POST['antispam'])) {
      // Файлы phpmailer
      require 'phpmailer/PHPMailer.php';
      require 'phpmailer/SMTP.php';
      require 'phpmailer/Exception.php';
      // Переменные, которые отправляет пользователь

      function clean($value = "") {
         $value = trim($value);
         $value = stripslashes($value);
         $value = strip_tags($value);
         $value = htmlspecialchars($value);
         
         return $value;
      }

      if (trim($_POST['name']) != '' && trim($_POST['tel']) != '' && trim($_POST['question'])) {

         $name =  clean($_POST["name"]);
         $tel =  clean($_POST["tel"]);
         $question =  clean($_POST["question"]);

         $email_message = '
         <html>
         <body>
         <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Клиент задал вопрос</p>
            <p style = "margin: 0; padding: 15px 5px 0 24px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Имя клиента: ' . $name . '</p>
            <p style = "margin: 0; padding: 0 5px 5px 24px; font-family: sans-serif; font-size: 18px; padding-bottom: 15px; color:white; background-color: #e69138;">Номер: ' . $tel . '</p>
            <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Содержание вопроса: ' . $question . '</p>
         </body>

         </html>
         ';

      } // end if (trim($_POST['name'])(...)

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
         echo "Форма не отправлена. Ошибка в настройках почты сайта";
      }
      } catch (Exception $e) {
         echo "Товар не был добавлен. Причина ошибки: {$mail->ErrorInfo}";
      }

}