// 各要素の取得
let input_name = document.getElementById('name');
let name_message = document.getElementById('name_message');
let input_kana = document.getElementById('kana');
let kana_message = document.getElementById('kana_message');
let input_email = document.getElementById('email');
let email_message = document.getElementById('email_message');
let input_phone = document.getElementById('phone');
let phone_message = document.getElementById('phone_message');
let input_gender = document.getElementById('gender');
let gender_message = document.getElementById('gender_message');
let input_dob = document.getElementById('dob');
let dob_message = document.getElementById('dob_message');
let input_company = document.getElementById('company');
let company_message = document.getElementById('company_message');
let input_submit = document.getElementById('registerForm');
let submit_message = document.getElementById('submit_message');

// 各フィールドのバリデーション結果を保持するフラグ
let isNameValid = true;
let isKanaValid = true;
let isEmailValid = true;
let isPhoneValid = true;
let isGenderValid = true;
let isDobValid = true;
let isCompanyValid = true;

function validateName() {
    if (input_name.value.trim() === '') {
        name_message.innerText = '入力は必須です';
        isNameValid = false;
    } else if (input_name.value.trim().length < 3) {
        name_message.innerText = '3文字以上必要です';
        isNameValid = false;
    } else if(input_name.value.trim().length > 16){
        name_message.innerText = '入力できるのは16文字までです';
        isNameValid = false;
    }else {
        name_message.innerText = '';
        isNameValid = true;
    }
}

function validateKana() {
    const re =/^[\u30A0-\u30FF]+$/;
    if (input_kana.value.trim() === '') {
        kana_message.innerText = '入力は必須です';
        isKanaValid = false;
    } else if (!re.test(input_kana.value.trim())) {
        kana_message.innerText = '全角カタカナで入力してください';
        isKanaValid = false;
    } else if (input_kana.value.trim().length < 3) {
        kana_message.innerText = '3文字以上必要です';
        isKanaValid = false;
    } else if(input_kana.value.trim().length > 16){
        kana_message.innerText = '入力できるのは16文字までです';
        isKanaValid = false;
    }else {
        kana_message.innerText = '';
        isKanaValid = true;
    }
}

function validateEmail() {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const re_html5 = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    
    const email = input_email.value.trim();
    const localPart = email.split('@')[0]; // @より前の部分を取得
    
    if (email === '') {
        email_message.innerText = '入力は必須です';
        isEmailValid = false;
    } else if (!re_html5.test(email)) {
        email_message.innerText = '有効なメールアドレスではありません';
        isEmailValid = false;
    } else if (localPart.length > 64) {
        email_message.innerText = '別のメールアドレスを使用してください';
        isEmailValid = false;
    } 
    else {
        email_message.innerText = '';
        isEmailValid = true;
    }
}


function validatePhone() {
    const re = /^\d{10,11}$/;
    if (input_phone.value.trim() === '') {
        phone_message.innerText = '入力は必須です';
        isPhoneValid = false;
    } else if (!re.test(input_phone.value.trim())) {
        phone_message.innerText = '有効な電話番号ではありません';
        isPhoneValid = false;
    } else {
        phone_message.innerText = '';
        isPhoneValid = true;
    }
}

function validateGender() {
    if (input_gender.value.trim() === '') {
        gender_message.innerText = '選択は必須です';
        isGenderValid = false;
    } else {
        gender_message.innerText = '';
        isGenderValid = true;
    }
}

function validateDob() {
    if (input_dob.value.trim() === '') {
        dob_message.innerText = '入力は必須です';
        isDobValid = false;
    } else {
        dob_message.innerText = '';
        isDobValid = true;
    }
}

function validateCompany() {
    if (input_company.value.trim() === '') {
        company_message.innerText = '選択は必須です';
        isCompanyValid = false;
    } else {
        company_message.innerText = '';
        isCompanyValid = true;
    }
}

let messages = [];

function updateSubmitMessage() {
    messages = [];
    if (!isNameValid) messages.push("顧客名が無効です");
    if (!isKanaValid) messages.push("顧客名カナが無効です");
    if (!isEmailValid) messages.push("メールアドレスが無効です");
    if (!isPhoneValid) messages.push("電話番号が無効です");
    if (!isGenderValid) messages.push("性別が無効です");
    if (!isDobValid) messages.push("生年月日が無効です");
    if (!isCompanyValid) messages.push("所属会社が無効です");
    submit_message.innerText = messages.join("\n");//messages 配列内の各要素を改行文字 (\n) でつないで、一つの文字列にまとめる
}
//TODO 無効ならフィールド背景赤に

function validateAll() {
    validateName();
    validateKana();
    validateEmail();
    validatePhone();
    validateGender();
    validateDob();
    validateCompany();
    updateSubmitMessage();
}

// 各フィールドの変更イベントリスナー
input_name.addEventListener('input', () => {
    isNameValid = false;
    validateName();
    updateSubmitMessage();
});

input_kana.addEventListener('input', () => {
    isKanaValid = false;
    validateKana();
    updateSubmitMessage();
});

input_email.addEventListener('input', () => {
    isEmailValid = false;
    validateEmail();
    updateSubmitMessage();
});

input_phone.addEventListener('input', () => {
    isPhoneValid = false;
    validatePhone();
    updateSubmitMessage();
});

input_gender.addEventListener('input', () => {
    isGenderValid = false;
    validateGender();
    updateSubmitMessage();
});

input_dob.addEventListener('input', () => {
    isDobValid = false;
    validateDob();
    updateSubmitMessage();
});

input_company.addEventListener('input', () => {
    isCompanyValid = false;
    validateCompany();
    updateSubmitMessage();
});

// 初期表示時のバリデーション
document.addEventListener('DOMContentLoaded', (event) => {
    validateAll();
    updateSubmitMessage();
});

input_submit.addEventListener("submit", (e) => {
    validateAll();

    if (messages.length > 0) {
        e.preventDefault();
    }
});
