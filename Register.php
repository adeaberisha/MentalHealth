<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./Styles/Register.css">

</head>
<body>

    <div class="container">
        <header>SIGN UP</header>
        <form action="register_process.php" method="post">
        <div class="field email-field">
            <div class="input-field">
                <input type="email" 
                placeholder="Enter your email" 
                class="email"
                name="email" 
                />
            </div>
            <span class="error email-error">
                <i class="bx bx-error-circle error icon"></i>
                <p class="error-text">Please enter a valid email</p>
            </span>
        </div>
        <div class="field create-password">
            <div class="input-field">
                <input 
                type="password"
                placeholder="Create password"
                class="password"
                name="password"
                />
                <i class="bx bx-hide show-hide"></i>
            </div>
            <span class="error password-error">
                <i class="bx bx-error-circle error-icon"></i>
                <p class="error-text">
                    Please enter atleast 8 characters including a number,symbol also a small and capital letter!
                </p>
            </span>
        </div>
        <div class="field confirm-password">
            <div class="input-field">
                <input 
                type="password"
                placeholder="Confirm password"
                class="cPassword"
                name="cPassword"
                />
                <i class="bx bx-hide show-hide"></i>
            </div>
            <span class="error cPassword-error">
                <i class="bx bx-error-circle error-icon"></i>
                <p class="errpr-text">Passwords don't match!</p>
            </span>
        </div>
        <div class="input-field button">
            <input type="submit" value="Submit Now" />
        </div>
    </form>
    </div>

    <script>
         const form = document.querySelector("form"),
        emailField = form.querySelector(".email-field"),
         emailInput = emailField.querySelector(".email"),
         passField = form.querySelector(".create-password"),
         passInput = passField.querySelector(".password"),
         cPassField = form.querySelector(".confirm-password"),
         cPassInput = cPassField.querySelector(".cPassword");

        //Validimi i Email
         function checkEmail(){
             const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
             if(!emailInput.value.match(emailPattern)){
                 return emailField.classList.add("invalid");
             }
             emailField.classList.remove("invalid");
         }

         //Fshehim passwordin
         const eyeIcons = document.querySelectorAll(".show-hide");

         eyeIcons.forEach((eyeIcon) => {
             eyeIcon.addEventListener("click" , () => {

                 const pInput = eyeIcon.parentElement.querySelector("input");
                 //Kjo e merr lementin prind te eye icon dhe selekton passwordin qe vjen nga inputi
                 if(pInput.type == "password"){
                     eyeIcon.classList.replace("bx-hide","bx-show");
                     return (pInput.type = "text");
                }
                eyeIcon.classList.replace("bx-show","bx-hide");
                 pInput.type = "password";
             });
         });

     //Validimi i passwordit
     function createPass(){
         const passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;

         if(!passInput.value.match(passPattern)){
            return passField.classList.add("invalid");
            //Tregojme qe vlera nuk eshte valide nese passwordi nuk i permbush kushtet

        }
        passField.classList.remove("invalid");
        //E bjeme remove vleren invalid nese passwordi i ploteson kushtet
    }

    //Konfirmojme passwordin
    function confirmPass() {
    if (passInput.value !== cPassInput.value || cPassInput.value === "") {
    return cPassField.classList.add("invalid");
    }
    cPassField.classList.remove("invalid");
    }
    
     //Thirrja e butonit per te bere submit
     form.addEventListener("submit" , (e) => {
         e.preventDefault();
         checkEmail();
         createPass();
         confirmPass();

         //E therrasim funksionin on keyup

         emailInput.addEventListener("keyup",checkEmail);
         passInput.addEventListener("keyup",createPass);
         cPassInput.addEventListener("keyup",confirmPass);

        if (
         !emailField.classList.contains("invalid") &&
         !passField.classList.contains("invalid") &&
         !cPassField.classList.contains("invalid")
        ) {
         form.submit();
        }

    });

    </script>
</body>
</html>
