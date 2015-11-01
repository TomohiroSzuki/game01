<?php
	if(!isset($_SESSION)){
		session_start();
	}
	if(!empty($_POST["player1"])){
		$_SESSION = array();
		$_SESSION['player1'] = $_POST['player1'];
		$_SESSION['number1'] = $_POST['number1'];
		$_SESSION['player2'] = $_POST['player2'];
		$_SESSION['number2'] = $_POST['number2'];
		$_SESSION['round'] = $_POST['round'];
		$_SESSION['nowround'] = 1;
		$_SESSION['syouhai'] = "";
		$_SESSION['cpuflag'] = $_POST['cpuflag'];
		$_SESSION['cpucount'] = 1;
	}

	//ターンの確認
	if(empty($_SESSION['turn'])){
		$_SESSION['turn'] = "p1";
	}else if ($_SESSION['turn'] == "p1"){	//p1の予想とp2の答えを一文字ずつに分割
		if(!empty($_POST['p1ans'])){
			$answer = $_POST['p1ans'];
			$p1ans1 = substr($answer, 0, 1);
			$p1ans2 = substr($answer, 1, 1);
			$p1ans3 = substr($answer, 2, 1);
			//$p1ans4 = substr($answer, 3, 1);
			$p2num1 = substr($_SESSION['number2'], 0, 1);
			$p2num2 = substr($_SESSION['number2'], 1, 1);
			$p2num3 = substr($_SESSION['number2'], 2, 1);
			//$p2num4 = substr($_SESSION['number2'], 3, 1);
			$perfect = 0;
			$ok = 0;
			if ($p1ans1 == $p2num1) {$perfect++ ;}
			if ($p1ans2 == $p2num2) {$perfect++ ;}
			if ($p1ans3 == $p2num3) {$perfect++ ;}
			//if ($p1ans4 == $p2num4) {$perfect++ ;}	
			if ($p1ans1 == $p2num2 || $p1ans1 == $p2num3 || $p1ans1 == $p2num4 ) {$ok++ ;}
			if ($p1ans2 == $p2num1 || $p1ans2 == $p2num3 || $p1ans2 == $p2num4 ) {$ok++ ;}
			if ($p1ans3 == $p2num1 || $p1ans3 == $p2num2 || $p1ans3 == $p2num4 ) {$ok++ ;}
			//if ($p1ans4 == $p2num1 || $p1ans4 == $p2num2 || $p1ans4 == $p2num3 ) {$ok++ ;}
			$nothing = 3 - $perfect - $ok;
			$_SESSION['p1ans'][$_SESSION['nowround']] = $answer;
			$_SESSION['p1per'][$_SESSION['nowround']] = $perfect;
			$_SESSION['p1ok'][$_SESSION['nowround']] = $ok;
			$_SESSION['p1no'][$_SESSION['nowround']] = $nothing;

			//cpu対戦時の数字生成
			if($_SESSION['cpuflag']=="OFF"){
				$_SESSION['turn'] = "p2";
			}else if($_SESSION['cpuflag']=="ON"){
				if($_SESSION['cpucount'] == 1){
						$p2ans1=(mt_rand(1,4));
						$p2ans2=0;
						$p2ans3=0;
						$p2ans4=0;
						do{
							$p2ans2 = (mt_rand(1,4));
						}while($p2ans1 == $p2ans2);
						do{
							$p2ans3 = (mt_rand(1,4));
						}while($p2ans1 == $p2ans3 || $p2ans2 == $p2ans3);
						do{
							$p2ans4 = (mt_rand(1,4));
						}while($p2ans1 == $p2ans4 || $p2ans2 == $p2ans4 || $p2ans3 == $p2ans4);
						$p2ans = $p2ans1*1000+$p2ans2*100+$p2ans3*10+$p2ans4;
						if(strlen((string)$p2ans) != 4){
							$p2ans = sprintf("%04d",$p2ans);
						}
				}else if($_SESSION['cpucount'] == 2){
					$p2ans1=(mt_rand(5,8));
					$p2ans2=0;
					$p2ans3=0;
					$p2ans4=0;
					do{
						$p2ans2 = (mt_rand(5,8));
					}while($p2ans1 == $p2ans2);
					do{
						$p2ans3 = (mt_rand(5,8));
					}while($p2ans1 == $p2ans3 || $p2ans2 == $p2ans3);
					do{
						$p2ans4 = (mt_rand(5,8));
					}while($p2ans1 == $p2ans4 || $p2ans2 == $p2ans4 || $p2ans3 == $p2ans4);
					$p2ans = $p2ans1*1000+$p2ans2*100+$p2ans3*10+$p2ans4;
					if(strlen((string)$p2ans) != 4){
						$p2ans = sprintf("%04d",$p2ans);
					}
				}else if($_SESSION['cpucount']>=3){
						$p2ans1=(mt_rand(0,9));
						$p2ans2=0;
						$p2ans3=0;
						$p2ans4=0;
						do{
							$p2ans2 = (mt_rand(0,9));
						}while($p2ans1 == $p2ans2);
						do{
							$p2ans3 = (mt_rand(0,9));
						}while($p2ans1 == $p2ans3 || $p2ans2 == $p2ans3);
						do{
							$p2ans4 = (mt_rand(0,9));
						}while($p2ans1 == $p2ans4 || $p2ans2 == $p2ans4 || $p2ans3 == $p2ans4);
						$p2ans = $p2ans1*1000+$p2ans2*100+$p2ans3*10+$p2ans4;
						if(strlen((string)$p2ans) != 4){
							$p2ans = sprintf("%04d",$p2ans);
						}
				}
				$answer = $p2ans;
				$p2ans1 = substr($answer, 0, 1);
				$p2ans2 = substr($answer, 1, 1);
				$p2ans3 = substr($answer, 2, 1);
				//$p2ans4 = substr($answer, 3, 1);
				$p1num1 = substr($_SESSION['number1'], 0, 1);
				$p1num2 = substr($_SESSION['number1'], 1, 1);
				$p1num3 = substr($_SESSION['number1'], 2, 1);
				//$p1num4 = substr($_SESSION['number1'], 3, 1);
				$perfect = 0;
				$ok = 0;
				if ($p2ans1 == $p1num1) {$perfect++ ;}
				if ($p2ans2 == $p1num2) {$perfect++ ;}
				if ($p2ans3 == $p1num3) {$perfect++ ;}
				//if ($p2ans4 == $p1num4) {$perfect++ ;}
				if ($p2ans1 == $p1num2 || $p2ans1 == $p1num3 || $p2ans1 == $p1num4 ) {$ok++ ;}
				if ($p2ans2 == $p1num1 || $p2ans2 == $p1num3 || $p2ans2 == $p1num4 ) {$ok++ ;}
				if ($p2ans3 == $p1num1 || $p2ans3 == $p1num2 || $p2ans3 == $p1num4 ) {$ok++ ;}
				//if ($p2ans4 == $p1num1 || $p2ans4 == $p1num2 || $p2ans4 == $p1num3 ) {$ok++ ;}
				$nothing = 3 - $perfect - $ok;
				$_SESSION['p2ans'][$_SESSION['nowround']] = $answer;
				$_SESSION['p2per'][$_SESSION['nowround']] = $perfect;
				$_SESSION['p2ok'][$_SESSION['nowround']] = $ok;
				$_SESSION['p2no'][$_SESSION['nowround']] = $nothing;

				if($_SESSION['p2no'][1]!=0){
					$_SESSION['cpucount']++;
				}
				if($_SESSION['nowround']==2&&$_SESSION['cpucount']==2){
					if($_SESSION['p2no'][2]!=0){
					$_SESSION['cpucount']++;
					}
				}

				//勝敗の確認
				if ($_SESSION['p1per'][$_SESSION['nowround']] == 3 && $_SESSION['p2per'][$_SESSION['nowround']] == 3) {
					$p1shouhai = "DRAW";
					$p2shouhai = "DRAW";
					$_SESSION['turn'] = "end";
				}else if ($_SESSION['p1per'][$_SESSION['nowround']] == 3 ) {
					$p1shouhai = "WIN";
					$p2shouhai = "LOSE";
					$_SESSION['syouhai'] = "p1";
					$_SESSION['turn'] = "end";
				}else if ($_SESSION['p2per'][$_SESSION['nowround']] == 3 ) {
					$p1shouhai = "LOSE";
					$p2shouhai = "WIN";
					$_SESSION['syouhai'] = "p2";
					$_SESSION['turn'] = "end";
				}else if ($_SESSION['round'] == $_SESSION['nowround']) {
					$p1shouhai = "DRAW";
					$p2shouhai = "DRAW";
					$_SESSION['turn'] = "end"; 
				}else {
					$_SESSION['turn'] = "p1";
					$_SESSION['nowround']++ ;
				}
			}
		}
	}else if($_SESSION['turn'] == "p2"){
		if(!empty($_POST['p2ans'])){
			$answer = $_POST['p2ans'];
			$p2ans1 = substr($answer, 0, 1);
			$p2ans2 = substr($answer, 1, 1);
			$p2ans3 = substr($answer, 2, 1);
			//$p2ans4 = substr($answer, 3, 1);
			$p1num1 = substr($_SESSION['number1'], 0, 1);
			$p1num2 = substr($_SESSION['number1'], 1, 1);
			$p1num3 = substr($_SESSION['number1'], 2, 1);
			//$p1num4 = substr($_SESSION['number1'], 3, 1);
			$perfect = 0;
			$ok = 0;
			if ($p2ans1 == $p1num1) {$perfect++ ;}
			if ($p2ans2 == $p1num2) {$perfect++ ;}
			if ($p2ans3 == $p1num3) {$perfect++ ;}
			//if ($p2ans4 == $p1num4) {$perfect++ ;}
			if ($p2ans1 == $p1num2 || $p2ans1 == $p1num3 || $p2ans1 == $p1num4 ) {$ok++ ;}
			if ($p2ans2 == $p1num1 || $p2ans2 == $p1num3 || $p2ans2 == $p1num4 ) {$ok++ ;}
			if ($p2ans3 == $p1num1 || $p2ans3 == $p1num2 || $p2ans3 == $p1num4 ) {$ok++ ;}
			//if ($p2ans4 == $p1num1 || $p2ans4 == $p1num2 || $p2ans4 == $p1num3 ) {$ok++ ;}
			$nothing = 3 - $perfect - $ok;
			$_SESSION['p2ans'][$_SESSION['nowround']] = $answer;
			$_SESSION['p2per'][$_SESSION['nowround']] = $perfect;
			$_SESSION['p2ok'][$_SESSION['nowround']] = $ok;
			$_SESSION['p2no'][$_SESSION['nowround']] = $nothing;

			//勝敗の確認
			if ($_SESSION['p1per'][$_SESSION['nowround']] == 3 && $_SESSION['p2per'][$_SESSION['nowround']] == 3) {
				$p1shouhai = "DRAW";
				$p2shouhai = "DRAW";
				$_SESSION['turn'] = "end";
			}else if ($_SESSION['p1per'][$_SESSION['nowround']] == 3) {
				$p1shouhai = "WIN";
				$p2shouhai = "LOSE";
				$_SESSION['syouhai'] = "p1";
				$_SESSION['turn'] = "end";
			}else if ($_SESSION['p2per'][$_SESSION['nowround']] == 3) {
				$p1shouhai = "LOSE";
				$p2shouhai = "WIN";
				$_SESSION['syouhai'] = "p2";
				$_SESSION['turn'] = "end";
			}else if ($_SESSION['round'] == $_SESSION['nowround']) {
				$p1shouhai = "DRAW";
				$p2shouhai = "DRAW";
				$_SESSION['turn'] = "end"; 
			}else {
				$_SESSION['turn'] = "p1";
				$_SESSION['nowround']++ ;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
	<meta charset="utf-8">
		<title>数当てゲーム</title>
		<link rel="stylesheet" href="game.css">
	</head>
	<body  onLoad="Cursorpos('<?php echo $_SESSION['turn']?>')">
	<h1>数当てゲーム</h1>
		<form action="game.php" method="post" name="form">
			<div class="playerboth">
				<div class="player1">
					<table>
						<tr>
							<th colspan = "5"><?php echo $_SESSION["player1"]?></th>
						</tr>
						<tr>
							<th colspan="2">秘密の数字</th>
							<th colspan="3">
								<?php 
									//ゲーム続行中秘密の数字を非表示にする
									if($_SESSION['turn'] == "end"){
										echo $_SESSION['number1'];
									}else{
										echo "???";
									}
								?>
							</th>
						</tr>
						<tr>
							<th>スコア</th>
							<th>数字</th>
							<th style="font-size:24px">◎</th>
							<th>○</th>
							<th>×</th>
						</tr>
						<?php
							for ($i = 1; !empty($_SESSION['p1ans'][$i]) ; $i++) {
								$p1ans = $_SESSION['p1ans'][$i];
								$p1per = $_SESSION['p1per'][$i];
								$p1ok = $_SESSION['p1ok'][$i];
								$p1no = $_SESSION['p1no'][$i];
								echo <<<EOT
								<tr>
									<th>$i 回戦</th>
									<td>$p1ans</td>
									<td>$p1per</td>
									<td>$p1ok</td>
									<td>$p1no</td>
								</tr>
EOT;

							}
						?>
						<tr>
							<th colspan="5" height="30px">
								<?php 
									if(!empty($p1shouhai)){
										echo $p1shouhai;
									}
								?>
							</th>
						</tr>
						<tr>
							<th colspan="5">
								<p>相手の数字を推測し<br>数字を入力してくさい</p>
								<input type="text" id="p1ans" name="p1ans" maxlength="4"><br>
								<input type="button" name="numreqest" value="これでも食らえ!!" onclick="topkakunin('p1ans','<?php echo $_SESSION['turn']?>','p1')"><br>
								<input type="button" value="秘密の数字を忘れた" style="width:150px" onclick="foget('<?php echo $_SESSION['number1']?>')">
							</th>
						</tr>
					</table>
				</div>
				<div class="player2">
					<table>
						<tr>
							<th colspan="5"><?php echo $_SESSION["player2"]?></th>
						</tr>
						<tr>
							<th colspan="2">秘密の数字</th>
							<th colspan="3">
								<?php
									//ゲーム続行中秘密の数字を非表示にする
									if($_SESSION['turn'] == "end"){
										echo $_SESSION['number2'];
									}else{
										echo "???";
									}
								?>
							</th>
						</tr>
						<tr>
							<th>スコア</th>
							<th>数字</th>
							<th style="font-size:24px">◎</th>
							<th>○</th>
							<th>×</th>
						</tr>
							<?php
								for ($i = 1; !empty($_SESSION['p2ans'][$i]) ; $i++) {
									$p2ans = $_SESSION['p2ans'][$i];
									$p2per = $_SESSION['p2per'][$i];
									$p2ok = $_SESSION['p2ok'][$i];
									$p2no = $_SESSION['p2no'][$i];
									echo <<<EOT
									<tr>
										<th>$i 回戦</th>
										<td>$p2ans</td>
										<td>$p2per</td>
										<td>$p2ok</td>
										<td>$p2no</td>
									</tr>
EOT;
								}
							?>
						<tr>
							<th colspan="5" height="30px">
								<?php
									if(!empty($p2shouhai)){
										echo $p2shouhai;
									}
								?>
							</th>
						</tr>
						<tr>
							<th colspan="5">
								<p>相手の数字を推測し<br>数字を入力してくさい</p>
								<input type="text" id="p2ans" name="p2ans" value="" maxlength="4"><br>
								<input type="button" name="numreqest" value="これでも食らえ!!" onclick="topkakunin('p2ans','<?php echo $_SESSION['turn']?>','p2')"><br>
								<input type="button" value="秘密の数字を忘れた" style="width:150px" onclick="foget('<?php echo $_SESSION['number2']?>')">
							</th>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<h2><?php 
			if($_SESSION['turn'] == "p1"){
				echo ($_SESSION["player1"]);
				echo "のターン";
			}else if($_SESSION['turn'] == "p2"){
				echo ($_SESSION["player2"]);
				echo "のターン";
			}else{
				echo("終了！\n");
				if($_SESSION['syouhai'] == "p1"){
					echo ($_SESSION['player1']);echo"の勝利！！";
				}else if($_SESSION['syouhai'] == "p2"){
					echo ($_SESSION['player2']);echo"の勝利！！";
				}else{
					echo "引き分け";
				}
			}
			?>
		</h2>
		<h3>(<?php echo $_SESSION['nowround'];?>/<?php echo $_SESSION['round'];?>回戦目)</h3>
		<form class="restart" action="top.html" method="post" accept-charset="utf-8">
			<input type="submit" name="sousin" value="はじめから">
		</form>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="game.js">
		</script>
	</body>
</html>
<!--
	ゲームフロー
	top.htmlで受け取った情報をgame.php内の変数に保存
	game.phpで入力された数字をgame.phpに送る
	答えた数字と相手の数字を比較
	得られた各情報ほ新しい行に追加
	次のプレイヤーのターンに移る
-->