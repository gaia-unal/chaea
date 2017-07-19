document.addEventListener('DOMContentLoaded',navigationAdmin)

function navigationAdmin (){
var teachers = document.getElementById('teachers')
teachers.addEventListener('click', function(){
   location.href = '/chaea/adminTableTeacher.php?';
})

var studentsAdm = document.getElementById('studentsAdm')
studentsAdm.addEventListener('click', function(){
   location.href = '/chaea/adminTableStudent.php';
})

var courseAdm = document.getElementById('courseAdm')
courseAdm.addEventListener('click', function(){
   location.href = '/chaea/adminTableCourse.php';
})

var activityAdm = document.getElementById('activityAdm')
activityAdm.addEventListener('click', function(){
   location.href = '/chaea/adminTableActivity.php';
})
var strategyAdm = document.getElementById('strategyAdm')
strategyAdm.addEventListener('click', function(){
   location.href = '/chaea/partials/viewAdmin/adminTableStrategy.php';
})

}
