<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style-re.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>登録ページ</title>
</head>

<body>
    <?php
    // ini_set('display_errors', 1);
    require_once dirname(__FILE__) . '/lib/DBcon.php';
    require_once dirname(__FILE__) . '/model/Company.php';
    $companies = (new Company())-> getCompanies();
    ?>
    <header class="header l-contents">
        <a class="logo" href="./index.php">
            <h1>CRMS</h1>
        </a>
        <nav class="navtab">
            <ul class="navtab-bar">
                <li><a href="./index.php">トップ</a></li>
                <li><a href="./list.php">検索</a></li>
                <li class="active"><a href="./register.php">登録</a></li>
                <!-- お問い合わせは後で拡張する -->
            </ul>
        </nav>
    </header>
    <main>
        <div class="main-content l-contents">

            <div class="form-title">
                <h2>情報登録</h2>
            </div>
            <div class="form-subtitle">
                <h3>必要な項目を入力後、「登録」ボタンを押してください。</h3>
                <h3><span>※</span>は必須項目です</h3>
            </div>
            <form id="registerForm" action="./insert_process.php" class="register" method="post">
                <div class="form-group">
                    <label for="name">顧客名<span>※</span></label>
                    <input type="text" id="name" name="name" value="">
                </div>
                <div class="vali-group">
                    <div id="name_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="kana">顧客名カナ<span>※</span></label>
                    <input type="text" id="kana" name="kana" placeholder="" value="">
                </div>
                <div class="vali-group">
                    <div id="kana_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス<span>※</span></label>
                    <input type="text" id="email" name="email" value="">
                </div>
                <div class="vali-group">
                    <div id="email_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="phone">電話番号<span>※</span></label>
                    <input type="text" id="phone" name="phone" placeholder="ハイフン(-)は不要" value="">
                </div>
                <div class="vali-group">
                    <div id="phone_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="gender">性別<span>※</span></label>
                    <select id="gender" name="gender">
                        <option value="">選択してください</option>
                        <option value="male" selected>男性</option>
                        <option value="female">女性</option>
                        <option value="other">その他</option>
                    </select>
                </div>
                <div class="vali-group">
                    <div id="gender_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="dob">生年月日<span>※</span></label>
                    <input type="date" id="dob" name="dob" value="1996-01-01">
                </div>
                <div class="vali-group">
                    <div id="dob_message" class="message"></div> <br />
                </div>
                <div class="form-group">
                    <label for="company">所属会社<span>※</span></label>
                    <select id="company" name="company">
                        <option value="">選択してください</option>
                        <?php
                        foreach($companies as $company){
                            echo '<option value="' . $company['company_id'] . '">' . $company['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="vali-group">
                    <div id="company_message" class="message"></div> <br />
                </div>
                <div class="form-submit">
                    <input type="submit" id="submit" value="登録">
                </div>
                <div class="vali-group">
                    <div id="submit_message" class="message" style="line-height: 1.5;"></div> <br />
                </div>
            </form>
        </div>
    </main>
    <footer class="footer">
        <p>Copyright© dummyインダストリー Inc. All Rights Reserved.</p>
    </footer>
    <script src="./js/vali_regi.js"></script>
    <!-- <script src="./js/useCompanies.js" type="module"></script> -->
</body>

</html>