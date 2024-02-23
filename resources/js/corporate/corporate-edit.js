import '../common';
import { loader } from '../firebase.js';
import { MarkerClusterer } from "@googlemaps/markerclusterer";
import axios from 'axios';
import Editor from '@toast-ui/editor';
import ColorSyntax from '@toast-ui/editor-plugin-color-syntax';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
import '@toast-ui/editor/dist/i18n/ja-jp';

const modal = document.getElementById('modalWrapper');
const indicator = document.getElementById('indicator');
const errorIndicator = document.getElementById('errorIndicator');
const csrf = document.querySelector('input[name="_token"]').value;
const company_id = document.getElementById('company_id').value;
const api_token = document.getElementById('api_token').value;
let headOfficeMap, officeMap, headOfficeEditMap, branchOfficeEditMap, headOfficeMarker, officeMapMarker, headOfficeEditMapMarker, branchOfficeEditMapMarker, infoWindow;

function modalOpen(target) {
    modal.classList.remove('hidden');
    document.querySelectorAll('.modal-item').forEach((el) => {
        el.classList.add('hidden');
    });
    document.getElementById(target).classList.remove('hidden');
}

function modalClose() {
    modal.classList.add('hidden');
    window.location.reload();
}
document.getElementById('modalClose').addEventListener('click', () => {
    modalClose();
});

function indicatorPost() {
    indicator.innerText = '送信中';
    indicator.classList.remove('text-green-500', 'bg-green-100', 'text-red-500', 'bg-red-100');
}

function indicatorSuccess() {
    indicator.classList.remove('text-green-500', 'bg-green-100', 'text-red-500', 'bg-red-100');
    indicator.innerText = '更新完了';
    indicator.classList.add('text-green-500', 'bg-green-100');
}

function indicatorError() {
    indicator.classList.remove('text-green-500', 'bg-green-100', 'text-red-500', 'bg-red-100');
    indicator.innerText = '更新失敗';
    indicator.classList.add('text-red-500', 'bg-red-100');
}

function errorIndicatorShow(errors) {
    console.log(errors)
    errorIndicator.classList.remove('hidden');
    errorIndicator.innerHTML = '';
    for (const key in errors) {
        errorIndicator.innerHTML += '<li class="text-sm text-red-500">' + errors[key] + '</li>';
    }
}

function errorIndicatorHide() {
    errorIndicator.classList.add('hidden');
}

window.addEventListener('load', () => {
    setEditCover();
    initMap();
});

function setEditCover() {
    document.querySelectorAll('.edit-cover').forEach((el) => {
        el.addEventListener('click', () => {
            modalOpen(el.getAttribute('data-target'));
        });
    });
}

function initMap() {
    try {
        loader.load().then(() => {
            let LatList = [];
            let LngList = [];
            const headOffice = new google.maps.LatLng(Laravel.company.head_office_lat, Laravel.company.head_office_lng);
            let branchOffices = [];
            let branchOfficeMarkers = [];
            if (Laravel.branch_offices !== null) {
                Laravel.branch_offices.forEach((data) => {
                    branchOffices.push(new google.maps.LatLng(data.office_lat, data.office_lng));
                    let branchOfficeMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(data.office_lat, data.office_lng),
                        title: data.office_name,
                        address: data.office_address,
                        office_id: data.id,
                        animation: google.maps.Animation.DROP,
                        draggable: true,
                    });
                    branchOfficeMarker.addListener('dragend', () => {
                        document.getElementById('branch_office_lat-' + data.id).value = branchOfficeMarker.getPosition().lat();
                        document.getElementById('branch_office_lng-' + data.id).value = branchOfficeMarker.getPosition().lng();
                    });
                    branchOfficeMarker.addListener('click', () => {
                        if (infoWindow) {
                            infoWindow.close();
                        }
                        infoWindow = new google.maps.InfoWindow({
                            content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">' + data.office_name + '</div></div><div>' + data.office_address + '</div></div>',
                            disableAutoPan: true,
                        });
                        infoWindow.open(officeMap, branchOfficeMarker);
                    });
                    branchOfficeMarkers.push(branchOfficeMarker);
                    LatList.push(data.office_lat);
                    LngList.push(data.office_lng);
                });
            }
            headOfficeMap = new google.maps.Map(document.getElementById('head_office_map'), {
                zoom: 16,
                center: headOffice,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: false,
                gestureHandling: 'greedy',
            });
            headOfficeMarker = new google.maps.Marker({
                position: headOffice,
                title: '本社',
                animation: google.maps.Animation.DROP,
                map: headOfficeMap,
            });
            headOfficeMarker.addListener('click', () => {
                if (infoWindow) {
                    infoWindow.close();
                }
                infoWindow = new google.maps.InfoWindow({
                    content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">本社</div></div><div>' + Laravel.company.head_office_address + '</div></div>',
                    disableAutoPan: true,
                });
                infoWindow.open(headOfficeMap, headOfficeMarker);
            });
            headOfficeEditMap = new google.maps.Map(document.getElementById('head_office_edit_map'), {
                zoom: 16,
                center: headOffice,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: false,
                gestureHandling: 'greedy',
            });
            headOfficeEditMapMarker = new google.maps.Marker({
                position: headOffice,
                title: '本社',
                animation: google.maps.Animation.DROP,
                map: headOfficeEditMap,
                draggable: true,
            });
            headOfficeEditMapMarker.addListener('dragend', () => {
                headOfficeEditMap.setCenter(headOfficeEditMapMarker.getPosition());
            });
            headOfficeEditMapMarker.addListener('click', () => {
                if (infoWindow) {
                    infoWindow.close();
                }
                infoWindow = new google.maps.InfoWindow({
                    content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">本社</div></div><div>' + Laravel.company.head_office_address + '</div></div>',
                    disableAutoPan: true,
                });
                infoWindow.open(headOfficeEditMap, headOfficeEditMapMarker);
            });
            officeMap = new google.maps.Map(document.getElementById('office_map'), {
                zoom: 16,
                center: headOffice,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: false,
                gestureHandling: 'greedy',
            });
            officeMapMarker = new MarkerClusterer({
                map: officeMap,
                markers: branchOfficeMarkers,
                gridSize: 50,
                minimumClusterSize: 2,
                averageCenter: true,
            });
            if (LatList.length > 1 && LngList.length > 1) {
                const bounds = new google.maps.LatLngBounds();
                for (let i = 0; i < LatList.length; i++) {
                    bounds.extend(new google.maps.LatLng(LatList[i], LngList[i]));
                }
                officeMap.fitBounds(bounds);
                if (officeMap.getZoom() > 16) {
                    officeMap.setZoom(16);
                }
            } else {
                officeMap.setCenter(headOffice);
                officeMap.setZoom(16);
            }
            branchOfficeEditMap = new google.maps.Map(document.getElementById('branch_office_edit_map'), {
                zoom: 16,
                center: headOffice,
                mapTypeControl: false,
                fullscreenControl: false,
                streetViewControl: false,
                gestureHandling: 'greedy',
            });
            branchOfficeEditMapMarker = new MarkerClusterer({
                map: branchOfficeEditMap,
                markers: branchOfficeMarkers,
                gridSize: 50,
                minimumClusterSize: 2,
                averageCenter: true,
            });
            if (LatList.length > 1 && LngList.length > 1) {
                const bounds = new google.maps.LatLngBounds();
                for (let i = 0; i < LatList.length; i++) {
                    bounds.extend(new google.maps.LatLng(LatList[i], LngList[i]));
                }
                branchOfficeEditMap.fitBounds(bounds);
                if (branchOfficeEditMap.getZoom() > 16) {
                    branchOfficeEditMap.setZoom(16);
                }
            } else {
                branchOfficeEditMap.setCenter(headOffice);
                branchOfficeEditMap.setZoom(16);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

// Viewerの初期化
const toastUiTarget = {
    business_detail: {
        id: 'business_detail',
        viewer: null,
        viewerEl: 'business_detail_viewer',
        editor: null,
        editorEl: 'business_detail_editor',
        data: Laravel.company.business_detail,
        btn: 'business_detail_btn',
    },
    pr: {
        id: 'pr',
        viewer: null,
        viewerEl: 'pr_viewer',
        editor: null,
        editorEl: 'pr_editor',
        data: Laravel.company.pr,
        btn: 'pr_btn',
    },
    job_detail: {
        id: 'job_detail',
        viewer: null,
        viewerEl: 'job_detail_viewer',
        editor: null,
        editorEl: 'job_detail_editor',
        data: Laravel.company.job_detail,
        btn: 'job_detail_btn',
    },
}
for(const key in toastUiTarget) {
    if (toastUiTarget[key].data !== null) {
        toastUiTarget[key].viewer = new Editor.factory({
            el: document.getElementById(toastUiTarget[key].viewerEl),
            viewer: true,
            plugins: [[ColorSyntax]],
            initialValue: toastUiTarget[key].data,
        });
        toastUiTarget[key].editor = new Editor({
            el: document.getElementById(toastUiTarget[key].editorEl),
            plugins: [[ColorSyntax]],
            initialValue: toastUiTarget[key].data,
            height: '300px',
            initialEditType: 'wysiwyg',
            language: 'ja',
        });
    } else {
        toastUiTarget[key].viewer = new Editor.factory({
            el: document.getElementById(toastUiTarget[key].viewerEl),
            viewer: true,
            plugins: [[ColorSyntax]],
            initialValue: '未入力',
        });
        toastUiTarget[key].editor = new Editor({
            el: document.getElementById(toastUiTarget[key].editorEl),
            plugins: [[ColorSyntax]],
            height: '300px',
            initialEditType: 'wysiwyg',
            language: 'ja',
        });
    }
    document.getElementById(toastUiTarget[key].btn).addEventListener('click', () => {
        toastUiEdit(toastUiTarget[key]);
    });
}

// 企業名の変更
document.getElementById('company_name_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const sendData = {
        company_name: document.getElementById('company_name_input').value,
        company_name_ruby: document.getElementById('company_name_ruby_input').value,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/company_name_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_name').innerText = res.data.company_name;
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
})

// 企業業種の変更
document.getElementById('company_industry_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const sendData = {
        industry_id: document.getElementById('company_industry_input').value,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/company_industry_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('industry_name_head').innerText = res.data.industry.industry_name;
                document.getElementById('industry_name').innerText = res.data.industry.industry_name;
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

// 企業ロゴの変更
document.getElementById('company_logo_input_wrapper').addEventListener('click', () => {
    document.getElementById('company_logo_input').click();
});

document.getElementById('company_logo_input').addEventListener('change', (e) => {
    const reader = new FileReader();
    const file = e.target.files[0];
    reader.addEventListener('load', (e) => {
        document.getElementById('company_logo_preview').src = e.target.result;
    });
    reader.readAsDataURL(file);
});

document.getElementById('company_logo_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const fileEl = document.getElementById('company_logo_input');
    if (fileEl.files.length === 0) {
        indicatorError();
        errorIndicatorShow(['画像を選択してください']);
        return;
    }
    const sendData = new FormData();
    sendData.append('company_logo', fileEl.files[0]);
    sendData.append('company_id', company_id);
    sendData.append('_token', csrf);
    axios.post('/' + Laravel.route + '/api/company_logo_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_logo').src = '/storage/company/' + res.data.company.id + '/' + res.data.company.company_logo + '?token=' + new Date().getTime();
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

// 企業イメージ画像の変更
document.getElementById('company_img_input_wrapper').addEventListener('click', () => {
    document.getElementById('company_img_input').click();
});

document.getElementById('company_img_input').addEventListener('change', (e) => {
    const reader = new FileReader();
    const file = e.target.files[0];
    reader.addEventListener('load', (e) => {
        document.getElementById('company_img_preview').src = e.target.result;
    });
    reader.readAsDataURL(file);
});

document.getElementById('company_img_btn').addEventListener('click', () => {
    indicatorPost();
    errorIndicatorHide();
    const fileEl = document.getElementById('company_img_input');
    if (fileEl.files.length === 0) {
        indicatorError();
        errorIndicatorShow(['画像を選択してください']);
        return;
    }
    const sendData = new FormData();
    sendData.append('company_img', fileEl.files[0]);
    sendData.append('company_id', company_id);
    sendData.append('_token', csrf);
    axios.post('/' + Laravel.route + '/api/company_img_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                document.getElementById('company_img').src = '/storage/company/' + res.data.company.id + '/' + res.data.company.company_img + '?token=' + new Date().getTime();
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

function toastUiEdit(target) {
    let sendData = {
        company_id: company_id,
    };
    sendData[target.id] = target.editor.getMarkdown();
    axios.post('/' + Laravel.route + '/api/' + target.id + '_edit?api_token=' + api_token, sendData)
        .then((res) => {
            if (res.data.success) {
                target.viewer.setMarkdown(res.data.company[target.id]);
                indicatorSuccess();
            }
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
}

// 募集職種の変更・追加
document.getElementById('occupation-add').addEventListener('click', () => {
    let targetId = -1;
    while (document.querySelector('.occupation-input[data-id="' + targetId + '"]') !== null) {
        targetId--;
    }
    axios.get('/' + Laravel.route + '/api/occupation_item_add?api_token=' + api_token + '&company_id=' + company_id + '&id=' + targetId)
        .then((res) => {
            console.log(res.data);
            const parser = new DOMParser();
            const doc = parser.parseFromString(res.data.doc, 'text/html');
            const insertPoint = document.getElementById('occupation_insert_point');
            insertPoint.innerHTML += doc.body.innerHTML;
            document.querySelector('.occupation-input[data-id="' + targetId + '"]').addEventListener('keyup', (el) => {
                occupationInputReflection(el.target);
            });
            document.querySelector('.occupation-delete[data-id="' + targetId + '"]').addEventListener('click', (el) => {
                occupationDelete(el.target);
            });
        })
        .catch((error) => {
            console.log(error);
        });
});

document.querySelectorAll('.occupation-input').forEach((el) => {
    el.addEventListener('keyup', () => {
        occupationInputReflection(el);
    });
});

function occupationInputReflection(target) {
    target.setAttribute('value', target.value);
}

document.querySelectorAll('.occupation-delete').forEach((el) => {
    el.addEventListener('click', () => {
        occupationDelete(el);
    });
});

function occupationDelete(target) {
    const targetId = Number(target.getAttribute('data-id'));
    if (targetId > 0) {
        axios.delete('/' + Laravel.route + '/api/occupation_item_delete/' + targetId + '?api_token=' + api_token)
            .then((res) => {
                console.log(res.data);
                document.querySelector('.occupation-item[data-id="' + targetId + '"]').remove();
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        document.querySelector('.occupation-item[data-id="' + targetId + '"]').remove();
    }
}

document.getElementById('occupation_btn').addEventListener('click', () => {
    let occupations = [];
    document.querySelectorAll('.occupation-input').forEach((el) => {
        if (el.value !== '') {
            occupations.push({
                id: Number(el.getAttribute('data-id')),
                recruit_occupation: el.value,
            });
        }
    });
    const sendData = {
        occupations: occupations,
        company_id: company_id,
    };
    console.log(sendData);
    axios.post('/' + Laravel.route + '/api/occupation_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            const occupation = document.querySelector('#occupation ul');
            occupation.innerHTML = '';
            res.data.occupations.forEach((el) => {
                occupation.innerHTML += '<li>' + el.recruit_occupation + '</li>';
            });
            const parser = new DOMParser();
            const insertPoint = document.getElementById('occupation_insert_point');
            insertPoint.innerHTML = '';
            res.data.doc.forEach((docData) => {
                const doc = parser.parseFromString(docData, 'text/html');
                insertPoint.innerHTML += doc.body.innerHTML;
            });
            document.querySelectorAll('.occupation-input').forEach((el) => {
                el.addEventListener('keyup', () => {
                    occupationInputReflection(el);
                });
            });
            document.querySelectorAll('.occupation-delete').forEach((el) => {
                el.addEventListener('click', () => {
                    occupationDelete(el);
                });
            });
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

// 対象学生の編集
document.getElementById('target_btn').addEventListener('click', () => {
    let targets = [];
    document.querySelectorAll('.target-input').forEach((el) => {
        if (el.checked) {
            targets.push({
                id: Number(el.value),
            });
        }
    });
    const sendData = {
        targets: targets,
        company_id: company_id,
    };
    console.log(sendData);
    axios.post('/' + Laravel.route + '/api/target_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            const target = document.querySelector('#faculty ul');
            target.innerHTML = '';
            res.data.targets.forEach((el) => {
                target.innerHTML += '<li>' + el.faculty_name + '</li>';
            });
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
            const errors = error.response.data.errors;
            errorIndicatorShow(errors);
        });
});

document.getElementById('head_office_map_btn').addEventListener('click', () => {
    const address = document.getElementById('head_office_address_input').value;
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === 'OK') {
            headOfficeEditMap.setCenter(results[0].geometry.location);
            headOfficeEditMap.setZoom(16);
            headOfficeEditMapMarker.setPosition(results[0].geometry.location);
            window.alert('本社の位置情報を変更しました。\n変更を保存する場合は「更新」ボタンを押してください。');
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
            window.alert('本社の位置情報を変更できませんでした。\n住所を確認してください。');
        }
    });
});

document.getElementById('head_office_address_btn').addEventListener('click', () => {
    indicatorPost();
    const address = document.getElementById('head_office_address_input').value;
    const lat = headOfficeEditMapMarker.getPosition().lat();
    const lng = headOfficeEditMapMarker.getPosition().lng();
    const sendData = {
        head_office_address: address,
        head_office_lat: lat,
        head_office_lng: lng,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/head_office_address_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            document.getElementById('head_office_address').innerText = res.data.company.head_office_address;
            const headOffice = new google.maps.LatLng(res.data.company.head_office_lat, res.data.company.head_office_lng);
            headOfficeMarker.setPosition(headOffice);
            headOfficeMap.setCenter(headOffice);
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('established_at_btn').addEventListener('click', () => {
    indicatorPost();
    const establishedAtYear = document.getElementById('established_at_year_input').value;
    const establishedAtMonth = document.getElementById('established_at_month_input').value;
    const sendData = {
        established_at: establishedAtYear + '-' + ('00' + establishedAtMonth).slice(-2) + '-01',
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/established_at_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            const establishedAt = new Date(res.data.company.established_at);
            document.getElementById('established_at').innerText = establishedAt.getFullYear() + '年' + (establishedAt.getMonth() + 1) + '月';
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('capital_btn').addEventListener('click', () => {
    indicatorPost();
    const capital = document.getElementById('capital_input').value;
    const sendData = {
        capital: capital,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/capital_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            document.getElementById('capital').innerText = res.data.company.capital + '万円';
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('sales_input_null').addEventListener('change', (e) => {
    const input = document.getElementById('sales_input');
    if(e.target.checked) {
        input.disabled = true;
        input.classList.add('bg-gray-300');
    } else {
        input.disabled = false;
        input.classList.remove('bg-gray-300');
    }
});

document.getElementById('sales_btn').addEventListener('click', () => {
    indicatorPost();
    let sendData = {
        company_id: company_id,
    };
    if (document.getElementById('sales_input_null').checked) {
        sendData['sales'] = null;
    } else {
        sendData['sales'] = document.getElementById('sales_input').value;
    }
    axios.post('/' + Laravel.route + '/api/sales_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            if (res.data.company.sales === null) {
                document.getElementById('sales').innerText = '非公開';
            } else {
                document.getElementById('sales').innerText = res.data.company.sales + '万円';
            }
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('employees_btn').addEventListener('click', () => {
    indicatorPost();
    const employees = document.getElementById('employees_input').value;
    const sendData = {
        employees: employees,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/employees_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            document.getElementById('employees').innerText = res.data.company.employees + '人';
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('mie_univ_ob_og_btn').addEventListener('click', () => {
    indicatorPost();
    const mieUnivObOg = document.getElementById('mie_univ_ob_og_input').value;
    const sendData = {
        mie_univ_ob_og: mieUnivObOg,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/mie_univ_ob_og_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            document.getElementById('mie_univ_ob_og').innerText = res.data.company.mie_univ_ob_og + '人';
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('planned_number_input_null').addEventListener('change', (e) => {
    const input = document.getElementById('planned_number_input');
    if(e.target.checked) {
        input.disabled = true;
        input.classList.add('bg-gray-300');
    } else {
        input.disabled = false;
        input.classList.remove('bg-gray-300');
    }
});

document.getElementById('planned_number_btn').addEventListener('click', () => {
    indicatorPost();
    let sendData = {
        company_id: company_id,
    };
    if (document.getElementById('planned_number_input_null').checked) {
        sendData['planned_number'] = null;
    } else {
        sendData['planned_number'] = document.getElementById('planned_number_input').value;
    }
    axios.post('/' + Laravel.route + '/api/planned_number_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            if (res.data.company.planned_number === null) {
                document.getElementById('planned_number').innerText = '未定';
                document.getElementById('planned_number_input').value = '';
            } else {
                document.getElementById('planned_number').innerText = res.data.company.planned_number + '人程度';
            }
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

function branchMapMarkerUpdate(offices) {
    branchOfficeEditMapMarker.clearMarkers();
    let branchOfficeMarkers = [];
    offices.forEach((data) => {
        let branchOfficeMarker = new google.maps.Marker({
            position: new google.maps.LatLng(data.office_lat, data.office_lng),
            title: data.office_name,
            address: data.office_address,
            office_id: data.id,
            animation: google.maps.Animation.DROP,
            draggable: true,
        });
        branchOfficeMarker.addListener('dragend', () => {
            document.getElementById('branch_office_lat_' + data.id).value = branchOfficeMarker.getPosition().lat();
            document.getElementById('branch_office_lng_' + data.id).value = branchOfficeMarker.getPosition().lng();
        });
        branchOfficeMarker.addListener('click', () => {
            if (infoWindow) {
                infoWindow.close();
            }
            infoWindow = new google.maps.InfoWindow({
                content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">' + data.office_name + '</div></div><div>' + data.office_address + '</div></div>',
                disableAutoPan: true,
            });
            infoWindow.open(branchOfficeEditMap, branchOfficeMarker);
        });
        branchOfficeMarkers.push(branchOfficeMarker);
    });
    branchOfficeEditMapMarker.addMarkers(branchOfficeMarkers);
}

const branchInsertHeadOfficeBtn = document.getElementById('branch_insert_head_office_btn');
if (branchInsertHeadOfficeBtn) {
    document.getElementById('branch_insert_head_office_btn').addEventListener('click', () => {
        const sendData = {
            company_id: company_id,
        };
        axios.post('/' + Laravel.route + '/api/branch_insert_head_office?api_token=' + api_token, sendData)
            .then((res) => {
                console.log(res.data);
                const parser = new DOMParser();
                const insertPoint = document.getElementById('branch_office_body');
                insertPoint.innerHTML = '';
                res.data.doc.forEach((docData) => {
                    const doc = parser.parseFromString(docData, 'text/html');
                    insertPoint.innerHTML += doc.body.innerHTML;
                });
                document.querySelectorAll('.branch-office-delete').forEach((el) => {
                    el.addEventListener('click', () => {
                        branchOfficeDelete(el);
                    });
                });
                branchMapMarkerUpdate(res.data.branch_offices);
            })
            .catch((error) => {
                console.log(error);
            });
    });
}

document.querySelectorAll('.branch-office-delete').forEach((el) => {
    el.addEventListener('click', () => {
        branchOfficeDelete(el);
    });
});

function branchOfficeDelete(target) {
    const targetId = Number(target.getAttribute('data-id'));
    if (targetId > 0) {
        axios.delete('/' + Laravel.route + '/api/branch_office_delete/' + targetId + '/' + company_id + '?api_token=' + api_token)
            .then((res) => {
                console.log(res.data);
                document.querySelector('.branch-office-item[data-id="' + targetId + '"]').remove();
                branchMapMarkerUpdate(res.data.branch_offices);
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        document.querySelector('.branch-office-item[data-id="' + targetId + '"]').remove();
        initMap();
    }
}

document.getElementById('branch_office_add').addEventListener('click', () => {
    indicatorPost();
    let target = 0;
    while (document.querySelector('.branch-office-item[data-id="' + target + '"]') !== null) {
        target--;
    }
    axios.get('/' + Laravel.route + '/api/branch_office_add/' + target + '?api_token=' + api_token)
        .then((res) => {
            console.log(res.data);
            const parser = new DOMParser();
            const insertPoint = document.getElementById('branch_office_body');
            const doc = parser.parseFromString(res.data.doc, 'text/html');
            insertPoint.innerHTML += doc.body.innerHTML;
            document.querySelector('.branch-office-delete[data-id="' + target + '"]').addEventListener('click', (e) => {
                branchOfficeDelete(e.target);
            });
            branchOfficeInputReflection(target);
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

function branchOfficeInputReflection(target) {
    document.getElementById('branch_office_name_input-' + target).addEventListener('keyup', (e) => {
        e.target.setAttribute('value', e.target.value);
    });
    document.getElementById('branch_office_address_input-' + target).addEventListener('keyup', (e) => {
        e.target.setAttribute('value', e.target.value);
    });
}

document.getElementById('branch_office_map_btn').addEventListener('click', () => {
    let branchOfficeMarkers = [];
    let LatList = [];
    let LngList = [];
    let greenFlag = true;
    const geocoder = new google.maps.Geocoder();
    const branchOfficeItem = document.querySelectorAll('.branch-office-item');
    const branchOfficeItemCount = branchOfficeItem.length;
    branchOfficeItem.forEach((el) => {
        const targetId = Number(el.getAttribute('data-id'));
        const officeName = document.getElementById('branch_office_name_input-' + targetId).value;
        const address = document.getElementById('branch_office_address_input-' + targetId).value;
        if (targetId > 0) {
            const lat = document.getElementById('branch_office_lat-' + targetId).value;
            const lng = document.getElementById('branch_office_lng-' + targetId).value;
            LatList.push(lat);
            LngList.push(lng);
            const branchOfficeMarker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                title: document.getElementById('branch_office_name_input-' + targetId).value,
                address: document.getElementById('branch_office_address_input-' + targetId).value,
                office_id: targetId,
                animation: google.maps.Animation.DROP,
                draggable: true,
            });
            branchOfficeMarker.addListener('dragend', () => {
                document.getElementById('branch_office_lat-' + targetId).value = branchOfficeMarker.getPosition().lat();
                document.getElementById('branch_office_lng-' + targetId).value = branchOfficeMarker.getPosition().lng();
            });
            branchOfficeMarker.addListener('click', () => {
                if (infoWindow) {
                    infoWindow.close();
                }
                infoWindow = new google.maps.InfoWindow({
                    content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">' + document.getElementById('branch_office_name_input-' + targetId).value + '</div></div><div>' + document.getElementById('branch_office_address_input-' + targetId).value + '</div></div>',
                    disableAutoPan: true,
                });
                infoWindow.open(branchOfficeEditMap, branchOfficeMarker);
            });
            branchOfficeMarkers.push(branchOfficeMarker);
        } else {
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === 'OK') {
                    document.getElementById('branch_office_lat-' + targetId).value = results[0].geometry.location.lat();
                    document.getElementById('branch_office_lng-' + targetId).value = results[0].geometry.location.lng();
                    LatList.push(results[0].geometry.location.lat());
                    LngList.push(results[0].geometry.location.lng());
                    const branchOfficeMarker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        title: document.getElementById('branch_office_name_input-' + targetId).value,
                        address: document.getElementById('branch_office_address_input-' + targetId).value,
                        office_id: null,
                        animation: google.maps.Animation.DROP,
                        draggable: true,
                    });
                    branchOfficeMarker.addListener('dragend', () => {
                        document.getElementById('branch_office_lat-' + targetId).value = branchOfficeMarker.getPosition().lat();
                        document.getElementById('branch_office_lng-' + targetId).value = branchOfficeMarker.getPosition().lng();
                    });
                    branchOfficeMarker.addListener('click', () => {
                        if (infoWindow) {
                            infoWindow.close();
                        }
                        infoWindow = new google.maps.InfoWindow({
                            content: '<div class="flex flex-col justify-start gap-2"><div><div class="inline-flex items-center h-5 text-xs text-white bg-[#6787C4] px-4 rounded">' + document.getElementById('branch_office_name_input-' + targetId).value + '</div></div><div>' + document.getElementById('branch_office_address_input-' + targetId).value + '</div></div>',
                            disableAutoPan: true,
                        });
                        infoWindow.open(branchOfficeEditMap, branchOfficeMarker);
                    });
                    branchOfficeMarkers.push(branchOfficeMarker);
                } else {
                    console.log('Geocode was not successful for the following reason: ' + status);
                    window.alert(officeName + 'の検索に失敗しました。\n住所を確認してください。');
                }
            });
        }
    });
    let setBranchOfficeEditMarkers = setInterval(() => {
        if (greenFlag) {
            if (branchOfficeItemCount === branchOfficeMarkers.length) {
                branchOfficeEditMapMarker.clearMarkers();
                branchOfficeEditMapMarker.addMarkers(branchOfficeMarkers);
                if (LatList.length > 1 && LngList.length > 1) {
                    const bounds = new google.maps.LatLngBounds();
                    for (let i = 0; i < LatList.length; i++) {
                        bounds.extend(new google.maps.LatLng(LatList[i], LngList[i]));
                    }
                    branchOfficeEditMap.fitBounds(bounds);
                    if (branchOfficeEditMap.getZoom() > 16) {
                        branchOfficeEditMap.setZoom(16);
                    }
                } else {
                    branchOfficeEditMap.setCenter(headOfficeEditMapMarker.getPosition());
                    branchOfficeEditMap.setZoom(16);
                }
                clearInterval(setBranchOfficeEditMarkers);
            }
        } else {
            window.alert('住所の検索に失敗しました。\n住所を確認してください。');
            clearInterval(setBranchOfficeEditMarkers);
        }
    }, 200);
});

document.getElementById('branch_offices_btn').addEventListener('click', () => {
    console.log(branchOfficeEditMapMarker.markers);
    let branchOffices = [];
    branchOfficeEditMapMarker.markers.forEach((el) => {
        branchOffices.push({
            id: el.office_id,
            office_name: el.title,
            office_address: el.address,
            office_lat: el.getPosition().lat(),
            office_lng: el.getPosition().lng(),
        });
    });
    const sendData = {
        branch_offices: branchOffices,
        company_id: company_id,
    };
    axios.post('/' + Laravel.route + '/api/branch_office_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            const parser = new DOMParser();
            const insertPoint = document.getElementById('branch_office_body');
            insertPoint.innerHTML = '';
            res.data.doc.forEach((docData) => {
                const doc = parser.parseFromString(docData, 'text/html');
                insertPoint.innerHTML += doc.body.innerHTML;
            });
            document.querySelectorAll('.branch-office-delete').forEach((el) => {
                el.addEventListener('click', () => {
                    branchOfficeDelete(el);
                });
            });
            branchMapMarkerUpdate(res.data.branch_offices);
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('recruit_in_charge_tel_input_null').addEventListener('change', (e) => {
    const input = document.getElementById('recruit_in_charge_tel_input');
    if(e.target.checked) {
        input.disabled = true;
        input.classList.add('bg-gray-300');
    } else {
        input.disabled = false;
        input.classList.remove('bg-gray-300');
    }
});

document.getElementById('recruit_in_charge_btn').addEventListener('click', () => {
    let tel = null;
    if (!document.getElementById('recruit_in_charge_tel_input_null').checked) {
        tel = document.getElementById('recruit_in_charge_tel_input').value;
    }
    const sendData = {
        recruit_department: document.getElementById('recruit_department_input').value,
        recruit_in_charge_person: document.getElementById('recruit_in_charge_person_input').value,
        recruit_in_charge_person_ruby: document.getElementById('recruit_in_charge_person_ruby_input').value,
        recruit_in_charge_tel: tel,
        recruit_in_charge_email: document.getElementById('recruit_in_charge_email_input').value,
        company_id: company_id,
    }
    axios.post('/' + Laravel.route + '/api/recruit_in_charge_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            document.getElementById('recruit_department').innerText = res.data.company.recruit_department;
            document.getElementById('recruit_in_charge_person').innerText = res.data.company.recruit_in_charge_person + '（' + res.data.company.recruit_in_charge_person_ruby + '）';
            if (res.data.company.recruit_in_charge_tel === null) {
                document.getElementById('recruit_in_charge_tel').innerText = '非公開';
            } else {
                document.getElementById('recruit_in_charge_tel').innerText = res.data.company.recruit_in_charge_tel;
            }
            document.getElementById('recruit_in_charge_email').innerText = res.data.company.recruit_in_charge_email;
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});

document.getElementById('url_input_null').addEventListener('change', (e) => {
    const input = document.getElementById('url_input');
    if(e.target.checked) {
        input.disabled = true;
        input.classList.add('bg-gray-300');
    } else {
        input.disabled = false;
        input.classList.remove('bg-gray-300');
    }
});

document.getElementById('url_btn').addEventListener('click', () => {
    let url = null;
    if (!document.getElementById('url_input_null').checked) {
        url = document.getElementById('url_input').value;
    }
    const sendData = {
        url: url,
        company_id: company_id,
    }
    axios.post('/' + Laravel.route + '/api/url_edit?api_token=' + api_token, sendData)
        .then((res) => {
            console.log(res.data);
            if (res.data.company.url === null) {
                document.getElementById('url').innerText = '未入力';
            } else {
                document.getElementById('url').innerHTML = '<a href="' + res.data.company.url + '" target="_blank">Webサイトを見る</a>';
            }
            indicatorSuccess();
        })
        .catch((error) => {
            indicatorError();
            console.log(error);
        });
});
