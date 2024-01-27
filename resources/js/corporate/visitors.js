import '../common';

const visitors = document.querySelectorAll('.visitor');
const publicSort = document.getElementById('public-check');
const facultySort = document.querySelectorAll('.faculty-sort');
const gradeSort = document.querySelectorAll('.grade-sort');
const sortItems = document.querySelectorAll('.sort-item');

function visitorSort() {
    let facultySortItem = [];
    let gradeSortItem = [];
    facultySort.forEach(faculty => {
        if (faculty.checked) {
            facultySortItem.push(faculty.value);
        }
    });
    gradeSort.forEach(grade => {
        if (grade.checked) {
            gradeSortItem.push(grade.value);
        }
    });
    visitors.forEach(visitor => {
        let publicCheck = false;
        if (publicSort.checked) {
            publicCheck = true;
        } else {
            if (visitor.classList.contains('public')) {
                publicCheck = true;
            }
        }
        let facultyCheck = false;
        facultySortItem.forEach(faculty => {
            if (visitor.classList.contains(faculty)) {
                facultyCheck = true;
            }
        });
        let gradeCheck = false;
        gradeSortItem.forEach(grade => {
            if (visitor.classList.contains(grade)) {
                gradeCheck = true;
            }
        });
        if (publicCheck && facultyCheck && gradeCheck) {
            visitor.classList.remove('hidden');
        } else {
            visitor.classList.add('hidden');
        }
    });
}

sortItems.forEach(sortItem => {
    sortItem.addEventListener('change', visitorSort);
});

document.getElementById('all-select').addEventListener('click', () => {
    sortItems.forEach(sortItem => {
        sortItem.checked = true;
    });
    visitorSort();
});

document.getElementById('all-unselect').addEventListener('click', () => {
    sortItems.forEach(sortItem => {
        sortItem.checked = false;
    });
    visitorSort();
});
