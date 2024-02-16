import '../app.js';
import { app, analytics } from '../firebase.js';
import '/node_modules/flowbite/dist/flowbite.min.js';
import jsQR from 'jsqr';
import { Modal } from 'flowbite';
import { io } from "socket.io-client";

document.getElementById('reading').addEventListener('click', qrCodeReading);

const socket = io("https://pm-socket.com");

socket.on('connect', (res) => {
    console.log('connected');
});

function qrCodeReading() {
    let video = document.createElement('video');
    let canvas = document.getElementById('canvas');
    let ctx = canvas.getContext('2d');
    let msg = document.getElementById('msg');

    const userMedia = {video: { facingMode: "environment" }};
    navigator.mediaDevices.getUserMedia(userMedia).then((stream) => {
        video.srcObject = stream;
        video.setAttribute('playsinline', true);
        video.play();
        video.addEventListener('canplay', startTick, false);
    })
        .catch((err) => {
            console.error(err);
            window.alert('カメラの使用を許可してください。');
        });

    function startTick() {
        msg.innerHTML = '読み取り中...';
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvas.height = video.videoHeight;
            canvas.width = video.videoWidth;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            let code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
            });
            if (code) {
                msg.innerHTML = 'QRコードの読み込みが完了しました。';
                const sendData = JSON.parse(code.data);
                console.log(sendData);
                video.pause();
                video.srcObject.getTracks().forEach(track => track.stop());
                drawRect(code.location);
                axios.post('/api/admission/student/verification?api_token=' + Laravel.user.api_token, sendData)
                    .then((res) => {
                        console.log(res);
                        if (res.data.success) {
                            modal.show();
                            document.getElementById('student_name').innerHTML = res.data.student.student_name;
                            document.getElementById('student_faculty').innerHTML = res.data.student.faculty_name;
                            document.getElementById('student_grade').innerHTML = res.data.student.grade_name;
                            document.getElementById('delete_admission').setAttribute('data-id', res.data.admission.id);
                            document.getElementById('commit').setAttribute('data-id', res.data.admission.user_id);
                            modal.show();
                        } else {
                            window.alert(res.data.message);
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                        window.alert('入場処理中にエラーが発生しました。');
                    });
            } else {
                msg.interHTML = 'QRコードが見つかりませんでした。';
                setTimeout(startTick, 10)
            }
        }
    }

    function drawRect(location) {
        drawLine(location.topLeftCorner, location.topRightCorner);
        drawLine(location.topRightCorner, location.bottomRightCorner);
        drawLine(location.bottomRightCorner, location.bottomLeftCorner);
        drawLine(location.bottomLeftCorner, location.topLeftCorner);
    }

    function drawLine(begin, end) {
        ctx.lineWidth = 4;
        ctx.strokeStyle = "#FF3B58";
        ctx.beginPath();
        ctx.moveTo(begin.x, begin.y);
        ctx.lineTo(end.x, end.y);
        ctx.stroke();
    }
}

const targetEl = document.getElementById('result');

const options = {
    placement: 'center',
    backdrop: 'dynamic',
    closable: true,
    onHide: () => {
        console.log('hidden');
    },
    onShow: () => {
        console.log('shown');
    },
}

const modal = new Modal(targetEl, options);

document.getElementById('commit').addEventListener('click', (e) => {
    socket.emit('link', { id: e.target.getAttribute('data-id') });
    window.location.reload();
});

document.getElementById('delete_admission').addEventListener('click', (e) => {
    const sendData = {
        admission_id: e.target.getAttribute('data-id')
    };
    axios.delete('/api/admission/student/delete?api_token=' + Laravel.user.api_token, {data: sendData})
        .then((res) => {
            console.log(res);
            if (res.data.success) {
                modal.hide();
                window.alert('入場処理が取り消されました。');
                window.location.reload();
            } else {
                window.alert(res.data.message);
            }
        })
        .catch((err) => {
            console.error(err);
            window.alert('入場処理取消中にエラーが発生しました。');
        });
});
