import '../common';
import Chart from 'chart.js/auto';

let facultyLabels = [];
let facultyColors = [];
let gradeLabels = [];
let gradeColors = [];
let studentData = {};
let followerData = {};
let visitorData = {};

Laravel.faculties.forEach((faculty) => {
    facultyLabels.push(faculty.faculty_name);
    facultyColors.push(faculty.color);
});

Laravel.grades.forEach((grade) => {
    gradeLabels.push(grade.grade_name);
    gradeColors.push(grade.color);
    studentData[grade.id] = {};
    followerData[grade.id] = {};
    visitorData[grade.id] = {};
    Laravel.faculties.forEach((faculty) => {
        studentData[grade.id][faculty.id] = Laravel.students[faculty.id][grade.id];
        followerData[grade.id][faculty.id] = Laravel.followers[faculty.id][grade.id];
        visitorData[grade.id][faculty.id] = Laravel.visitors[faculty.id][grade.id];
    });
});

const allFacultyChartCanvas = document.getElementById('all_faculty_chart');
const allFacultyChartConfig = {
    type: 'doughnut',
    data: {
        labels: facultyLabels,
        datasets: [{
            data: Laravel.students.faculty,
            backgroundColor: facultyColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const allFacultyChart = new Chart(allFacultyChartCanvas, allFacultyChartConfig);

Laravel.faculties.forEach((faculty) => {
    const facultyChartCanvas = document.getElementById('faculty_chart_' + faculty.id);
    const facultyChartConfig = {
        type: 'doughnut',
        data: {
            labels: gradeLabels,
            datasets: [{
                data: Laravel.students[faculty.id],
                backgroundColor: gradeColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const facultyChart = new Chart(facultyChartCanvas, facultyChartConfig);
});

const allGradeChartCanvas = document.getElementById('all_grade_chart');
const allGradeChartConfig = {
    type: 'doughnut',
    data: {
        labels: gradeLabels,
        datasets: [{
            data: Laravel.students.grade,
            backgroundColor: gradeColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const allGradeChart = new Chart(allGradeChartCanvas, allGradeChartConfig);

Laravel.grades.forEach((grade) => {
    const gradeChartCanvas = document.getElementById('grade_chart_' + grade.id);
    const gradeChartConfig = {
        type: 'doughnut',
        data: {
            labels: facultyLabels,
            datasets: [{
                data: studentData[grade.id],
                backgroundColor: facultyColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const gradeChart = new Chart(gradeChartCanvas, gradeChartConfig);
});

const followerAllFacultyChartCanvas = document.getElementById('follower_all_faculty_chart');
const followerAllFacultyChartConfig = {
    type: 'doughnut',
    data: {
        labels: facultyLabels,
        datasets: [{
            data: Laravel.followers.faculty,
            backgroundColor: facultyColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const followerAllFacultyChart = new Chart(followerAllFacultyChartCanvas, followerAllFacultyChartConfig);

Laravel.faculties.forEach((faculty) => {
    const followerFacultyChartCanvas = document.getElementById('follower_faculty_chart_' + faculty.id);
    const followerFacultyChartConfig = {
        type: 'doughnut',
        data: {
            labels: gradeLabels,
            datasets: [{
                data: Laravel.followers[faculty.id],
                backgroundColor: gradeColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const followerFacultyChart = new Chart(followerFacultyChartCanvas, followerFacultyChartConfig);
});

const followerAllGradeChartCanvas = document.getElementById('follower_all_grade_chart');
const followerAllGradeChartConfig = {
    type: 'doughnut',
    data: {
        labels: gradeLabels,
        datasets: [{
            data: Laravel.followers.grade,
            backgroundColor: gradeColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const followerAllGradeChart = new Chart(followerAllGradeChartCanvas, followerAllGradeChartConfig);

Laravel.grades.forEach((grade) => {
    const followerGradeChartCanvas = document.getElementById('follower_grade_chart_' + grade.id);
    const followerGradeChartConfig = {
        type: 'doughnut',
        data: {
            labels: facultyLabels,
            datasets: [{
                data: followerData[grade.id],
                backgroundColor: facultyColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const followerGradeChart = new Chart(followerGradeChartCanvas, followerGradeChartConfig);
});

const visitorAllFacultyChartCanvas = document.getElementById('visitor_all_faculty_chart');
const visitorAllFacultyChartConfig = {
    type: 'doughnut',
    data: {
        labels: facultyLabels,
        datasets: [{
            data: Laravel.visitors.faculty,
            backgroundColor: facultyColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const visitorAllFacultyChart = new Chart(visitorAllFacultyChartCanvas, visitorAllFacultyChartConfig);

Laravel.faculties.forEach((faculty) => {
    const visitorFacultyChartCanvas = document.getElementById('visitor_faculty_chart_' + faculty.id);
    const visitorFacultyChartConfig = {
        type: 'doughnut',
        data: {
            labels: gradeLabels,
            datasets: [{
                data: Laravel.visitors[faculty.id],
                backgroundColor: gradeColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const visitorFacultyChart = new Chart(visitorFacultyChartCanvas, visitorFacultyChartConfig);
});

const visitorAllGradeChartCanvas = document.getElementById('visitor_all_grade_chart');
const visitorAllGradeChartConfig = {
    type: 'doughnut',
    data: {
        labels: gradeLabels,
        datasets: [{
            data: Laravel.visitors.grade,
            backgroundColor: gradeColors,
            hoverOffset: 10,
        }],
    },
    options: {
        animation: {
            duration: 0,
        },
        plugins: {
            legend: {
                display: false,
            },
        }
    },
}
const visitorAllGradeChart = new Chart(visitorAllGradeChartCanvas, visitorAllGradeChartConfig);

Laravel.grades.forEach((grade) => {
    const visitorGradeChartCanvas = document.getElementById('visitor_grade_chart_' + grade.id);
    const visitorGradeChartConfig = {
        type: 'doughnut',
        data: {
            labels: facultyLabels,
            datasets: [{
                data: visitorData[grade.id],
                backgroundColor: facultyColors,
                hoverOffset: 10,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        },
    }
    const visitorGradeChart = new Chart(visitorGradeChartCanvas, visitorGradeChartConfig);
});
