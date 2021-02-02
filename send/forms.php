<?php
if ( ! empty($_POST) && empty($_POST['antispam'])) {

        // Файлы phpmailer
        require 'phpmailer/PHPMailer.php';
        require 'phpmailer/SMTP.php';
        require 'phpmailer/Exception.php';


    // Обработка содержимого формы
        function clean($value = "") {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            
            return $value;
        }

        if (isset($_POST['orderTelSubmit'])) {
            if (trim($_POST['name']) != '' && trim($_POST['tel']) != '') {

                $name = clean($_POST["name"]);
                $tel = clean($_POST["tel"]);

                    $email_message = '
                    <html>
                    <body>
                    <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Клиент заказал звонок</p>
                        <p style = "margin: 0; padding: 15px 5px 0 24px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Имя клиента: ' . $name . '</p>
                        <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Номер клиента: ' . $tel .'</p>
                    </body>
                    
                    </html>
                    ';

            }


        } else if (isset($_POST['orderSubmit'])){
            if (trim($_POST['name']) != '' && trim($_POST['tel']) != '' &&  trim($_POST['address']) != '') {
                $name = clean($_POST["name"]);
                $tel = clean($_POST["tel"]);
                $address = clean($_POST["address"]);

                $offerSet=clean($_POST["offerSelectSet"]);
                $offerAmount=clean($_POST["offerSelectAmount"]);
                $orderContent =  $offerSet . ', количество: ' . $offerAmount . ' шт.';

                if (isset($_POST['offerSetSecond']) && isset($_POST['offerAmountSecond'])){
                    $offerSetSecond=clean($_POST["offerSetSecond"]);
                    $offerAmountSecond=clean($_POST["offerAmountSecond"]);
                    $orderContent =  '1) ' . $offerSet . ', количество: ' . $offerAmount . ' шт.;' . ' 2) ' . $offerSetSecond . ', количество: ' . $offerAmountSecond . ' шт.' ;

                }

                if (isset($_POST['offerSetThird']) && isset($_POST['offerAmountThird'])){
                    $offerSetThird=clean($_POST["offerSetThird"]);
                    $offerAmountThird=clean($_POST["offerAmountThird"]);
                    $orderContent =  '1) ' . $offerSet . ', количество: ' . $offerAmount . ' шт.;' . ' 2) ' . $offerSetSecond . ', количество: ' . $offerAmountSecond . ' шт.;' . ' 3) ' . $offerSetThird . ', количество: ' . $offerAmountThird . ' шт.' ;

                }

                if(!isset($_POST['offerSetThird']) && !isset($_POST['offerAmountThird']) &&  $offerSet == 'Полив 50' && $offerAmount == '1' && $offerSetSecond == 'Полив 100' && $offerAmountSecond == '1'){
                    $orderContent =  '1) ' . $offerSet . ', количество: ' . $offerAmount . ' шт.;' . ' 2) ' . $offerSetSecond . ', количество: ' . $offerAmountSecond . ' шт.' . '<br>' . 'Данный комплект товаров участвует в акции: «Полив 50» + «Полив 100» = «Полив 25» в подарок';
                }

                if(!isset($_POST['offerSetThird']) && !isset($_POST['offerAmountThird']) &&  $offerSet == 'Полив 100' && $offerAmount == '1' && $offerSetSecond == 'Полив 100' && $offerAmountSecond == '1'){
                    $orderContent =  '1) ' . $offerSet . ', количество: ' . $offerAmount . ' шт.;' . ' 2) ' . $offerSetSecond . ', количество: ' . $offerAmountSecond . ' шт.' . '<br>' . 'Данный комплект товаров участвует в акции: «Полив 100» + «Полив 100» = «Полив 50» в подарок';
                }


                $email_message = '
                <html>
                <body>
                <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Клиент сделал предварительный заказ</p>
                <p style = "margin: 0; padding: 15px 5px 0 24px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Имя клиента: ' . $name . '</p>
                <p style = "margin: 0; padding: 0 5px 5px 24px; font-family: sans-serif; font-size: 18px; padding-bottom: 0; color:white; background-color: #e69138;">Номер клиента: ' . $tel . '</p>
                <p style = "margin: 0; padding: 0 5px 5px 24px; font-family: sans-serif; font-size: 18px; padding-bottom: 15px; color:white; background-color: #e69138;">Адрес: ' . $address . '</p>
                <p style = "margin: 0; padding: 5px; padding-left: 24px; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Содержание заказа:' . '<br>' . $orderContent . '</p>
                </body>
                
                </html>
                ';

            }



            


        } else if (isset($_POST['wholesaleSubmit']) ){
                if (trim($_POST['name']) != '' && trim($_POST['tel']) != '' &&  trim($_POST['email']) != '') {
                    $name = clean($_POST["name"]);
                    $tel = clean($_POST["tel"]);
                    $email = clean($_POST["email"]);

                    $email_message = '
                    <html>
                    <body>
                    <p style = "margin: 0; padding:8px; padding-left: 24px;border-radius: 10px 10px 0 0; font-family: sans-serif; font-size:29px; color:white; background-color:#ff9900">Был заказан звонок для оптовых клиентов</p>
                        <p style = "margin: 0; padding: 15px 5px 0 24px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Имя клиента: ' . $name . '</p>
                        <p style = "margin: 0; padding: 0 5px 5px 24px; font-family: sans-serif; font-size: 18px; padding-bottom: 0; color:white; background-color: #e69138;">E-mail адрес: ' . $email . '</p>
                        <p style = "margin: 0; padding: 5px; padding-left: 24px; padding-top: 0; border-radius: 0 0 10px 10px; font-family: sans-serif; font-size: 18px; color:white; background-color: #e69138;">Номер: ' . $tel . '</p>
                    </body>
                    
                    </html>
                    ';
                }
        }

            
                
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
                        // -----------------------
                        // Само письмо
                        // -----------------------
                        $mail->isHTML(true);
                    
                        $mail->Subject = 'Новое сообщение';
                        $mail->Body    = $email_message;
                // Проверяем отравленность сообщения
                if ($mail->send()) {
                    header('location: thankYou.html');
                }else {
                    echo "Форма не отправлена. Ошибка в настройках почты сайта";
                }
                } catch (Exception $e) {
                    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
                }
                
                 } //  моя проверка закрылась
                
                