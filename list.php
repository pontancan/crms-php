<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style-re.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>検索ページ</title>
</head>

<body>
    <?php
    $host = 'localhost'; // XAMPP のデフォルトホスト
    $dbname = 'crms_db';
    $username = 'root';
    $password = '';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password);


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stt = $pdo->prepare('
            SELECT customer.*, company.name AS company_name 
            FROM customer 
            LEFT JOIN company ON customer.company_id = company.company_id');
        $stt->execute();
    } catch (PDOException $e) {
        echo "データベース接続に失敗しました: " . $e->getMessage();
    } finally {
        $pdo = null;
    }
    ?>
    <header class="header l-contents">
        <a class="logo" href="./index.php">
            <h1>CRMS</h1>
        </a>
        <nav class="navtab">
            <ul class="navtab-bar">
                <li><a href="./index.php">トップ</a></li>
                <li class="active"><a href="./list.php">検索</a></li>
                <li><a href="./register.php">登録</a></li>
                <!-- お問い合わせは後で拡張する -->
            </ul>
        </nav>
    </header>
    <main>
        <div class="main-content l-contents main-content-list">
            <div class="form-title">
                <h2>検索条件入力</h2>
            </div>
            <div class="form-subtitle">
                <h3>必要な項目を入力後、「検索」ボタンを押してください。</h3>

            </div>
            <form id="searchForm" action="index.php" method="get">
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="vali-group">
                    <div id="name_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="name_kana">セイメイ</label>
                    <input type="text" id="kana" name="name_kana">
                </div>
                <div class="vali-group">
                    <div id="kana_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="gender">性別</label>
                    <select id="gender" name="gender">
                        <option value="">選択してください</option>
                        <option value="male">男性</option>
                        <option value="female">女性</option>
                        <option value="other">その他</option>
                        <option value="all">全て</option>
                    </select>
                </div>
                <div class="vali-group">
                    <div id="gender_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="dob_start">生年月日</label>
                    <input type="date" id="dob_start" name="dob_start">
                    <span>~</span>
                    <input type="date" id="dob_end" name="dob_end">
                </div>
                <div class="vali-group">
                    <div id="dob_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="company">所属会社</label>
                    <select id="company" name="company">
                        <option value="">選択してください</option>
                        <option value="all">全て</option>
                    </select>
                </div>
                <div class="vali-group">
                    <div id="company_message" class="message"></div> <br />
                </div>
                <div class="form-submit">
                    <input type="submit" id="submit" value="検索">
                    <button type="button" id="clearButton">クリア</button>
                </div>
                <div class="vali-group">
                    <div id="submit_message" class="message" style="line-height: 1.5;"></div> <br />
                </div>
            </form>
            <hr>
            <table class="customer-table">
                <thead>
                    <tr>
                        <th>顧客ID</th>
                        <th>顧客名<br>顧客名カナ</th>
                        <th>メールアドレス<br>電話番号</th>
                        <th>所属会社</th>
                        <th>新規登録日時<br>最終更新日時</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody id="customer-table-body">
                    <?php
                    if ($stt->rowCount() === 0) { ?>
                        <div>該当する検索結果はありません</div>
                    <?php
                    } else {
                        while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<form name="deleteForm" method="post" action="delete_process.php">';
                            echo'<tr>';
                            echo '<td>' . $row['customer_id'] . '</td>';
                            echo '<td>' . $row['name'] . '<br>' . $row['kana'] . '</td>';
                            echo '<td>' . $row['email'] . '<br>' . $row['phone'] . '</td>';
                            echo '<td>' . $row['company_name'] . '</td>';
                            echo '<td>' . $row['created_at'] . '<br>' . $row['modified_at'] . '</td>';
                            echo '<td> <button type="button" onclick="location.href=\'edit.php?customer_id=' . $row['customer_id'] . '\'" class="edit-button">編集</button> </td>';
                            echo '<td> <button type="submit" class="delete-button">削除</button> </td>';
                            echo '<input type="hidden" name="customer_id" value="' .$row['customer_id'].'" />';
                            echo'</tr>';
                            echo'</form>';
                        }
                    }
                    ?>


                    <!-- <tr>
                        <td>0001</td>
                        <td>山田太郎<br>ヤマダタロウ</td>
                        <td>tyamada@test.com<br>080-4444-0001</td>
                        <td>A社</td>
                        <td>2024/07/01<br>2024/07/01</td>
                        <td><button class="edit-button">編集</button></td>
                        <td><button class="delete-button" popovertarget="my-popover">削除</button></td>
                        <div id="my-popover" popover>
                            <h2>一度削除したデータは元に戻せません。本当に削除してもよろしいでしょうか。</h2>
                            <button class="delete">削除</button>
                        </div>
                    </tr>

                    <tr>
                        <td>0002</td>
                        <td>山田花子<br>ヤマダハナコ</td>
                        <td>hyamada@test.com<br>080-4444-0002</td>
                        <td>A社</td>
                        <td>2024/07/02<br>2024/07/03</td>
                        <td><button class="edit-button">編集</button></td>
                        <td><button class="delete-button" popovertarget="my-popover">削除</button></td>
                    </tr>
                    <tr>
                        <td>0003</td>
                        <td>吉田茂<br>ヨシダシゲル</td>
                        <td>syoshida@test.com<br>080-4444-0003</td>
                        <td>B社</td>
                        <td>2024/07/02<br>2024/07/02</td>
                        <td><button class="edit-button">編集</button></td>
                        <td><button class="delete-button" popovertarget="my-popover">削除</button></td>
                    </tr> -->

                </tbody>
            </table>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright© dummyインダストリー Inc. All Rights Reserved.</p>
    </footer>
    <!-- <script src="./js/vali_list.js"></script> -->
    <!-- <script src="./js/useCompanies.js" type="module"></script> -->
    <!-- <script src="./js/useCustomers.js" type="module"></script> -->
</body>

</html>