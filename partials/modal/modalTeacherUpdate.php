<style media="screen">
.w3-modal-content {
  margin: auto;
  background-color: #171717;
  color: white;
  position: relative;
  padding: 0;
  outline: 0;
  width: 900px;
}

.easy-autocomplete input{
  color: #000000 !important;
  float: none;
  padding: 6px 12px;
  width: 213% !important;
}
</style>
<body id="table">
<main class="detalle">
<div>
<div class="w3-container">
  <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <img src="https://www.khanagadi.com/images/user-icon.png" class="img img-responsive img-circle center-block">
      </div>

      <?php include(__DIR__.'/../forms/formTeacher.php'); ?>


    </div>
  </div>
  </div>
</main>
</body>
