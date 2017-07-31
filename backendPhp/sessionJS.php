<script type="text/javascript">
document.addEventListener('DOMContentLoaded',session)
function session(){
  var role='<?php echo $_SESSION["rol"] ?>';
  var nickname ='<?php echo $_SESSION["nickname"] ?>';
  if(role!=''){
  $('#inis').replaceWith('');
  $('#regist').replaceWith('<a id="regist" href="/chaea/logingIndex.php">Salir</a>');
  if(role=='administrator'){
      $('#perfil').replaceWith('  <li><a class="btn  btn-un navbar-right  dropdown-toggle " href="/chaea/adminIndex.php"  role="button">'+nickname+'</a></li>');
  }else if (role=='teacher') {
    $('#perfil').replaceWith('  <li><a class="btn  btn-un navbar-right  dropdown-toggle " href="/chaea/partials/viewTeacher/teacherIndex.php"  role="button">'+nickname+'</a></li>');
  }else if (role=='student') {
    $('#perfil').replaceWith('  <li><a class="btn  btn-un navbar-right  dropdown-toggle " href="/chaea/partials/viewStudent/studentIndex.php"  role="button">'+nickname+'</a></li>');
  }
}
}
</script>
