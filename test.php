<?php
  //　データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');


  //  POST送信が行われたら、下記の処理を実行
  if (isset($_POST) && !empty($_POST)) {

    $nickname = $_POST['nickname'];
    $comment  = $_POST['comment'];

    //　SQL文作成実行
    $sql = 'INSERT INTO `oneline_bbs`.`posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'", now())'; // created なしでやる
    $stmt = $dbh->prepare($sql);
    //　INSERT文実行
    $stmt->execute();

    //　SQL文作成実行
    $sql = 'SELECT * FROM `oneline_bbs`.`posts` WHERE 1 '; // スペースを必ず入れる　「　1　」無条件での意（省略可能）
    $stmt1 = $dbh->prepare($sql);
    //　INSERT文実行
    $stmt1->execute();
    // データベースから切断
    $dbh = null;
  

  while(1) {
    $rec = $stmt1->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo '<h2><a href="#">'.$rec['nickname'].'</a>';
    echo '<span>'.$rec['created'].'</span></h2>';
    echo '<p>'.$rec['comment'].'</p>';         
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="test.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>
   
  </body>
</html>
