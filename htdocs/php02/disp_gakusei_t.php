<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>学生テーブル</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <?php
    $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
    if ($db == FALSE) {
      exit('データベースに接続できませんでした。');
    } else {
      print('データベースに接続しました。');
    }

    mysqli_set_charset($db, 'utf-8');

    $recordSet = mysqli_query($db, 'SELECT * FROM gakusei_t');
  ?>
  <table>
    <tr>
      <th>ID</th>
      <th>氏名</th>
    </tr>
    <?php while ($data = mysqli_fetch_assoc( $recordSet )): ?>
    <tr>
      <td><?= $data['gakusei_id']; ?></td>
      <td><?= $data['gakusei_mei']; ?></td>
    </tr>
    <?php endwhile; ?>
  </table>

  <p>
    <a href="index.html">戻る</a>
  </p>
</body>
</html>