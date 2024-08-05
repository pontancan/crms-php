<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style-re.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>トップページ</title>
</head>

<body>
    <header class="header l-contents">
        <a class="logo" href="./index.php">
            <h1>CRMS</h1>
        </a>
        <nav class="navtab">
            <ul class="navtab-bar">
                <li class="active"><a href="./index.php">トップ</a></li>
                <li><a href="./list.php">検索</a></li>
                <li><a href="./register.php">登録</a></li>
                <!-- お問い合わせは後で拡張する -->
            </ul>
        </nav>
    </header>
    <main>
        <div class="main-content l-contents main-content-top">
            <a href="./list.php" class="content-card">

                <i class="fas fa-search"></i>
                <p class="card-title">検索</p>
            </a>
            <a href="./register.php" class="content-card">
                <i class="fas fa-user-plus"></i>
                <p class="card-title">登録</p>
            </a>
        </div>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright© dummyインダストリー Inc. All Rights Reserved.</p>
    </footer>
</body>

</html>