import './common.js';
import axios from 'axios';
import { followCompany } from "./module/follow.js";

document.getElementById('follow_disclosure').addEventListener('change', (e) => {
    const disclosure = e.target.checked;
    const sendData = {
        disclosure: disclosure,
        student_id: Laravel.student.id,
    };
    axios.post('/api/follow/disclosure?api_token=' + Laravel.user.api_token, sendData)
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
})

document.querySelectorAll('.follow-btn').forEach((followBtn) => {
    followBtn.addEventListener('click', () => {
        followCompany(followBtn, Laravel.user.api_token);
    });
});
