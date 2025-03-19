// create constants for every sign in and sign up modal elements

const signInButton = document.getElementById("signInButton").addEventListener('click', openSignInModal);
const signUpButton = document.getElementById("signUpButton").addEventListener('click', openSignUpModal);

const signInclose = document.getElementById("signInclose").addEventListener('click', closeSignInModal);
const signUpclose = document.getElementById("signUpclose").addEventListener('click', closeSignUpModal);

const signInDialog = document.getElementById("signInDialog");
const signUpDialog = document.getElementById("signUpDialog");

// open and close modals using the dialog HTML element
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

//Refresh the data displayed in the landing page every 2 seconds. 

document.addEventListener('DOMContentLoaded', function(){

    function refreshJS(){
        const scrollPos = window.scrollY;
        
        //fetch a json containing the lastest data to display and change the content of the associated div
        fetch('../Backend/refresh.php?action=refresh')
            .then(response => {
                if(!response.ok){
                    throw new Error ('Network error');
                }
                return response.json();
            })
            .then(data => {
                console.log('Données reçues:', data);
                document.getElementById('temp').textContent = data.temperature + "°C";
                document.getElementById('hum').textContent = data.humidity + "%";
                document.getElementById('time').textContent = data.time.substr(11, 8);

                window.scrollTo(0, scrollPos);
            })
            .catch(error => {
                console.error('Error', error);
            })
    }

    refreshJS();
    
    setInterval(refreshJS, 2000);
});