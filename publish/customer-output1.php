<?php session_start();?>
<?php require '../header.php';?>
<?php require 'menu.php';?>
<?php
require 'connect.php';

$sql=$pdo->prepare('
		select count(*) from customer 
		where login=?');
	$sql->execute([$_REQUEST['login']]);
 //  ※同じログイン名があるかないか(重複不許可のため)

// var_dump($sql->fetch()['count(*)']);
// exit;

if ( $sql->fetch()['count(*)'] == 0 ) {
	//作ろうとしてる(変更しようとしてる)ログイン名がない場合
		if (isset($_SESSION['customer'])) {
			$id = $_SESSION['customer']['id'];

				$sql=$pdo->prepare(
					'	UPDATE customer set 
							 name=?, 
							 address=?,
							 login=?,
							 email=?,
							 password=?
						WHERE id=?');
			// 既存顧客情報の上書き
				$sql->execute([   // ?の数だけ書く
							$_REQUEST['name'],
							$_REQUEST['address'],
							$_REQUEST['login'],
							$_REQUEST['email'],
							$_REQUEST['password'],
							$id]
						);
				//ログインセッションに値を代入		
				$_SESSION['customer']=[
					'id'=>$id, //配列全体が上書きされるので
					'name'=>$_REQUEST['name'],
					'address'=>$_REQUEST['address'],
					'login'=>$_REQUEST['login'],
					'email'=>$_REQUEST['email'],
					'password'=>$_REQUEST['password']
				];
				echo 'お客様情報を更新しました。';
				//既存ユーザの処理は終わり

		} else {
				// ログインしていないユーザーの登録処理
					$sql=$pdo->prepare('
						insert into customer values(null,?,?,?,?,?)');
					$sql->execute([
								$_REQUEST['name'],
								$_REQUEST['address'],
								$_REQUEST['email'],
								$_REQUEST['login'],
								$_REQUEST['password']
							]);
					echo 'お客様情報を登録しました。';
		}
} else {
    echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>

<?php require "../footer.php";?>

