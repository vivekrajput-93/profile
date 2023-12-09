function validateCredientials() {
  var email = $("#email").val();
  var password = $("#password").val();
  var formData = {
    email: email,
    password: password,
  };

  $.ajax({
    url: "../php/login.php",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function (response) {
      // Handle the successful response here
      if (response.message == "successfull") {
        const userData = {
          email: email,
          password: password,
          token: "vivek-token12",
        };
        localStorage.setItem("userData", JSON.stringify(userData));
        window.location.href = "profile.html";
      }
    },
    error: function (xhr, status, error) {
      // Handle errors here
      console.error("AJAX request failed with status:", status);
    },
  });
}
