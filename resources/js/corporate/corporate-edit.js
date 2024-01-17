import '../common';
import axios from 'axios';
import Editor from '@toast-ui/editor';
import ColorSyntax from '@toast-ui/editor-plugin-color-syntax';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
import '@toast-ui/editor/dist/i18n/ja-jp';

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

// Viewerの初期化
const toastUiTarget = {
    business_detail: {
        id: 'business_detail',
        viewer: null,
        viewerEl: 'business_detail_viewer',
        editor: null,
        editorEl: 'business_detail_editor',
        data: Laravel.company.business_detail,
        btn: 'business_detail_btn',
    },
    pr: {
        id: 'pr',
        viewer: null,
        viewerEl: 'pr_viewer',
        editor: null,
        editorEl: 'pr_editor',
        data: Laravel.company.pr,
        btn: 'pr_btn',
    },
    job_detail: {
        id: 'job_detail',
        viewer: null,
        viewerEl: 'job_detail_viewer',
        editor: null,
        editorEl: 'job_detail_editor',
        data: Laravel.company.job_detail,
        btn: 'job_detail_btn',
    },
}
for(const key in toastUiTarget) {
    if (toastUiTarget[key].data !== null) {
        toastUiTarget[key].viewer = new Editor.factory({
            el: document.getElementById(toastUiTarget[key].viewerEl),
            viewer: true,
            plugins: [[ColorSyntax]],
            initialValue: toastUiTarget[key].data,
        });
        toastUiTarget[key].editor = new Editor({
            el: document.getElementById(toastUiTarget[key].editorEl),
            plugins: [[ColorSyntax]],
            initialValue: toastUiTarget[key].data,
            height: '300px',
            initialEditType: 'wysiwyg',
            language: 'ja',
        });
    } else {
        toastUiTarget[key].viewer = new Editor.factory({
            el: document.getElementById(toastUiTarget[key].viewerEl),
            viewer: true,
            plugins: [[ColorSyntax]],
            initialValue: '未入力',
        });
        toastUiTarget[key].editor = new Editor({
            el: document.getElementById(toastUiTarget[key].editorEl),
            plugins: [[ColorSyntax]],
            height: '300px',
            initialEditType: 'wysiwyg',
            language: 'ja',
        });
    }
    document.getElementById(toastUiTarget[key].btn).addEventListener('click', () => {
        toastUiEdit(toastUiTarget[key]);
    });
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

function toastUiEdit(target) {
    let sendData = {
        company_id: company_id,
    };
    sendData[target.id] = target.editor.getMarkdown();
    axios.post('/api/' + target.id + '_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                target.viewer.setMarkdown(res.data.company[target.id]);
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
}
