$(document).ready(function() {
    // Get the email from somewhere, replace 'user@example.com' with the actual email
    let data = localStorage.getItem("userData")

    console.log(data.email);
    console.log(data)
    console.log(JSON.parse(data));
    var userEmail = {
        userEmail : JSON.parse(data).email

    }; // Replace this with the actual email or get it dynamically



    $.ajax({
        url: "../php/profile.php",
        type: "GET",
        dataType: "json",
        data : userEmail,
        success: function(response) {
            console.log(response)
            if (response.message == 'success') {
                // Populate user data in the profile page
                var userData = response.data;
                // Update your HTML elements with the user data
                $('#username').text(userData.username);
                $('#email').text(userData.email);
                $('#age').text(userData.age);
                $('#dob').text(userData.dob);
                $('#contact').text(userData.contact);
            } else {
                console.error(response.message)
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed with status:", status);
        },
    });
});
