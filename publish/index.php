<?php require '../header.php'; ?>

<?php require 'menu.php'; ?>
<div class="result"></div>
<?php require 'product.php'; ?>
<?php require '../footer.php'; ?>

<!-- ここから -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<!-- 先にjqueryを読み込み -->
<script>
  $(function(){
    
        $.ajax({
            url: '/slider/top.html',
           /* スライダーのフルパス */
            dataType: 'html', //受け取るデータの型
            
        }).done(function(res){
            /* 通信成功時 */
            $('.result').html(res); //取得したHTMLを.resultに反映
            
        }).fail(function(res){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });

</script>

