<?php
	// Это код отправки письма с данными из формы на странице сайта. При заполнении этой формы необходимо указать свои данные. Вложение при этом является необязательным, т.е. письмо должно быть отправлено как с ним, так и без него. Код содержит ошибку – письмо не доходит, если вложение отсутствует. Необходимо найти ошибку и предложить вариант ее исправления.
  //Письмо не доходит потому что для пустых писем не указан адресат. Нужно или указать адресата (создать переменную $mail_to) или взять уже существующих из переменной $mail_to_array. Ниже я выделил участок кода.
  $picture = "";

  $mail_to_array = array(
        'webmaster2@bmservice.com.ua',
        'webmaster@bmservice.com.ua'
    );

  $thm = 'BM Service Training program';

  $msg = '
  <h1>BM Service Training program</h1>
  <h2>Персональные данные</h2>
  <hr>
  Прислано от : '.$_POST['userFirstName'].' '.$_POST['userSecondName'].'
  <br>
  Телефон : '.$_POST['phone'].'
  <br>
  Email: '.$_POST['email'].'
  <br>
  Дата рождения: '.$_POST['birth'].'
  <br>
  <br>
  Место проживания: '.$_POST['city-live'].'
  <br>
  <h2>Профессиональные навыки</h2>
  <hr>
  Город: '.$_POST['city'].'
  <br>
  Университет: '.$_POST['university'].'
  <br>
  Факультет: '.$_POST['faculty'].'
  <br>
  Кафедра: '.$_POST['speciality'].'
  <br>
  Год Выпуска: '.$_POST['dYear'].'
  <br>
  Опыт работы: '.$_POST['experience'].'
  <br>
  Дополнительная информация: '.$_POST['addInfo'].'
  <br>
  Когда готовы преступить к практике: '.$_POST['startPractic'].'';


  // Если поле выбора вложения не пустое - закачиваем его на сервер
  if (!empty($_FILES['mail_file']['tmp_name']))
  {
    // Закачиваем файл
    $target_dir = "file/";
    $path = $target_dir.$_FILES['mail_file']['name'];
    if (copy($_FILES['mail_file']['tmp_name'], $path)) $picture = $path;
  }


  
  // Отправляем почтовое сообщение
  //Этот участок


  if(empty($picture)) mail($mail_to, $thm, $msg);


    //Этот участок

  else  foreach ($mail_to_array as $mail_to){
       send_mail($mail_to, $thm, $msg, $picture);
  }  
    
  // Вспомогательная функция для отправки почтового сообщения с вложением (Trianon)
  function send_mail($mail_to, $thema, $html, $path)
  { if ($path) {
    $fp = fopen($path,"rb");
    if (!$fp)
    { print "Cannot open file";
      exit();
    }
    $file = fread($fp, filesize($path));
    fclose($fp);
    }
    $name = "file.pdf"; // в этой переменной надо сформировать имя файла (без всякого пути)
    $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
    $boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных.
    $headers    = "MIME-Version: 1.0;$EOL";
    $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";
    $headers   .= "From: job.robot@bmservice.com.ua";

    $multipart  = "--$boundary$EOL";
    $multipart .= "Content-Type: text/html; charset=utf-8$EOL";
    $multipart .= "Content-Transfer-Encoding: base64$EOL";
    $multipart .= $EOL; // раздел между заголовками и телом html-части
    $multipart .= chunk_split(base64_encode($html));

    $multipart .=  "$EOL--$boundary$EOL";
    $multipart .= "Content-Type: application/octet-stream; name=\"$name\"$EOL";
    $multipart .= "Content-Transfer-Encoding: base64$EOL";
    $multipart .= "Content-Disposition: attachment; filename=\"$name\"$EOL";
    $multipart .= $EOL; // раздел между заголовками и телом прикрепленного файла
    $multipart .= chunk_split(base64_encode($file));

    $multipart .= "$EOL--$boundary--$EOL";

        if(!mail($mail_to, $thema, $multipart, $headers))
         {return False;           //если не письмо не отправлено
      }
    else { //// если письмо отправлено


    return True;
    }
  exit;
  }
  echo '<script>window.location.href = "http://bmservice.com.ua";</script>';
?>
