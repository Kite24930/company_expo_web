import './common.js';
import axios from 'axios';
import { followCompany } from "./module/follow.js";

document.querySelectorAll('.follow-btn').forEach((followBtn) => {
    followBtn.addEventListener('click', () => {
        followCompany(followBtn, Laravel.user.api_token);
    });
});

document.querySelectorAll('.disclosure').forEach((disclosure) => {
    disclosure.addEventListener('change', (e) => {
        const disclosure = e.target.checked;
        const companyId = e.target.getAttribute('data-target');
        const sendData = {
            disclosure: disclosure,
            student_id: Laravel.student.id,
            company_id: companyId,
        };
        axios.post('/api/visit/disclosure?api_token=' + Laravel.user.api_token, sendData)
            .then(response => {
                if (response.data.success) {
                    console.log('success');
                } else {
                    console.log('failed', response.data.error);
                }
            })
            .catch(error => {
                console.log(error);
            });
    });
});
