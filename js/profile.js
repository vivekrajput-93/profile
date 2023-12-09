// Function to fetch user data based on email
function fetchUserProfile() {
    const urlParams = new URLSearchParams(window.location.search);
    const userEmail = urlParams.get('email');

    fetch('../php/profile.php?email=' + userEmail)
    .then(response => response.json())
    .then(data => {
        // Display user data in the profile HTML
        if (data) {
            profileDiv.innerHTML = `
                <h2>User Profile</h2>
                <p>Username: ${data.username}</p>
                <p>Email: ${data.email}</p>
                <p>Age: ${data.age}</p>
                <p>Date of Birth: ${data.dob}</p>
                <p>Contact: ${data.contact}</p>
            `;
        } else {
            profileDiv.innerHTML = '<p>User data not found!</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

fetchUserProfile();
