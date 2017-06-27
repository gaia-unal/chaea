document.addEventListener('DOMContentLoaded',navigationAdmin)

function navigationAdmin (){
var teachers = document.getElementById('teachers')
teachers.addEventListener('click', function(){
   location.href = 'adminTableTeacher.php?';
})

var studentsAdm = document.getElementById('studentsAdm')
studentsAdm.addEventListener('click', function(){
   location.href = 'adminTableStudent.php';
})

var courseAdm = document.getElementById('courseAdm')
courseAdm.addEventListener('click', function(){
   location.href = 'adminTableCourse.php?';
})

var activityAdm = document.getElementById('activityAdm')
activityAdm.addEventListener('click', function(){
   location.href = 'adminTableActivity.php?';
})

}
