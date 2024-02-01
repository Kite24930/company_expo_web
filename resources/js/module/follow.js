import axios from 'axios';
import { initFlowbite } from "flowbite";

function notLogin() {
    window.alert('フォロー機能を利用するには、ログインしてください');
}

function followCompany(el, apiToken) {
    const companyId = el.getAttribute('data-target');
    const sendData = {
        company_id: companyId,
        student_id: Laravel.student.id,
    };
    axios.post('/api/follow/company?api_token=' + apiToken, sendData)
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
