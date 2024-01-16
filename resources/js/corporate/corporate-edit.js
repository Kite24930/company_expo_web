import '../common';
import axios from 'axios';

const modal = document.getElementById('modalWrapper');
const indicator = document.getElementById('indicator');
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

document.getElementById('company_name_btn').addEventListener('click', () => {
    indicatorPost();
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
        });
})

document.getElementById('company_industry_btn').addEventListener('click', () => {
    indicatorPost();
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
        });
});
