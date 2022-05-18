    function Toggle(){

        var input = document.getElementById("Password");
        if (input.type === "password") {
            input.type = "text";
            document.getElementById("togglePassword").className = "fa fa-eye";
        } else {
            input.type = "password";
            document.getElementById("togglePassword").className = "fa fa-eye-slash";
        }
    }
   