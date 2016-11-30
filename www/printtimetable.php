<?php
/*
 $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
  $root = $dom->createElement("users"); // Создаём корневой элемент
  $dom->appendChild($root);
  $logins = array("User1", "User2", "User3"); // Логины пользователей
  $passwords = array("Pass1", "Pass2", "Pass3"); // Пароли пользователей
  for ($i = 0; $i < count($logins); $i++) {
    $id = $i + 1; // id-пользователя
    $user = $dom->createElement("user"); // Создаём узел "user"
    $user->setAttribute("id", $id); // Устанавливаем атрибут "id" у узла "user"
    $login = $dom->createElement("login", $logins[$i]); // Создаём узел "login" с текстом внутри
    $password = $dom->createElement("password", $passwords[$i]); // Создаём узел "password" с текстом внутри
    $user->appendChild($login); // Добавляем в узел "user" узел "login"
    $user->appendChild($password);// Добавляем в узел "user" узел "password"
    $root->appendChild($user); // Добавляем в корневой узел "users" узел "user"
  }
  $dom->save("users.xml"); // Сохраняем полученный XML-документ в файл
*/
include 'conn.php';

$sql="select distinct(dayOfWeek) from timetable";

$sql1="select idTimetable, dayOfWeek, TIME_FORMAT(timeoftrain.start, '%H:%i') as start, TIME_FORMAT(timeoftrain.end, '%H:%i') as end,
concat(surnameSt, ' ' , staff.nameSt) as coach, style.nameSt,  typeOfTrain
from timetable, timeoftrain, trainings, staff, style
where timetable.idTime = timeoftrain.idTime
and timetable.idTrain = trainings.idTrain
and trainings.idCoach=staff.idStaff
and trainings.idStyle = style.idStyle
order by numberOfGum, start";

// Обеспечим выполнение запроса и получение объекта recordset
    $result=mysql_query($sql);
    $result1=mysql_query($sql1);

    $dom = new domDocument("1.0", "utf-8");
    $root = $dom->createElement("Расписание");
    $dom->appendChild($root);
   
   while($res=mysql_fetch_array($result))
   {
    $week = $dom->createElement("день");
    $week->setAttribute("время", $res['dayOfWeek']); 
    $root->appendChild($week);
       $result1=mysql_query($sql1);
       while($res1=mysql_fetch_array($result1))
       { 
           if($res1['dayOfWeek'] == $res['dayOfWeek'])
           {
               $train = $dom->createElement("тренировка");
               $train->setAttribute("тренер", $res1['coach']); 
               $train->setAttribute("начало", $res1['start']); 
               $train->setAttribute("конец", $res1['end']); 
               $train->setAttribute("тренировка", $res1['nameSt']); 
               $week->appendChild($train);
           }
       }
       
   }
$dom->save("timetable.xml");

echo json_encode(array('msg'=>'Файл успешно загружен.'));



?>