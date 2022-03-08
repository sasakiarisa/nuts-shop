 <style> 
  /* アコーディオンメニュー全体のサイズ・位置 */
.ac {
  width: 60%;
  max-width: 600px;
  margin: 0 auto;
}

/* クリック領域 */
.ac-parent {
  height: 50px;
  border-bottom: 1px solid #fff;
  background-color: #07780bb8;
  color: #fff;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
}

/* クリックしたら表示される領域 */
.ac-child {
  display: none;
  padding: 2em 1em;
  background-color: #07780b73;
  text-align: center;
}
</style>

<?php session_start();?>
<?php require '../header.php';?>
<?php require 'menu.php';?>
<?php
$id=$_REQUEST['id'];
if (!isset($_SESSION['product'])) {
   $_SESSION['product']=[];
}
$count=0;
if (isset($_SESSION['product'][$id])) {
  $count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[
  'name'=>$_REQUEST['name'],
  'price'=>$_REQUEST['price'],
  'count'=>$count+$_REQUEST['count']
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
?>


<dl class="ac">
    <dt class="ac-parent">サイズについて</dt>
    <dd class="ac-child">サイズについて
古着のサイズは表記サイズではなく、必ず実寸をご参照ください。表記サイズはメーカー・ブランド・服の作られた時代によって実寸とイメージは異なります。実寸は商品詳細ページの商品説明文の下に記載されております。</dd>
    <dt class="ac-parent">サイズについて</dt>
    <dd class="ac-child">メニューの中身</dd>
    <dt class="ac-parent">メニュー</dt>
    <dd class="ac-child">メニューの中身</dd>
    <dt class="ac-parent">メニュー</dt>
    <dd class="ac-child">メニューの中身</dd>
  </dl>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
   	
     $(function () {
    $('.ac-parent').on('click', function () {
    $(this).next().slideToggle(500);
  });
});

    </script>

<?php require '../footer.php';?>
