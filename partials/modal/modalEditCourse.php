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

</style>
<body id="table">
  <main class="detalle">
      <div>
            <div class="w3-container">
                    <div id="id07" class="w3-modal">
                            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                                    <div class="w3-center"><br>
                                      <span onclick="document.getElementById('id07').style.display='none';
                                      $('#limit-edit-course').html('');
                                      $('#infoPanel2').html('');
                                      $('#quotas_edit_course').val('No');"
                                       class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" >&times;</span>
                                      <img src="/chaea/images/addCourse.png" class="img img-responsive img-circle center-block">
                                    </div>

                                    <?php include(__DIR__.'/../forms/formEditCourse.php'); ?>


                            </div>
                    </div>
            </div>
      </div>
  </main>
</body>
