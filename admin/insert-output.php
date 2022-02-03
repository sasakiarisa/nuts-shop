<?php 
session_start();
require '../header.php'; 

if( isset($_POST['token']) && 
 $_POST['token'] == $_SESSION['token']){

	//トークンが正しいときにやることを書く
}else{
	//トークンが不正なときの処理
}


?>
<?php
require 'connect.php';
$sql=$pdo->prepare('insert into product values(null, ?, ?)');
if ($sql->execute([$_REQUEST['name'], $_REQUEST['price']])) {
	echo '追加に成功しました。';
} else {
	echo '追加に失敗しました。';
}
?>
<?php require '../footer.php'; ?>
