import '../common';
import axios from 'axios';

const userId = Laravel.user.id;
const qrEl = document.getElementById('qr');
const qrCode = Laravel.qr_code;
const sendData = {
    user_id: userId,
}
const apiToken = Laravel.user.api_token;

window.addEventListener('load', () => {
    if (qrEl) {
        qrEl.src = qrCode;
    }

    setInterval(admissionCheck, 500)
});

function admissionCheck() {
    // axios.post('/api/admission/check?api_token=' + apiToken, sendData)
    //     .then((res) => {
    //         console.log(res.data);
    //     })
    //     .catch((err) => {
    //         console.log(err);
    //     })
}
