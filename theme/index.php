<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>松居の野望</title>

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="assets/css/main.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/form.css" rel="stylesheet">
<link href="assets/css/header.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="assets/js/chart.js"></script>


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<div id="header" class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header" >
				<a class="navbar-brand" href="#">
					<i class="fa fa-bullseye"></i>
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<h3 class="col-md-7 col-md-offset-4" style="margin-top: 8px;">Do you want to be a greatest Shogun?</h3>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">
		<div class="row">
			<!-- left box -->
			<div class="col-md-5">
				<form action="index.php" method="post" role="form" class="col-md-10 go-right">
					<h2>Tell Me<br>Your Ambition!!!</h2>
					<div class="form-group">
						<input id="name" name="nickname" type="text" class="form-control" required>
						<label for="name">Your Name</label>
					</div>

					<div class="form-group">
						<textarea id="message" name="comment" class="form-control" required></textarea>
						<label for="message">Comment...</label>
					</div>
					<div>
						<button type="submit" id="submit-btn" role="button">果し状を送る</button>
					</div>
				</form>
			</div><!-- .col-md-4 -->

			<!-- right box -->
			<div class="col-md-7">
				<?php
					//　データベースに接続
					// $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
					// $user = 'root';
					// $password = '';
					$dsn = 'mysql:dbname=LAA0685931-onelinebbs;host=mysql105.phy.lolipop.lan';
					$user = 'LAA0685931';
					$password = 'nexseed12004';
					$dbh = new PDO($dsn, $user, $password);
					$dbh->query('SET NAMES utf8');

					//  POST送信が行われたら、下記の処理を実行
					if (isset($_POST) && !empty($_POST)) {

						$nickname = $_POST['nickname'];
						$comment  = $_POST['comment'];

						//　SQL文作成実行
						//$sql='INSERT INTO `LAA0685931-onelinebbs`.`posts` (`id`, `nickname`, `comment`, `created`) VALUES (NULL, '1234', '1234', '2015-12-07 00:00:00')';
						// $sql = 'INSERT INTO `oneline_bbs`.`posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'", now())'; // created なしでやる
						$sql = 'INSERT INTO `LAA0685931-onelinebbs`.`posts` (`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'", now())';
						$stmt = $dbh->prepare($sql);
						//　INSERT文実行
						$stmt->execute();
					}
						//　SQL文作成実行
						// $sql = 'SELECT * FROM `oneline_bbs`.`posts` ORDER BY `created` DESC'; // db 下から取得する
						$sql = 'SELECT * FROM `LAA0685931-onelinebbs`.`posts` ORDER BY `created` DESC'; // スペースを必ず入れる　「　1　」無条件での意（省略可能）
						$stmt = $dbh->prepare($sql);
						//　INSERT文実行
						$stmt->execute();

						// 投稿表示
						while(1) {
							$rec = $stmt->fetch(PDO::FETCH_ASSOC);
							if ($rec == false) {
								break;
						}
						
						echo '<div class="timeline-centered">';
							// echo '<div class="col-xs-12 col-md-8">';
								echo '<article class="timeline-entry">';
									echo '<div class="timeline-entry-inner">';

										echo '<time class="timeline-time" datetime="2014-01-10T03:45"><span>'.$rec['created'].'</span> <span>Today</span></time>';
										echo '<div class="timeline-icon bg-success">';
											echo '<i class="entypo-feather"></i>';
										echo '</div>';
										echo '<div class="timeline-label">';
											echo '<h2><a href="#">'.$rec['nickname'].'</a> <span>posted a status update</span></h2>';
											echo '<p>'.$rec['comment'].'</p>';
										echo '</div>';

									echo '</div>';
								echo '</article>';
							// echo '</div>';//.col-xs-12 .col-md-8

						echo '</div>';//.timeline-centered
						
					//データベースから切断
					$dbh = null;
					}
				?>	
			</div>
		</div><!-- /row -->
	</div> <!-- /container -->

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/my-scroll.js"></script>
</body>
</html>