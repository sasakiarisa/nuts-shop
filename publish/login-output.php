<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'connect.php';?>

<?php
unset($_SESSION['customer']);?>

<?php
$sql=$pdo->prepare(
  'SELECT * from customer 
   where login=? ');
$sql->execute([ $_REQUEST['login'] ]);

foreach ($sql as $row) {
  //$row は行データ loginで選択したので1行しかない
  if( password_verify( $_REQUEST['password'] 
  , $row['password'] ) ){
        //↑ DBのフィールド名 $y$p...ハッシュ値
  // trueならセッションに入れる(ログインしたことになる)     
     $_SESSION['customer']=[
       'id'=>$row['id'],
       'name'=>$row['name'],
       'address'=>$row['address'],
       'email'=>$row['email'],  // ←追加
       'login'=>$row['login'],
      ];   //パスワードは消してください
  } // end if
}

 if (isset($_SESSION['customer'])) {
   echo 'いらっしゃいませ、',
        $_SESSION['customer']['name'], 'さん。
        <meta http-equiv="refresh" content="1;URL=./">
        ';
        
} else {
    echo 'ログイン名またはパスワードが違います。';
}
?>

<?php require "../footer.php";?>
