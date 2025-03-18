// create constants for every sign in and sign up modal elements

const signInButton = document.getElementById("signInButton").addEventListener('click', openSignInModal);
const signUpButton = document.getElementById("signUpButton").addEventListener('click', openSignUpModal);

const signInclose = document.getElementById("signInclose").addEventListener('click', closeSignInModal);
const signUpclose = document.getElementById("signUpclose").addEventListener('click', closeSignUpModal);

const signInDialog = document.getElementById("signInDialog");
const signUpDialog = document.getElementById("signUpDialog");

// opens and closes modals using the dialog HTML element
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

// thermometer animation (requires fabric.js)
const rect1 = new fabric.Rect({
    left: 100,
    top: 100,
    fill: 'red',
    width: 20,
    height: 20
});

rect1.animate(
    'left',
    '+=100',
    {
        onChange: canvas.renderAll(canvas)
    }
);