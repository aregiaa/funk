function validateForm() {
    let isValid = true;   
    let inputs = document.querySelectorAll("input");
    inputs.forEach(input => {
        input.classList.remove("error");
        let errorMessage = document.getElementById(input.id + "-error");
        if (errorMessage) {
            errorMessage.textContent = "";
        }
    });
    var password = document.getElementById("senha").value;
    var confirmPassword = document.getElementById("confirmSenha").value;
    if (password !== confirmPassword) {
        document.getElementById("senha").classList.add("error");
        document.getElementById("confirmSenha").classList.add("error");
        document.getElementById("confirmSenha-error").textContent = "As senhas não coincidem.";
        isValid = false;
    }

 
    if (password.length < 6) {
        document.getElementById("senha").classList.add("error");
        document.getElementById("senha-error").textContent = "A senha deve ter pelo menos 6 caracteres.";
        isValid = false;    
    }    
    let requiredFields = ["nome", "tel", "email", "bairro", "logradouro", "numero", "cidade", "estado"];
    requiredFields.forEach(fieldId => {
        let field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.classList.add("error");
            document.getElementById(fieldId + "-error").textContent = "Este campo é obrigatório.";
            isValid = false;
        }
    });

    return isValid;
}