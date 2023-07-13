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
    }

    if (isset($_POST["add_gmei"])) {
      $add_gmei = htmlspecialchars($_POST['add_gmei']);
      $query = "INSERT INTO gakusei_t (gakusei_mei) VALUES ('{$add_gmei}')";
      mysqli_query($db, $query);
    } else if (isset($_GET['del_gid'])) {
      $del_gid = htmlspecialchars($_GET['del_gid']);
      $query = "DELETE FROM gakusei_t WHERE gakusei_id = {$del_gid}";
      mysqli_query($db, $query);
    }

    mysqli_set_charset($db, 'utf-8');
  ?>

  <p>
    <form action="edit_gakusei_t.php" method="post">
      <label>
        氏名：
        <input type="text" size="30" name="add_gmei">
      </label>
      <input type="submit" value="追加">
    </form>
  </p>
  <table>
    <tr>
      <th>氏名</th>
      <th>削除</th>
      <th>変更</th>
    </tr>

    <?php 
      $recordSet = mysqli_query($db, 'SELECT * FROM gakusei_t');
      while ($data = mysqli_fetch_assoc( $recordSet )): 
        $gakusei_id = $data['gakusei_id'];
        $gakusei_mei = $data['gakusei_mei'];

        $del_url = "edit_gakusei_t.php?del_gid={$gakusei_id}";
        $up_url = "update_gakusei_t.php?up_gid={$gakusei_id}&up_gmei={$gakusei_mei}";
    ?>
    <tr>
      <td><?= $data['gakusei_mei']; ?></td>
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