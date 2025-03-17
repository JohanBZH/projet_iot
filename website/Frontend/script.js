const signInButton = document.getElementById("signInButton").addEventListener('click', openSignInModal);
const signUpButton = document.getElementById("signUpButton").addEventListener('click', openSignUpModal);

const signInclose = document.getElementById("signInclose").addEventListener('click', closeSignInModal);
const signUpclose = document.getElementById("signUpclose").addEventListener('click', closeSignUpModal);

const signInDialog = document.getElementById("signInDialog");
const signUpDialog = document.getElementById("signUpDialog");


function openSignInModal() {
    signInDialog.showModal();
    console.log("clicked on Sign in");
  };

function openSignUpModal() {
    signUpDialog.showModal();
    console.log("clicked on Sign up");
};
  
function closeSignInModal() {
    signInDialog.close();
    console.log("closed the modal");
};

function closeSignUpModal() {
    signUpDialog.close();
    console.log("closed the modal");
};


