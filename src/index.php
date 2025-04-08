<?php
// ドキュメントルートを取得
$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);

// パスパラメータの処理
if (isset($_GET['path'])) {
  // URLデコード
  $requestedPath = urldecode($_GET['path']);

  // パスの正規化 - スラッシュを適切に処理
  $requestedPath = '/' . trim($requestedPath, '/');

  // ドキュメントルートと結合して絶対パスを作成
  $absolutePath = $docRoot . $requestedPath;

  // 存在チェックと安全性チェック
  if (
    file_exists($absolutePath) && is_dir($absolutePath) &&
    strpos(realpath($absolutePath), $docRoot) === 0
  ) {
    $path = realpath($absolutePath);
  } else {
    // 不正なパスの場合はルートに戻す
    $path = $docRoot;
  }
} else {
  // パラメータがない場合はルートを使用
  $path = $docRoot;
}

// 相対パス（表示用と次のリンク用）の作成
$relativePath = str_replace($docRoot, '', $path);
$relativePath = '/' . ltrim($relativePath, '/');

// ディレクトリの内容を取得
$items = scandir($path);

// 自然順ソートを適用（1, 2, 3, ..., 10, 11, 12という順序）
natsort($items);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ファイル一覧 - <?php echo htmlspecialchars($relativePath); ?></title>
  <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --accent: #4895ef;
      --background: #f8f9fa;
      --card: #ffffff;
      --text-primary: #212529;
      --text-secondary: #495057;
      --text-muted: #6c757d;
      --folder: #f9c74f;
      --file: #4895ef;
      --success: #4cc9f0;
      --danger: #f72585;
      --border-radius: 12px;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      font-family: 'Segoe UI', 'Roboto', system-ui, -apple-system, sans-serif;
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      background-color: var(--background);
      color: var(--text-primary);
      line-height: 1.6;
    }

    h1 {
      border-bottom: 2px solid #e9ecef;
      padding-bottom: 1rem;
      color: var(--text-primary);
      font-weight: 700;
      margin-bottom: 2rem;
      font-size: 2rem;
    }

    ul {
      list-style-type: none;
      padding: 0;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.25rem;
    }

    li {
      margin: 0;
      padding: 0;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
      background-color: var(--card);
      overflow: hidden;
      border: 1px solid rgba(0, 0, 0, 0.04);
    }

    li:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-md);
    }

    li a {
      padding: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
      color: var(--text-primary);
      font-weight: 500;
      transition: var(--transition);
    }

    a {
      text-decoration: none;
      display: block;
    }

    .folder {
      color: var(--folder);
    }

    .file {
      color: var(--file);
    }

    .parent {
      font-weight: 500;
      margin-bottom: 1.5rem;
      background-color: var(--card);
      padding: 1rem 1.25rem;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-sm);
      border: 1px solid rgba(0, 0, 0, 0.04);
      transition: var(--transition);
    }

    .parent:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-2px);
    }

    .parent a {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--primary);
    }

    @media (max-width: 768px) {
      body {
        padding: 1rem;
      }

      h1 {
        font-size: 1.5rem;
      }

      ul {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <h1>ディレクトリ: <?php echo htmlspecialchars($relativePath); ?></h1>

  <?php if ($relativePath != '/'): ?>
    <div class="parent">
      <a href="?path=<?php echo urlencode(dirname($relativePath)); ?>">📁 親ディレクトリへ戻る</a>
    </div>
  <?php endif; ?>

  <ul>
    <?php foreach ($items as $item): ?>
      <?php if ($item === '.' || $item === '..') continue; ?>

      <?php
      $fullPath = $path . DIRECTORY_SEPARATOR . $item;
      $isDir = is_dir($fullPath);

      // 相対パスの作成
      $itemRelativePath = $relativePath;
      if ($itemRelativePath != '/') {
        $itemRelativePath .= '/';
      }
      $itemRelativePath .= $item;

      // リンクの生成
      $link = $isDir
        ? '?path=' . urlencode($itemRelativePath)
        : '.' . $itemRelativePath;
      ?>

      <li>
        <a href="<?php echo $link; ?>" class="<?php echo $isDir ? 'folder' : 'file'; ?>">
          <?php echo $isDir ? '📁 ' : '📄 '; ?><?php echo htmlspecialchars($item); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</body>

</html>