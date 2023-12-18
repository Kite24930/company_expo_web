import '../common.js';

document.getElementById('submitBtn').addEventListener('click', () => {
    if (window.confirm('本当に更新しますか？')) {
        document.getElementById('sendForm').submit();
    }
});
