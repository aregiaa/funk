const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
togglePassword.addEventListener("click", function() {   
    const type = password.type === "password" ? "text" : "password";
    password.type = type;  
    this.classList.toggle("fas", true); 
    this.classList.toggle("fa-eye", type === "password"); 
    this.classList.toggle("fa-eye-slash", type === "text"); 
});

