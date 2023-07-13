<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>科目テーブル</title>
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
    }

    if (isset($_POST["add_kmei"])) {
      $add_kmei = htmlspecialchars($_POST['add_kmei']);
      $query = "INSERT INTO kamoku_t (kamoku_mei) VALUES ('{$add_kmei}')";
      mysqli_query($db, $query);
    } else if (isset($_GET['del_kid'])) {
      $del_kid = htmlspecialchars($_GET['del_kid']);
      $query = "DELETE FROM kamoku_t WHERE kamoku_id = {$del_kid}";
      mysqli_query($db, $query);
    }

    mysqli_set_charset($db, 'utf-8');
  ?>
  <h1>科目テーブルの編集</h1>
  <p>
    <form action="edit_kamoku_t.php" method="post">
      <label>
        氏名：
        <input type="text" size="30" name="add_kmei">
      </label>
      <input type="submit" value="追加">
    </form>
  </p>
  <table>
    <tr>
      <th>科目名</th>
      <th>削除</th>
      <th>変更</th>
    </tr>

    <?php 
      $recordSet = mysqli_query($db, 'SELECT * FROM kamoku_t');
      while ($data = mysqli_fetch_assoc( $recordSet )): 
        $kamoku_id = $data['kamoku_id'];
        $kamoku_mei = $data['kamoku_mei'];

        $del_url = "edit_kamoku_t.php?del_kid={$kamoku_id}";
        $up_url = "update_kamoku_t.php?up_kid={$kamoku_id}&up_kmei={$kamoku_mei}";
    ?>
    <tr>
      <td><?= $data['kamoku_mei']; ?></td>
      <td><a href="<?= $del_url?>">削除</a></td>
      <td><a href="<?= $up_url?>">変更</a></td>
    </tr>
    <?php endwhile; ?>
  </table>

  <p>
    <a href="index.php">戻る</a>
  </p>
</body>
</html>