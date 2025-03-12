// function weatherForecast() {
//     snowyemoji.classList.add("hidden");
//     rainyemoji.classList.add("hidden");
//     sunnyemoji.classList.add("hidden");
//     cloudyemoji.classList.add("hidden");
//     background.classList.remove("snowy", "rainy", "sunny");
//     if (humidité hausse et tempé basse) {
//         background.classList.add("snowy"); 
//             snowyemoji.classList.remove("hidden");
//         return;
//     }
//     if (humidité hausse et tempé haute) {
//         background.classList.add("rainy");
//             rainyemoji.classList.remove("hidden");
//         return;
//     }
//     if (plus de 25°) {
//         background.classList.add("sunny"); 
//             sunnyemoji.classList.remove("hidden");
       
//     } else {
//          sunnyemoji.classList.remove("hidden");
//       }

// } 


// function nightOrDay() {
//     if (currentTime > 17 && currentTime < 7) {
//         console.log("it's nighttime");
//         background.classList.add("night");
        
//     } else {
//         background.classList.remove("night");
//         console.log("it's daytime");
//     }
// }


let background = document.querySelector("#weather");
let snowyemoji = document.querySelector("#snowyemoji");
let rainyemoji = document.querySelector("#rainyemoji");
let sunnyemoji = document.querySelector("#sunnyemoji");
let cloudyemoji = document.querySelector("#cloudyemoji");

// let temperature = ;
// let humidity = ;

const TODAY = new Date();
let currentTime = TODAY.getHours();

let wrongmail = document.querySelector("#wrongmail");

// Function to validate email format
function validateEmail(email) {
var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
return pattern.test(email);
}
// Example usage
document.getElementById("mail").addEventListener("input", function() {
var email = this.value;
if (validateEmail(email)) {
console.log("Valid email address.");
} else {
console.log("Invalid email address.");
let wrongelem = document.createElement('span');
wrongelem.innerHTML = "Adresse invalide";
wrongmail.appendChild(wrongelem);
}
});


// nightOrDay();
// weatherForecast();