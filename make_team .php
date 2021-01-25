<!DOCTYPE html>
<html>
<head>
</head>
    <body>
<?php 
////データベース接続
  $dsn = 'mysql:dbname=tb221012db;host=localhost';
  $user = 'tb-221012';
  $password = 'F3zNBDApXe';
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  //テーブル作成
  $sql = "CREATE TABLE IF NOT EXISTS mission6"
  ." ("
  . "id INT AUTO_INCREMENT PRIMARY KEY,"
  . "team_name TEXT,"
  . "email TEXT,"
  . "password TEXT"
  .");";
  $stmt = $pdo->query($sql);
  
  //4-3 テーブル一覧を表示
  $sql ='SHOW TABLES';
  $result = $pdo -> query($sql);
  foreach ($result as $row){
          echo $row[0];
          echo '<br>';
  }
  echo "<hr>";

$team_name = $_POST['team_name'];
$email = $_POST['email'];
$password = $_POST['password'];

//フォームの条件が揃っていた場合の処理
if(!empty($team_name) && !empty($email) &&!empty($password)){
    $sql = $pdo -> prepare("INSERT INTO mission6 (team_name,email,password) VALUES (:team_name, :email,:password)");
	$sql -> bindParam(':team_name', $team_name, PDO::PARAM_STR);
	$sql -> bindParam(':email', $email, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
	$sql -> execute();
    echo "登録しました!!"."<br>";
}
else{
    echo "フォームの条件を満たしたください"."<br>";
}
    

//作成したテーブルの構成要素を確認する
  $sql ='SHOW CREATE TABLE mission6';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
	
	//データレコードを抽出し、表示する
	$sql = 'SELECT * FROM mission6';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['team_name'].',';
		echo $row['email'].',';
		echo $row['password'].'<br>';
	echo "<hr>";
	}

?>
<form method="post" action="">
    <p>チームネーム</p>
   <input type="text" name="team_name" placeholder ="チームネーム"><br>
   <p>確認用メールアドレス</p>
   <input type="email" name="email"placeholder = "メールアドレス"><br>
   <p>チーム共有パスワード（チームメンバーの参加時に必要です）</p>
   <input type="password" name="password" placeholder="パスワード"><br>
   <input type="submit" value="チームを作成する">
</form>
 </body>
</html>