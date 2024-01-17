import '../common';
import axios from 'axios';

const modal = document.getElementById('modalWrapper');
const indicator = document.getElementById('indicator');
const errorIndicator = document.getElementById('errorIndicator');
const csrf = document.querySelector('input[name="_token"]').value;
const company_id = document.getElementById('company_id').value;
const api_token = document.getElementById('api_token').value;

function modalOpen() {
    modal.classList.remove('hidden');
}

function modalClose() {
    modal.classList.add('hidden');
}
document.getElementById('modalClose').addEventListener('click', () => {
    modalClose();
});

function indicatorPost() {
    indicator.innerText = '送信中';
    indicator.classList.remove('text-green-500', 'bg-green-100', 'text-red-500', 'bg-red-100');
}

function indicatorSuccess() {
    indicator.innerText = '更新完了';
    indicator.classList.add('text-green-500', 'bg-green-100');
}

function indicatorError() {
    indicator.innerText = '更新失敗';
    indicator.classList.add('text-red-500', 'bg-red-100');
}

function errorIndicatorShow(errors) {
    console.log(errors)
    errorIndicator.classList.remove('hidden');
    errorIndicator.innerHTML = '';
    for (const key in errors) {
        errorIndicator.innerHTML += '<li class="text-sm text-red-500">' + errors[key] + '</li>';
    }
}

function errorIndicatorHide() {
    errorIndicator.classList.add('hidden');
}

// 企業名の変更
document.getElementById('company_name_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const sendData = {
        company_name: document.getElementById('company_name_input').value,
        company_name_ruby: document.getElementById('company_name_ruby_input').value,
        company_id: company_id,
    };
    axios.post('/api/company_name_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_name').innerText = res.data.company_name;
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
})

// 企業業種の変更
document.getElementById('company_industry_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const sendData = {
        industry_id: document.getElementById('company_industry_input').value,
        company_id: company_id,
    };
    axios.post('/api/company_industry_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('industry_name_head').innerText = res.data.industry.industry_name;
                document.getElementById('industry_name').innerText = res.data.industry.industry_name;
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

// 企業ロゴの変更
document.getElementById('company_logo_input_wrapper').addEventListener('click', () => {
    document.getElementById('company_logo_input').click();
});

document.getElementById('company_logo_input').addEventListener('change', (e) => {
    const reader = new FileReader();
    const file = e.target.files[0];
    reader.addEventListener('load', (e) => {
        document.getElementById('company_logo_preview').src = e.target.result;
    });
    reader.readAsDataURL(file);
});

document.getElementById('company_logo_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const fileEl = document.getElementById('company_logo_input');
    if (fileEl.files.length === 0) {
        indicatorError();
        errorIndicatorShow(['画像を選択してください']);
        return;
    }
    const sendData = new FormData();
    sendData.append('company_logo', fileEl.files[0]);
    sendData.append('company_id', company_id);
    sendData.append('_token', csrf);
    axios.post('/api/company_logo_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_logo').src = '/storage/company/' + res.data.company.id + '/' + res.data.company.company_logo + '?token=' + new Date().getTime();
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

// 企業イメージ画像の変更
document.getElementById('company_img_input_wrapper').addEventListener('click', () => {
    document.getElementById('company_img_input').click();
});

document.getElementById('company_img_input').addEventListener('change', (e) => {
    const reader = new FileReader();
    const file = e.target.files[0];
    reader.addEventListener('load', (e) => {
        document.getElementById('company_img_preview').src = e.target.result;
    });
    reader.readAsDataURL(file);
});

document.getElementById('company_img_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const fileEl = document.getElementById('company_img_input');
    if (fileEl.files.length === 0) {
        indicatorError();
        errorIndicatorShow(['画像を選択してください']);
        return;
    }
    const sendData = new FormData();
    sendData.append('company_img', fileEl.files[0]);
    sendData.append('company_id', company_id);
    sendData.append('_token', csrf);
    axios.post('/api/company_img_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_img').src = '/storage/company/' + res.data.company.id + '/' + res.data.company.company_img + '?token=' + new Date().getTime();
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});
