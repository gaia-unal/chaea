/*globals window, document, $*/

$('#book').ready(function () {
'use strict';
var module = { ratio: 1.38,

    init: function (id) {
        var me = this;
        // si el navegador es antiguo y no ejecuta javascript
        if (document.addEventListener) {
            this.el = document.getElementById(id);
            this.resize();
            this.plugins();

            // el tamaño de la ventana trae el tamaño completo
            window.addEventListener('resize', function (e) {
                var size = me.resize();
                $(me.el).turn('size', size.width, size.height);
            });
        }
    },

    resize: function () {
        // Restablecer el ancho y la altura del libro
        this.el.style.width = '';
        this.el.style.height = '';

        var width = this.el.clientWidth,
            height = Math.round(width / this.ratio),
            padded = Math.round(document.body.clientHeight * 0.9);

        // Si la altura es demasiado grande para la ventana, restrinje
        if (height > padded) {
            height = padded;
            width = Math.round(height * this.ratio);
        }

        // Ajuste la anchura y la altura que coinciden con la relación de aspecto
        this.el.style.width = width + 'px';
        this.el.style.height = height + 'px';

        return {
            width: width,
            height: height
        };
    },
  plugins: function () {
      // arranca el plugin
      $(this.el).turn({
          gradients: true,
          acceleration: true
      });
      //Ocultar el desbordamiento del cuerpo
     document.body.className = 'auto-overflow';
  }
};

module.init('book');
});

//]]>




// Indicar al marco padre incrustado la altura del contenido
/*if (window.parent && window.parent.parent){
window.parent.parent.postMessage(["resultsFrame", {
height: document.body.getBoundingClientRect().height,
slug: "tLpsrcdy"
}], "*")
}*/
