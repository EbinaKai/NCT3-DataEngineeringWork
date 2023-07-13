<?php
  $kamoku_mei = array('国語', '算数', '理科');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>プルダウンメニュー受け取り</title>
  <link rel="stylesheet" href="../CSSsample.css">
</head>
<body>
  <h1>プルダウンメニュー受け取り</h1>
  <p>
    好きな科目：
    <?php print(htmlspecialchars($kamoku_mei[$_GET['kamoku']], ENT_QUOTES)); ?>
  </p>
  <p>
    <a href="php_sample.php">戻る</a>
  </p>
</body>
</html>