var nutrition_diet_Keyboard_loop = function (elem) {
  var nutrition_diet_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var nutrition_diet_firstTabbable = nutrition_diet_tabbable.first();
  var nutrition_diet_lastTabbable = nutrition_diet_tabbable.last();
  nutrition_diet_firstTabbable.focus();

  nutrition_diet_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      nutrition_diet_firstTabbable.focus();
    }
  });

  nutrition_diet_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      nutrition_diet_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};