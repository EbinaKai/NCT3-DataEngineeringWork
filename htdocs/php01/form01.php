<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>1行テキスト受け取り</title>
  <link rel="stylesheet" href="../CSSsample.css">
</head>
<body>
  <h1>1行テキスト受け取り</h1>
  <p>
    氏名：
    <?php print(htmlspecialchars($_POST['shimei'], ENT_QUOTES)); ?>
  </p>
  <p>
    <a href="php_sample.php">戻る</a>
  </p>
</body>
</html>