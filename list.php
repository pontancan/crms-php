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
    require_once dirname(__FILE__) . '/lib/DBcon.php';
    require_once dirname(__FILE__) . '/model/Company.php';
    require_once dirname(__FILE__) . '/model/Customer.php';

    try {
        $customer = new Customer();
        $params = [];
        if (!empty($_GET['name'])) {
            $params[':name'] = '%' . $_GET['name'] . '%';
        }
        if (!empty($_GET['name_kana'])) {
            $params[':kana'] = '%' . $_GET['name_kana'] . '%';
        }
        if (!empty($_GET['gender']) && $_GET['gender'] != 'all') {
            $params[':gender'] = $_GET['gender'];
        }
        if (!empty($_GET['dob_start'])) {
            $params[':dob_start'] = $_GET['dob_start'];
        }
        if (!empty($_GET['dob_end'])) {
            $params[':dob_end'] = $_GET['dob_end'];
        }
        if (!empty($_GET['company']) && $_GET['company'] != 'all') {
            $params[':company'] = $_GET['company'];
        }
        $customers = $customer->getCustomers($params);
        $companies = (new Company())-> getCompanies();
    } catch (PDOException $e) {
        echo "データベース接続に失敗しました: " . $e->getMessage();
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
            <form id="searchForm" action="list.php" method="get">
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="vali-group">
                    <div id="name_message" class="message"></div><br />
                </div>
                <div class="form-group">
                    <label for="name_kana">セイメイ</label>
                    <input type="text" id="kana" name="name_kana">
                </div>
                <div class="vali-group">
                    <div id="kana_message" class="message"></div><br />
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
                    <div id="gender_message" class="message"></div><br />
                </div>
                <div class="form-group">
                    <label for="dob_start">生年月日</label>
                    <input type="date" id="dob_start" name="dob_start">
                    <span>~</span>
                    <input type="date" id="dob_end" name="dob_end">
                </div>
                <div class="vali-group">
                    <div id="dob_message" class="message"></div><br />
                </div>
                <div class="form-group">
                    <label for="company">所属会社</label>
                    <select id="company" name="company">
                        <option value="">選択してください</option>
                        <option value="all">全て</option>
                        <?php
                        foreach ($companies as $company) {
                            echo '<option value="' . $company['company_id'] . '">' . $company['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="vali-group">
                    <div id="company_message" class="message"></div><br />
                </div>
                <div class="form-submit">
                    <input type="submit" id="submit" value="検索">
                    <!-- <button type="button" id="clearButton">クリア</button> -->
                </div>
                <div class="vali-group">
                    <div id="submit_message" class="message" style="line-height: 1.5;"></div><br />
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
                    if (empty($customers)) { ?>
                        <div>登録されている顧客情報はありません</div>
                    <?php
                    } else {
                        foreach($customers as $customer) {
                            echo '<form name="deleteForm" method="post" action="delete_process.php">';
                            echo '<tr>';
                            echo '<td>' . $customer['customer_id'] . '</td>';
                            echo '<td>' . $customer['name'] . '<br>' . $customer['kana'] . '</td>';
                            echo '<td>' . $customer['email'] . '<br>' . $customer['phone'] . '</td>';
                            echo '<td>' . $customer['company_name'] . '</td>';
                            echo '<td>' . $customer['created_at'] . '<br>' . $customer['modified_at'] . '</td>';
                            echo '<td> <button type="button" onclick="location.href=\'edit.php?customer_id=' . $customer['customer_id'] . '\'" class="edit-button">編集</button> </td>';
                            echo '<td> <button type="button" class="delete-button" onclick="confirmDelete(' . $customer['customer_id'] . ')">削除</button> </td>';
                            echo '<input type="hidden" name="customer_id" value="' . $customer['customer_id'] . '" />';
                            echo '</tr>';
                            echo '</form>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright© dummyインダストリー Inc. All Rights Reserved.</p>
    </footer>
    <script src="./js/app.js"></script>
</body>

</html>