<?php
include_once '../header.php'; 
require 'connect.php';


?>

<div class="row">
  <aside>
    <?php require 'sidebar.php'; ?>
  </aside>
  <main>

<?php
if(empty($_GET['id'])) exit("<p>注文番号がありません!");

$sql = "SELECT purchase_id ,product_id, name
, count, price, count * price AS shokei
	FROM `purchase_detail` AS d
	LEFT JOIN purchase AS p ON purchase_id = p.id
	LEFT JOIN product as s ON product_id = s.id
	WHERE custmor_id = ?";

//サニタイズする
$id = htmlspecialchars($_GET['id'],ENT_QUOTES);
  
$sql_purchase = $pdo->prepare( $sql );

  //セキュリティ的に推奨されるSQL文の実行方法
$sql_purchase->bindValue(1, $id, PDO::PARAM_INT);
//バインド機構は危険な文字列の除去を行い実行されたSQL分に後追いで値を埋め込む
$sql_purchase->execute();

?>
<h2>注文詳細</h2>
<table>
   <tr>
      <th>商品番号</th><th>顧客名</th><th>合計金額</th><th>日付</th>
    <th>個数</th><th>小計</th>
  </tr>

  <?php
  foreach ($sql_purchase as $row_detail) {
    ?>

<tr>
      <td><?=$row_detail['product_id']?></td>
      <td><?=$row_detail['name']?></td>
      <td><?=$row_detail['price']?></td>
      <td><?=$row_detail['count']?></td>
      <td><?=$row_detail['shokei']?></td>
    </tr>
<?php } ?>
  
     </table>
   </main>
  </div>
  <?php require '../footer.php'; ?>

	