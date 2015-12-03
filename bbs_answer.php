<?php
  //  POST送信が行われたら、下記の処理を実行
  if (isset($_POST['nickname']) && isset($_POST['comment'])) { // isset() !
  //if (isset($_POST['nickname'] && $_POST['comment'])){
  //if (isset($_POST['nickname' && 'comment'])){

    //　データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $nickname = $_POST['nickname'];
    $comment  = $_POST['comment'];

    //　SQL文作成実行
    $sql = 'INSERT INTO `oneline_bbs`.`posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'", now())'; // created なしでやる
    $stmt = $dbh->prepare($sql);
    //　INSERT文実行
    $stmt->execute();

    //　SQL文作成実行
    $sql = 'SELECT * FROM `oneline_bbs`.`posts` WHERE 1 '; // スペースを必ず入れる　「　1　」無条件での意（省略可能）
    $stmt = $dbh->prepare($sql);
    //　INSERT文実行
    $stmt->execute();
  
  
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>
    
    <!--
    <h2><a href="#">nickname Eriko</a><span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a><span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>
    -->

    <?php
      // 表示をする
      while(1) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
          break;
        }
        echo '<h2><a href="#">'.$rec['nickname'].'</a>';
        echo '<span>'.$rec['created'].'</span></h2>';
        echo '<p>'.$rec['comment'].'</p>';        
      }

      // データベースから切断
      $dbh = null;

    ?>
  </body>
</html>



