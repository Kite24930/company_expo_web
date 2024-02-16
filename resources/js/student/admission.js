import '../common';
import axios from 'axios';
import { io } from "socket.io-client";

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
});

const socket = io("https://pm-socket.com");

socket.emit('register', userId);
socket.on('connect', (res) => {
    console.log('connected');
});
socket.on('linkTo' + userId, (msg) => {
    console.log(msg);
    window.alert('入場処理が完了しました。\nTOPページに戻ります。');
    window.location.href = Laravel.route;
});
