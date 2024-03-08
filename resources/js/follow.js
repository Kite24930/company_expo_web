import './common.js';
import axios from 'axios';
import { followCompany } from "./module/follow.js";

let path_name = '/' + window.location.pathname.split('/')[1];
if(window.location.hostname === 'localhost') {
    path_name = '';
}
console.log(window.location.hostname);
console.log(path_name);

document.getElementById('follow_disclosure').addEventListener('change', (e) => {
    const disclosure = e.target.checked;
    const sendData = {
        disclosure: disclosure,
        student_id: Laravel.student.id,
    };
    axios.post(path_name + '/api/follow/disclosure?api_token=' + Laravel.user.api_token, sendData)
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
