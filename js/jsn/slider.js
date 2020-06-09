var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),//Este es el que toma los datos del val
      value = $('.range-slider__value');//span donde muestra texto

  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html((this.value)+'%');
    });
  });
};


rangeSlider();
//# sourceURL=pen.js
