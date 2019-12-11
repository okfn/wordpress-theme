/**
 * Theme presentational javascript
 */
$(document).ready(function() {

	// show / hide search bar
  $('#display-search-bar').on('click', function () {
      $('#main-search-bar').addClass("active");
  });
  $('#main-search-bar .cancel').on('click', function (event) {
      event.preventDefault();
      $('#main-search-bar').removeClass("active");
  });


  // menu
  $("#mmenu").mmenu({
     // options
     searchfield: true,
     extensions: [
       "position-right",
       "theme-dark"
     ]
  }, {
     // configuration
     classNames: {
       selected: "current-menu-item"
     },
     offCanvas: {
       pageSelector: "#page"
     }
  });

});
