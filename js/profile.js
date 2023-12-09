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

function updateUserField(field, newData) {
    var updatedData = {};
    updatedData[field] = newData;

    $.ajax({
        url: "../php/profile.php?action=updateUser",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(updatedData),
        success: function(response) {
            if (response.message === 'success') {
                // Update successful, update the displayed data
                $('#' + field).text(newData);
            } else {
                console.error(`Failed to update ${field}`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed with status:", status);
        },
    });
}

// Event handlers for update buttons

$('#updateUsername').on('click', function() {
    var newUsername = prompt('Enter new username:');
    if (newUsername !== null && newUsername.trim() !== '') {
        updateUserField('username', newUsername);
    }
});

$('#updateAge').on('click', function() {
    var newAge = prompt('Enter new age:');
    if (newAge !== null && !isNaN(newAge) && newAge.trim() !== '') {
        updateUserField('age', newAge);
    }
});

$('#updateDob').on('click', function() {
    var newDob = prompt('Enter new date of birth:');
    if (newDob !== null && newDob.trim() !== '') {
        updateUserField('dob', newDob);
    }
});

$('#updateContact').on('click', function() {
    var newContact = prompt('Enter new contact:');
    if (newContact !== null && newContact.trim() !== '') {
        updateUserField('contact', newContact);
    }
});