import '../common';
import axios from 'axios';
import jsQR from 'jsqr';
import { Modal } from 'flowbite';

let path_name = '/' + window.location.pathname.split('/')[1];
if(window.location.hostname === 'localhost') {
    path_name = '';
}
console.log(window.location.hostname);
console.log(path_name);

document.getElementById('reading').addEventListener('click', qrCodeReading);
const company_name = document.getElementById('company_name');
const company_id = document.getElementById('company_id');

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
                let sendData = JSON.parse(code.data);
                sendData.user_id = Laravel.user.id;
                console.log(sendData);
                video.pause();
                video.srcObject.getTracks().forEach(track => track.stop());
                drawRect(code.location);
                axios.post(path_name + '/api/company-visit/student/verification?api_token=' + Laravel.user.api_token, sendData)
                    .then((res) => {
                        console.log(res);
                        if (res.data.visitor.length > 0) {
                            window.alert('すでに訪問登録されている企業です。');
                        } else {
                            company_name.innerText = res.data.company.company_name;
                            company_id.value = res.data.company.company_id;
                            modal.show();
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                        window.alert('QRコードの読み込みに失敗しました。');
                    });
            } else {
                msg.innerHTML = 'QRコードが見つかりませんでした。';
                setTimeout(startTick, 10);
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

const disclosure = document.querySelectorAll('.disclosure');
const submitBtn = document.getElementById('submit_btn');
disclosure.forEach((el) => {
    el.addEventListener('click', () => {
        disclosure.forEach((el) => {
            el.parentNode.classList.remove('bg-blue-800', 'text-white');
            if (el.checked) {
                el.parentNode.classList.add('bg-blue-800', 'text-white');
            }
        });
        if (submitBtn.disabled) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-200', 'hover:bg-gray-200');
        }
    });
});
