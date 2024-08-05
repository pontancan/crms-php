let input_name = document.getElementById('name');
let name_message = document.getElementById('name_message');
let input_kana = document.getElementById('kana');
let kana_message = document.getElementById('kana_message');
let input_gender = document.getElementById('gender');
let gender_message = document.getElementById('gender_message');
let input_dob_start = document.getElementById('dob_start');
let dob_message = document.getElementById('dob_message');
let input_dob_end = document.getElementById('dob_end');
// let dob_end_message = document.getElementById('dob_end_message');
let input_company = document.getElementById('company');
let company_message = document.getElementById('company_message');
let input_submit = document.getElementById('searchForm');
let submit_message = document.getElementById('submit_message');

// 各フィールドのバリデーション結果を保持するフラグ
let isNameValid = false;
let isKanaValid = false;
let isGenderValid = false;
let isDobValid = false;
let isCompanyValid = false;

function validateName() {
    if (input_name.value.trim() === '') {
        name_message.innerText = '入力は必須です';
        isNameValid = false;
    } else if (input_name.value.trim().length < 3) {
        name_message.innerText = '3文字以上必要です';
        isNameValid = false;
    } else {
        name_message.innerText = '';
        isNameValid = true;
    }
}

function validateKana() {
    const re =/^[\u30A0-\u30FF]+$/;
    if (input_kana.value.trim() === '') {
        kana_message.innerText = '入力は必須です';
        isKanaValid = false;
    } else if (!re.test(input_kana.value.trim()) ) {
        kana_message.innerText = '全角カタカナで入力してください';
        isKanaValid = false;
    }else if (input_kana.value.trim().length < 3) {
        kana_message.innerText = '3文字以上必要です';
        isKanaValid = false;
    } else {
        kana_message.innerText = '';
        isKanaValid = true;
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
    if (input_dob_start.value.trim() === '' || input_dob_end.value.trim() === '') {
        dob_message.innerText = '入力は必須です';
        isDobValid = false;
    } else {
        dob_message.innerText = '';
        isDobValid = true;
    }
}

//TODO 検索は片方でもOKにしてもいいかも

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
    if (!isGenderValid) messages.push("性別が無効です");
    if (!isDobValid) messages.push("生年月日が無効です");
    if (!isCompanyValid) messages.push("所属会社が無効です");
    submit_message.innerText = messages.join("\n");
}
//TODO 無効ならフィールド背景赤に

function validateAll() {
    validateName();
    validateKana();
    validateGender();
    validateDob();
    validateCompany();
    updateSubmitMessage();
}

input_name.addEventListener('blur', () => {
    validateName();
    updateSubmitMessage();
});

input_kana.addEventListener('blur', () => {
    validateKana();
    updateSubmitMessage();
});



input_gender.addEventListener('blur', () => {
    validateGender();
    updateSubmitMessage();
});

input_dob_start.addEventListener('blur', () => {
    validateDob();
    updateSubmitMessage();
});
input_dob_end.addEventListener('blur', () => {
    validateDob();
    updateSubmitMessage();
});



input_company.addEventListener('blur', () => {
    validateCompany();
    updateSubmitMessage();
});

input_submit.addEventListener("submit", (e) => {
    validateAll();

    if (messages.length > 0) {

        e.preventDefault();
    }
});

document.getElementById('clearButton').addEventListener('click', () => {
    let input_name = document.getElementById('name');
    let input_kana = document.getElementById('kana');
    let input_gender = document.getElementById('gender');
    let input_dob_start = document.getElementById('dob_start');
    let input_dob_end = document.getElementById('dob_end');
    let input_company = document.getElementById('company');


    // input_name.value = '';
    // input_kana.value = '';
    // input_gender.selectedIndex = 0;
    // input_dob_start.value = '';
    // input_dob_end.value = '';
    // input_company.selectedIndex = 0;
    location.reload();
});





