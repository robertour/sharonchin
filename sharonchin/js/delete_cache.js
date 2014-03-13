// Destroys the localStorage copy of CSS that less.js creates

jQuery( document ).ready(function() {
  destroyLessCache('/wp-content/themes/sharonchin/less/');
  destroyLessCache('/wp-content/themes/sharonchin/less/sharon/');
  destroyLessCache('/wp-content/themes/sharonchin/less/bootstrap/');
});



function destroyLessCache(pathToCss) { // e.g. '/css/' or '/stylesheets/'
 
  if (!window.localStorage || !less) {
    alert('dont');
    return;
  }
  var host = window.location.host;
  var protocol = window.location.protocol;
  var keyPrefix = protocol + '//' + host + pathToCss;

//  debugger;
  for (var key in window.localStorage) {
    if (key.indexOf(keyPrefix) === 0) {
      delete window.localStorage[key];
    }
  }
}
