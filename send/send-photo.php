<?php


      // Файлы phpmailer
      require 'phpmailer/PHPMailer.php';
      require 'phpmailer/SMTP.php';
      require 'phpmailer/Exception.php';


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
            // Прикрипление файлов к письму


            $fileSize = $_FILES['galleryPhoto']['size'];
            $fileType = $_FILES['galleryPhoto']['type'];
            $error = $_FILES['galleryPhoto']['error'];
            

            if (($fileType === 'image/jpeg' || $fileType === 'image/png') &&  $fileSize <= 2000000 && $error === 0){
               $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['galleryPhoto']['name']));
               $filename = $_FILES['galleryPhoto']['name'];
               if (move_uploaded_file($_FILES['galleryPhoto']['tmp_name'], $uploadfile)) {              
                  $mail->addAttachment($uploadfile, $filename);
               } else {
                  $msg = 'Не удалось прикрепить файл ' . $uploadfile;
               }

            } else{
               $msg = 'Допустимые форматы: png, jpg. <br> Допустимый размер файла: 2 Мб';
               
            }


            
         
            if ($msg === "ok"){
               $email_message = '
               <html>
               <body>
               <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Клиент добавил фото</p>
               <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Была загружена фотография в галерею. Файл в приложении к данному письму.</p>
               </body>
               </html>
               ';
            } else {
               $email_message = '
               <html>
               <body>
               <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Новое сообщение</p>
               <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Клиент попытался загрузить фото в галерею, но файл не прошел необходимые проверки (большой размер файла/неподходящий формат или иные проблемы).</p>
               </body>
               </html>
               ';
            }



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
         echo "Фото не былы отправлено. Причина ошибки: {$mail->ErrorInfo}";
      }

