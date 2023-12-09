$(document).ready(function() {
    $.ajax({
        url: "../php/profile.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if(response.message == "successfull") {
                // Populate user data in the profile page
                $("#username").text(response.data.username);
                $("#email").text(response.data.email);
                $("#age").text(response.data.age);
                $("#dob").text(response.data.dob);
                $("#contact").text(response.data.contact);
            } else {
                console.error("Failed to fetch user data");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed with status:", status);
        },
    });
});
