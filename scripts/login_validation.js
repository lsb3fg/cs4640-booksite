$(document).ready(function() {
    function passwordValidate(len=8) {
        var pass = document.getElementById("typePasswordX-2");
        var submit = document.getElementById("submit");
        var pwhelp = document.getElementById("pwhelp");
        var passval = pass.value;

        if (passval.length < len) {
            pass.classList.add("is-invalid");
            submit.disabled = true;
            pwhelp.textContent = "Please enter a "+len +"-character password.";
        } else {
            pass.classList.remove("is-invalid");
            submit.disabled = false;
            pwhelp.textContent = "";
        }
    }

    function isFilledOut(){
        console.log($("#typePasswordX-2").val().length);
        if($("#typePasswordX-2").val().length === 0){
            $("#typePasswordX-2").addClass("is-invalid");
            pwhelp.textContent = "Please fill this field out";
        }
        if($("#typeEmailX-2").val().length === 0 || $("#typeEmailX-2").val().includes("@")){
            $("#typeEmailX-2").addClass("is-invalid");
            pwhelp.textContent = "Please fill this field out";
        }
        else{
            $("#typePasswordX-2").removeClass("is-invalid");
            $("#typeEmailX-2").removeClass("is-invalid");
        }
    }

    document.getElementById("typePasswordX-2").addEventListener("keyup", function() {
        passwordValidate(8);
    });

    document.getElementById("submit").addEventListener("click", function() {
       isFilledOut();
    });

    
    // var data = $("#typePasswordX-2").val();
    // console.log(data);
});