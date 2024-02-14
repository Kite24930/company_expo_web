import '../app.js';
import { app, analytics } from '../firebase.js';
import '/node_modules/flowbite/dist/flowbite.min.js';
import jsQR from 'jsqr';

document.getElementById('reading').addEventListener('click', qrCodeReading);

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
                msg.innerHTML = code.data;
                console.log(typeof(code.data));
                video.pause();
                video.srcObject.getTracks().forEach(track => track.stop());
                drawRect(code.location);
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
