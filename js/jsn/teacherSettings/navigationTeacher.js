document.addEventListener('DOMContentLoaded',navigationTeahcer)

function navigationTeahcer (){
var coursesTeacher = document.getElementById('coursesTeacher')
coursesTeacher.addEventListener('click', function(){
  if(location.href !=='http://localhost:90/chaea/partials/viewTeacher/teacherTableCourse.php'){
    location.href = 'teacherTableCourse.php';
   }

})

var activityTeacher = document.getElementById('activityTeacher')
activityTeacher.addEventListener('click', function(){
   location.href = 'activityTeacher.php';
})


var studentsTeacher = document.getElementById('studentsTeacher')
studentsTeacher.addEventListener('click', function(){
   location.href = 'studentsTeacher.php?';
})

}
