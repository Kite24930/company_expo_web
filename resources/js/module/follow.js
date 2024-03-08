import axios from 'axios';
import { initFlowbite } from "flowbite";

let path_name = '/' + window.location.pathname.split('/')[1];
if(window.location.hostname === 'localhost') {
    path_name = '';
}
console.log(window.location.hostname);
console.log(path_name);

function notLogin() {
    window.alert('フォロー機能を利用するには、ログインしてください');
}

function followCompany(el, apiToken) {
    let companyId = el.getAttribute('data-target');
    while (companyId === null) {
        el = el.parentElement;
        companyId = el.getAttribute('data-target');
    }
    const sendData = {
        company_id: companyId,
        student_id: Laravel.student.id,
    };
    axios.post(path_name + '/api/follow/company?api_token=' + apiToken, sendData)
        .then((res) => {
            if (res.data.success) {
                const parser = new DOMParser();
                const symbol = parser.parseFromString(res.data.symbol, 'text/html');
                el.innerHTML = symbol.body.innerHTML;
                const toast = parser.parseFromString(res.data.toast, 'text/html');
                document.body.appendChild(toast.body.firstChild);
                initFlowbite();
            } else {
                console.error(res.data.message);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

export { notLogin, followCompany };
