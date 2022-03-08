<?php require '../header.php'; ?>
<div class="row">
  <aside>
    <?php require 'sidebar.php'; ?>
  </aside>
  <main>
    <h2>商品名を入力してください。</h2>
    <form action="search-output.php" method="post">
      <input type="text" name="keyword">
      <input type="submit" value="検索">
    </form>
  </main>  
</div>
  

  <?php require '../footer.php'; ?>
