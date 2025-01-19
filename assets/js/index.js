// JavaScript for user authentication handling
const isLoggedIn = false; // Replace this with server-side authentication check

// Toggle dropdown menu based on login status
if (isLoggedIn) {
  document.getElementById("loggedInMenu").classList.remove("d-none");
} else {
  document.getElementById("loggedOutMenu").classList.remove("d-none");
}
