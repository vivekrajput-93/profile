$(document).ready(function() {
    // Retrieve user's email from the DOM or any source you have it stored
    var userEmail = 'example@example.com'; // Replace this with the actual user's email

    $.ajax({
        url: '../php/register.php',
        type: 'POST', // Change to POST method
        dataType: 'json',
        data: { email: userEmail }, // Send the user's email
        success: function(data) {
            if (data && data.username) {
                $('#usernameHeader').text('Welcome, ' + data.username);
                $('#username').text(data.username);
                $('#age').text(data.age);
                $('#dob').text(data.dob);
                $('#contact').text(data.contact);
            } else {
                $('#usernameHeader').text('User Data Not Found');
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#usernameHeader').text('Error fetching user data');
        }
    });
});
