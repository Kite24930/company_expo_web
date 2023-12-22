import '../common.js';

document.getElementById('company-logo').addEventListener('change', (e) => {
    const file = e.target.files[0];
    document.getElementById('logo-preview').src = file ? URL.createObjectURL(file) : 'http://via.placeholder.com/50x50';
});
