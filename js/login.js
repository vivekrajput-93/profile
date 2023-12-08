function validateCredientials( ) {
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
        if(response.message == "successfull") {
            window.location.href = "profile.html"
        }
      },
      error: function (xhr, status, error) {
        // Handle errors here
        console.error("AJAX request failed with status:", status);
      },
    });
  }
  
