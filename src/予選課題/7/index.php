<?php
// GETパラメータ numを取得
$num = isset($_GET["num"]) ? intval($_GET["num"]) : null;

// メッセージを初期化
$message = "";

// 条件に基づいてメッセージを設定
if ($num !== null) {
  if ($num > 50) {
    $message = "大きすぎます";
  } elseif ($num < 50) {
    $message = "小さすぎます";
  } else {
    $message = "50です";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>7. 数値チェック</title>
</head>

<body>
  <h1>数値チェック</h1>

  <?php if ($num !== null): ?>
    <p>入力値: <?php echo htmlspecialchars($num); ?></p>
    <p>結果: <?php echo htmlspecialchars($message); ?></p>
  <?php else: ?>
    <p>URLのGETパラメータに「num」を指定してください。</p>
  <?php endif; ?>

  <form method="get">
    <label for="num">数値を入力:</label>
    <input type="number" name="num" id="num" value="<?php echo htmlspecialchars($num ?? ""); ?>">
    <button type="submit">チェック</button>
  </form>
</body>

</html>