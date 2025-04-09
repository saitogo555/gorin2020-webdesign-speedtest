<?php
// データベース接続情報
$host = "mariadb";
$dbname = "compe2020";
$username = "web";
$password = "0202nesoy";

try {
  // PDOでデータベースに接続
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

  // エラーモードを例外に設定(オプション)
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sampleテーブルからデータを取得するクエリを実行
  $stmt = $pdo->prepare("SELECT * FROM sample");
  $stmt->execute();

  // 結果を取得
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // エラーが発生した場合はエラーメッセージを表示
  echo "エラー: " . $e->getMessage();
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>4. DB接続</title>
</head>

<body>
  <h1>サンプルデータ一覧</h1>
  <table border="">
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>年齢</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?php echo htmlspecialchars($row["id"]); ?></td>
          <td><?php echo htmlspecialchars($row["name"]); ?></td>
          <td><?php echo htmlspecialchars($row["age"]); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>