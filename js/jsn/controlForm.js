
    //Controles para los campos del formulario, mediante codigo ascii.
    //control3 es para correo electronico
    function control3(a) {
      tecla = (document.all) ? a.keyCode : a.which;
      if (tecla == 32 || tecla == 38 || tecla == 43 || tecla == 44 || tecla == 60 || tecla == 61 || tecla == 62) {
        alert('La dirección de correo electrónico no es válida no puede contener: "espacios" - "coma" - "<>" - "&" - "+" - "="');
        return false;
      }



    }

    //control2 para numero de identificación y numero telefonico
    function control2(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;

      if (tecla == 69 || tecla == 101) {
        alert("Porfavor solo numeros");
        return false;
      }

      for (var i = 32; i <= 47; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 58; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }
      if (band == 1) {
        // $('#control2').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Porfavor solo numeros</strong></a> </div>");
        alert("Porfavor solo numeros");
        return false;
      }

    }

    //controla el campo de la universidad y nombre de la persona para que solo sean letras sin numeros
    function control1(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;
      for (var i = 33; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 123; i <= 126; i++) {
        if (tecla == i) {
          band = 1;
        }
      }

      for (var i = 91; i <= 95; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      if (band == 1) {
        // $('#control1').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Porfavor solo letras</strong></a> </div>");
        alert("Porfavor solo letras");
        return false;
      }

    }

    //control3 para nickname solo permite numeros y letras
    function control4(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;
      for (var i = 32; i <= 47; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 58; i <= 64; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }
      for (var i = 91; i <= 95; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      for (var i = 123; i <= 126; i++) {
        if (tecla == i) {
          band = 1;
        }
      }
      if (band == 1) {
        alert("Porfavor solo numeros o lestras ");
        return false;
      }
    }

    //contro5 para las notas
    function control5(a) {
      var band = 0;
      tecla = (document.all) ? a.keyCode : a.which;

      if (tecla == 69 || tecla == 101|| tecla == 47 || tecla == 45) {
        alert("Porfavor solo numeros");
        return false;
      }

      for (var i = 32; i <= 43; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }

      for (var i = 58; i <= 165; i++) {
        if (tecla == i) {
          band = 1;
          break;
        }
      }
      if (band == 1) {
        // $('#control2').html("<div id='oculto' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick='cer();' data-dismiss='alert'>&times;</button><strong>Porfavor solo numeros</strong></a> </div>");
        alert("Porfavor solo numeros");
        return false;
      }

    }
