var templateUrl = template_url.templateUrl;

jQuery("#submit").click(function (e) {
  var data_2;
  jQuery.ajax({
	type: "POST",
	url: templateUrl + "/inc/recaptcha.php",
	data: jQuery('#commentform').serialize(),
	async: false,
	success: function (data) {
	  if (data.nocaptcha === "true") {
		data_2 = 1;
	  } else if (data.spam === "true") {
		data_2 = 1;
	  } else {
		data_2 = 0;
	  }
	}
  });
  if (data_2 != 0) {
	e.preventDefault();
	if (data_2 == 1) {
	  alert("Sorry for the inconvenience, but please confirm that you're not a robot. Thank you.");
	} else {
	  alert("Seems like you'd like to spam. Sorry, that's not allowed.");
	}
  } else {
	jQuery("#commentform").submit;
  }
});
