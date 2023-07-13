<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHPの基本</title>
  <link rel="stylesheet" href="../CSSsample.css">
</head>
<body>
  <h2>変数と文字列</h2>
  <?php
    $age = 18;
    $name = '仙台太郎';
    print( $age );
    print( $name );

    $renketsu = '<p>名前：' . $name . "<br>年齢：" . $age . "</p>";
    print($renketsu);
  ?>

  <h2>配列</h2>
  <?php
    $fruit = array('リンゴ', 'みかん', 'バナナ');
    print( $fruit[0] );
  ?>

  <h3>for文の利用</h3>
  <ul>
    <?php 
      for($i = 0; $i < 3; $i++ )
        print("<li>{$fruit[$i]}</li>");
    ?>
  </ul>

  <h3>連想配列</h3>
  <p>
    <?php 
      $shohin = array('id' => 1, 'shohin_mei' => 'えんぴつ');
      printf("ID：%d は %sです。", $shohin['id'], $shohin['shohin_mei']);
    ?>
  </p>

  <h2>フォーム</h2>
  <h3>1行テキスト入力ボックス</h3>
  <p>
    <form action="form01.php" method="post">
      <label>氏名：<input type="text" size="20" name="shimei"></label>
      <input type="submit" value="送信">
    </form>
  </p>

  <h3>プルダウンメニュー</h3>
  <form action="form02.php" method="GET">
    <p>
      好きな科目：
      <select name="kamoku">
        <?php
          $kamoku_mei = array('国語', '算数', '理科');
          for($i=0; $i < 3; $i++) {
            printf('<option value="%d">%s</option>', $i, $kamoku_mei[$i]);
          }
        ?>
      </select>
      <input type="submit" value="送信">
    </p>  
  </form>
</body>
</html>