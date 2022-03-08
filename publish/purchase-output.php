<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
require 'connect.php';

$purchase_id=1;
// A_I と同じことをやってる
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1;
}

try{

//トランザクションの開始
$pdo->beginTransaction();
$sql=$pdo->prepare(
	'INSERT INTO purchase(id, customer_id) VALUE(?,?)'
);// ↑このフィールド名が必要

$success = $sql->execute([
	         $purchase_id,
					 $_SESSION['customer']['id']
]);

if ($success){
	//$purchase_id=$sql->lastInsertId(); 	A_Iで登録されたidの取得


/*
一行実行のINSERT文は非効率なので一回のINSERTで複数行の注文を入れたい
valuesの後ろの()をカンマ区切りでt投げて作るが難しいので今はやらない
*/
	foreach ($_SESSION['product'] as $product_id=>$product) {

		$sql=$pdo->prepare(
			'insert into purchase_detail values(?,?,?)'
		);
		$sql->execute([
			$purchase_id, 
			$product_id, 
			$product['count']]
		);
	}

	$pdo->commit();
	// カートをカラにする
	unset($_SESSION['product']);
	echo '購入手続きが完了しました。ありがとうございます。';
 
}//elseはいらない

 }catch(PDOException $e){
	echo $e->getMessage();//(8)エラーメッセージを出力
	echo '購入手続き中にエラーが発生しました。申し訳ございません。';
	$pdo->rollBack();//(9)ロールバック

}
?>
<?php require '../footer.php'; ?>
