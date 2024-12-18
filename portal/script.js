//Getting values
const signupButton=document.getElementById('signupButton');
const loginButton=document.getElementById('loginButton');
const loginForm=document.getElementById('login');
const signupForm=document.getElementById('signup');

//When button clicked, do this
signupButton.addEventListener('click',function(){
    loginForm.style.display="none";
    signupForm.style.display="block";
})
loginButton.addEventListener('click',function(){
    loginForm.style.display="block";
    signupForm.style.display="none";
})