import '../common';

const followers = document.querySelectorAll('.follower');
const publicSort = document.getElementById('public-check');
const facultySort = document.querySelectorAll('.faculty-sort');
const gradeSort = document.querySelectorAll('.grade-sort');
const sortItems = document.querySelectorAll('.sort-item');

function follwerSort() {
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
    followers.forEach(follower => {
        let publicCheck = false;
        if (publicSort.checked) {
            publicCheck = true;
        } else {
            if (follower.classList.contains('public')) {
                publicCheck = true;
            }
        }
        let facultyCheck = false;
        facultySortItem.forEach(faculty => {
            if (follower.classList.contains(faculty)) {
                facultyCheck = true;
            }
        });
        let gradeCheck = false;
        gradeSortItem.forEach(grade => {
            if (follower.classList.contains(grade)) {
                gradeCheck = true;
            }
        });
        if (publicCheck && facultyCheck && gradeCheck) {
            follower.classList.remove('hidden');
        } else {
            follower.classList.add('hidden');
        }
    });
}

sortItems.forEach(sortItem => {
    sortItem.addEventListener('change', follwerSort);
});

document.getElementById('all-select').addEventListener('click', () => {
    sortItems.forEach(sortItem => {
        sortItem.checked = true;
    });
    follwerSort();
});

document.getElementById('all-unselect').addEventListener('click', () => {
    sortItems.forEach(sortItem => {
        sortItem.checked = false;
    });
    follwerSort();
});
