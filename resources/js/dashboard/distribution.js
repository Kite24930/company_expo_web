import '../common.js';

document.querySelectorAll('.dateDeleteBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        deleteDate(btn);
    });
});

function deleteDate(btn) {
    if (window.confirm('本当に削除しますか？')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = btn.getAttribute('data-url');
        document.body.appendChild(form);
        form.addEventListener('formdata', e => {
            let fd = e.formData;
            fd.set('_token', btn.getAttribute('data-token'));
            fd.set('_method', 'DELETE');
        });
        form.submit();
    }
}

document.getElementById('dateAddBtn').addEventListener('click', (e) => {
    const btn = e.target;
    const formWrapper = document.createElement('div');
    formWrapper.classList.add('flex', 'items-center', 'gap-3', 'border-gray-300', 'rounded-md', 'shadow-sm', 'border', 'p-2');
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    let targetId;
    if (Laravel.date_max_id !== null) {
        targetId = Laravel.date_max_id + 1;
        Laravel.date_max_id++;
    } else {
        targetId = 1;
        Laravel.date_max_id = 1;
    }
    idInput.value = targetId;
    formWrapper.appendChild(idInput);
    const dateInput = document.createElement('input');
    dateInput.type = 'date';
    dateInput.name = 'date[' + targetId + ']';
    dateInput.classList.add('border-gray-300', 'focus:border-indigo-500', 'rounded-md', 'shadow-sm');
    const today = new Date();
    dateInput.value = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    console.log(new Date());
    formWrapper.appendChild(dateInput);
    const deleteBtn = document.createElement('button');
    deleteBtn.type = 'button';
    deleteBtn.classList.add('inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-sm', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-red-500', 'focus:bg-red-500', 'focus:outline-none', 'focus:ring-2', 'focus:ring-pink-500', 'focus:ing-offset-2', 'transition', 'ease-in-out', 'duration-150', 'deleteDateBtn');
    deleteBtn.textContent = '削除';
    deleteBtn.addEventListener('click', () => {
        window.alert('新規追加された項目なので、データベースの削除はできません。画面をリロードするとリセットできます。');
    });
    formWrapper.appendChild(deleteBtn);
    btn.before(formWrapper);
});

document.querySelectorAll('.periodDeleteBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        deletePeriod(btn);
    });
});

function deletePeriod(btn) {
    if (window.confirm('本当に削除しますか？')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = btn.getAttribute('data-url');
        document.body.appendChild(form);
        form.addEventListener('formdata', e => {
            let fd = e.formData;
            fd.set('_token', btn.getAttribute('data-token'));
            fd.set('_method', 'DELETE');
        });
        form.submit();
    }
}

document.getElementById('periodAddBtn').addEventListener('click', (e) => {
    const btn = e.target;
    const formWrapper = document.createElement('div');
    formWrapper.classList.add('flex', 'items-center', 'gap-3', 'border-gray-300', 'rounded-md', 'shadow-sm', 'border', 'p-2');
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    let targetId;
    if (Laravel.period_max_id !== null) {
        targetId = Laravel.period_max_id + 1;
        Laravel.period_max_id++;
    } else {
        targetId = 1;
        Laravel.period_max_id = 1;
    }
    idInput.value = targetId;
    formWrapper.appendChild(idInput);
    const periodInput = document.createElement('input');
    periodInput.type = 'text';
    periodInput.name = 'period[' + targetId + ']';
    periodInput.classList.add('border-gray-300', 'focus:border-indigo-500', 'rounded-md', 'shadow-sm');
    formWrapper.appendChild(periodInput);
    const periodStartInput = document.createElement('input');
    periodStartInput.type = 'time';
    periodStartInput.name = 'period_start[' + targetId + ']';
    periodStartInput.classList.add('border-gray-300', 'focus:border-indigo-500', 'rounded-md', 'shadow-sm');
    periodStartInput.value = '09:00';
    formWrapper.appendChild(periodStartInput);
    const span = document.createElement('span');
    span.textContent = '〜';
    formWrapper.appendChild(span);
    const periodEndInput = document.createElement('input');
    periodEndInput.type = 'time';
    periodEndInput.name = 'period_end[' + targetId + ']';
    periodEndInput.classList.add('border-gray-300', 'focus:border-indigo-500', 'rounded-md', 'shadow-sm');
    periodEndInput.value = '17:00';
    formWrapper.appendChild(periodEndInput);
    const deleteBtn = document.createElement('button');
    deleteBtn.type = 'button';
    deleteBtn.classList.add('inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-sm', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-red-500', 'focus:bg-red-500', 'focus:outline-none', 'focus:ring-2', 'focus:ring-pink-500', 'focus:ing-offset-2', 'transition', 'ease-in-out', 'duration-150', 'deletePeriodBtn');
    deleteBtn.textContent = '削除';
    deleteBtn.addEventListener('click', () => {
        window.alert('新規追加された項目なので、データベースの削除はできません。画面をリロードするとリセットできます。');
    });
    formWrapper.appendChild(deleteBtn);
    btn.before(formWrapper);
});
