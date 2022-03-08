<?php
require 'connect.php';

$sql=$pdo->prepare("
		select count(*) from customer 
		where login=?");
	$sql->execute([$_REQUEST['login']]);
 //  ※同じログイン名があるかないか(重複不許可のため)

// var_dump($sql->fetch()['count(*)']);
// exit;

if ( $sql->fetch()['count(*)'] > 0 ) {
	//作ろうとしてる(変更しようとしてる)ログイン名があれば変える
	echo '⚠ログイン名がすでに使用されていますので、変更してください。';

}