import './common';
import { loader } from './firebase.js';
import { MarkerClusterer } from "@googlemaps/markerclusterer";
import axios from 'axios';
import Editor from '@toast-ui/editor';
import ColorSyntax from '@toast-ui/editor-plugin-color-syntax';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
import '@toast-ui/editor/dist/i18n/ja-jp';
import { notLogin, followCompany } from './module/follow.js';

let headOfficeMap, officeMap, headOfficeMarker, officeMapMarker, infoWindow;

window.addEventListener('load', () => {
    initMap();
});

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
    } else {
        toastUiTarget[key].viewer = new Editor.factory({
            el: document.getElementById(toastUiTarget[key].viewerEl),
            viewer: true,
            plugins: [[ColorSyntax]],
            initialValue: '未入力',
        });
    }
}

document.getElementById('follow_btn').addEventListener('click', (e) => {
    let followBtn = e.target;
    while (followBtn.tagName !== 'BUTTON') {
        followBtn = followBtn.parentNode;
    }
    if (followBtn.classList.contains('not-login')) {
        notLogin();
    } else {
        followCompany(e.target, Laravel.user.api_token);
    }
});
