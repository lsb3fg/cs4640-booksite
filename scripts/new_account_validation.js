$(document).ready(function() {
    function passwordValidate(len=8) {
        var pass = document.getElementById("password");
        // var submit = document.getElementById("submit");
        var pwhelp = document.getElementById("pwhelp");
        var passval = pass.value;

        if (passval.length < len) {
            pass.classList.add("is-invalid");
            // submit.disabled = true;
            pwhelp.textContent = "Please enter a "+len +"-character password.";
        } else {
            pass.classList.remove("is-invalid");
            // submit.disabled = false;
            pwhelp.textContent = "";
        }
    }
    document.getElementById("password").addEventListener("keyup", function() {
        passwordValidate(8);
    });
    // var data = $("#typePasswordX-2").val();
    // console.log(data);
});