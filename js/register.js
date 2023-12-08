function submitForm() {
  var username = $("#username").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var age = $("#age").val();
  var dob = $("#dob").val();
  var contact = $("#contact").val();
  var formData = {
    username: username,
    email: email,
    password: password,
    age: age,
    dob: dob,
    contact: contact,
  };

  $.ajax({
    url: "../php/register.php",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function (response) {
      // Handle the successful response here
      if(response.message == "successfull") {
        window.location.href = "login.html"
    }
    },
    error: function (xhr, status, error) {
      // Handle errors here
      console.error("AJAX request failed with status:", status);
    },
  });
}


