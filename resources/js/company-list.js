import './common';
import { notLogin, followCompany } from './module/follow';

const loading = document.getElementById('loading');

window.addEventListener('load', () => {
    tabSessionCheck();
    loading.classList.add('fade');
    setTimeout(() => {
        loading.classList.add('hidden');
    }, 600);
});

let path_name = '/' + window.location.pathname.split('/')[1];
if(process.env.NODE_ENV === 'local') {
    path_name = '';
}

document.getElementById('move_page_top').addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
});

document.getElementById('search_btn').addEventListener('click', () => {
    const searchWord = document.getElementById('search').value;
    if (searchWord && searchWord.length > 0) {
        window.location.href = path_name + `/company/list?keyword=${searchWord}`;
    } else {
        window.location.href = path_name + '/company/list';
    }
});

const keyword = document.getElementById('search_keyword');
const faculties = document.querySelectorAll('.search-faculty');
const industries = document.querySelectorAll('.search-industry');
const occupation = document.getElementById('search_occupation');
const capital = document.getElementById('search_capital');
const capitalType = document.getElementById('search_capital_type');
const sales = document.getElementById('search_sales');
const salesType = document.getElementById('search_sales_type');
const employees = document.getElementById('search_employees');
const employeesType = document.getElementById('search_employees_type');
const mieUnivObOg = document.getElementById('search_mie_univ_ob_og');
const mieUnivObOgType = document.getElementById('search_mie_univ_ob_og_type');
const branchOffice = document.querySelectorAll('.search-branch-office');

document.getElementById('reset_btn').addEventListener('click', () => {
    window.location.href = path_name + '/company/list';
});

document.getElementById('detailed_search_btn').addEventListener('click', () => {
    let passingVal = '?';
    if (keyword.value) {
        passingVal += `keyword=${keyword.value}`;
    }
    let facultiesVal = '';
    let facultiesLength = 0;
    faculties.forEach((faculty) => {
        if (faculty.checked) {
            if (facultiesVal.length > 0) facultiesVal += ',';
            facultiesVal += `${faculty.value}`;
            facultiesLength++;
        }
    });
    if (facultiesLength !== Laravel.faculties.length) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `faculties=${facultiesVal}`;
    }
    let industriesVal = '';
    let industriesLength = 0;
    industries.forEach((industry) => {
        if (industry.checked) {
            if (industriesVal.length > 0) industriesVal += ',';
            industriesVal += `${industry.value}`;
            industriesLength++;
        }
    });
    if (industriesLength !== Laravel.industries.length) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `industries=${industriesVal}`;
    }
    if (occupation.value) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `occupation=${occupation.value}`;
    }
    if (capital.value) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `capital=${capital.value}`;
        if (capitalType.value) {
            passingVal += `&capital_type=${capitalType.value}`;
        }
    }
    if (sales.value) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `sales=${sales.value}`;
        if (salesType.value) {
            passingVal += `&sales_type=${salesType.value}`;
        }
    }
    if (employees.value) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `employees=${employees.value}`;
        if (employeesType.value) {
            passingVal += `&employees_type=${employeesType.value}`;
        }
    }
    if (mieUnivObOg.value) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `mie_univ_ob_og=${mieUnivObOg.value}`;
        if (mieUnivObOgType.value) {
            passingVal += `&mie_univ_ob_og_type=${mieUnivObOgType.value}`;
        }
    }
    let branchOfficeVal = '';
    let branchOfficeLength = 0;
    branchOffice.forEach((office) => {
        if (office.checked) {
            if (branchOfficeVal.length > 0) branchOfficeVal += ',';
            branchOfficeVal += `${office.value}`;
            branchOfficeLength++;
        }
    });
    if (branchOfficeLength !== Laravel.prefectures.length) {
        if (passingVal.length > 1) passingVal += '&';
        passingVal += `branch_office=${branchOfficeVal}`;
    }
    if (passingVal.length > 1) {
        window.location.href = path_name + `/company/list${passingVal}`;
    } else {
        window.location.href = path_name + '/company/list';
    }
});

document.querySelectorAll('.all-select').forEach((allSelect) => {
    allSelect.addEventListener('click', () => {
        const target = allSelect.getAttribute('data-target');
        const checkboxes = document.querySelectorAll(`.${target}`);
        checkboxes.forEach((checkbox) => {
            checkbox.checked = true;
        });
    });
});

document.querySelectorAll('.all-cancel').forEach((allCancel) => {
    allCancel.addEventListener('click', () => {
        const target = allCancel.getAttribute('data-target');
        const checkboxes = document.querySelectorAll(`.${target}`);
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
    });
});

document.querySelectorAll('.follow-btn').forEach((followBtn) => {
    if (followBtn.classList.contains('not-login')) {
        followBtn.addEventListener('click', notLogin);
    } else {
        followBtn.addEventListener('click', () => {
            followCompany(followBtn, Laravel.user.api_token);
        });
    }
});

const tabSelect = (tabName) => {
    document.getElementById(tabName).click();
}

const tabSessionCheck = () => {
    const dateTabSession = sessionStorage.getItem('date_tab');
    if (dateTabSession) {
        tabSelect(dateTabSession);
    }
    const periodTabSession = sessionStorage.getItem('period_tab');
    if (periodTabSession) {
        tabSelect(periodTabSession);
    }
    document.querySelectorAll('.date-tab').forEach((dateTab) => {
        dateTab.setAttribute('data-init', 'true');
    });
    document.querySelectorAll('.period-tab').forEach((periodTab) => {
        periodTab.setAttribute('data-init', 'true');
    });
}

const dateTabChange = (el) => {
    sessionStorage.setItem('date_tab', el.id);
    const activePeriod = document.querySelector(el.getAttribute('data-tabs-target') + ' .period-tab[aria-selected="true"]');
    sessionStorage.setItem('period_tab', activePeriod.id);
}

document.querySelectorAll('.date-tab').forEach((dateTab) => {
    dateTab.addEventListener('click', () => {
        if (dateTab.getAttribute('data-init') !== "false") {
            dateTabChange(dateTab);
        }
    });
});

const periodTabChange = (el) => {
    sessionStorage.setItem('period_tab', el.id);
}

document.querySelectorAll('.period-tab').forEach((periodTab) => {
    periodTab.addEventListener('click', () => {
        if (periodTab.getAttribute('data-init') !== "false") {
            periodTabChange(periodTab);
        }
    });
});
