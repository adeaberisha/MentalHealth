<?php

session_start();

$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="./Styles/LoginForm.css">
  <style>
    .error_message {
      color: red;
      text-align: center;
      margin-top: 83px;
      position: absolute;
      width: 100%;

    }
    </style>
</head>
<body>

  <div class="error_message"><?php echo $errorMessage; ?></div>

  <div class="wrapper">

    <header>Login Form</header>

    <form method="POST" action="loginprocess.php">

      <div class="field email">
        <div class="input-area">
            <input type="text" id="email"name="email" placeholder="Email Address">
        </div>
        <div class="error error-txt">Email can't be blank</div>
      </div>

      <div class="field password">
        <div class="input-area">
          <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <div class="error error-txt">Password can't be blank</div>
      </div>

      <input type="submit" value="Login" name="login">

    </form>

    <div class="sign-txt">Not a member yet? <a href="Register.php">Sign up now</a></div>

  </div>

  <script>
    const form = document.querySelector("form");
        
    eField = form.querySelector(".email"),
    eInput = eField.querySelector("input"),
    pField = form.querySelector(".password"),
    pInput = pField.querySelector("input");

    form.onsubmit = (e)=>{  
      e.preventDefault(); //e parandalon formen per tu mos u bere submit

      (eInput.value == "") ? eField.classList.add("error") : checkEmail();
      (pInput.value == "") ? pField.classList.add("error") : checkPass();

      eInput.onkeyup = ()=>{checkEmail();} //therret funksionin checkEmail kur tentojme te bejme login (on email input keyup)
      pInput.onkeyup = ()=>{checkPass();} //therret funksionin checkPass kur tentojme te bejme login (on password input keyup)
       
      function checkEmail(){ 
        let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; //validimi i emailit
        if(!eInput.value.match(pattern)){ //nese paterni per validim nuk eshte i njejte shtojme error dhe largojme klasen valid
          eField.classList.add("error");
          eField.classList.remove("valid");
          let errorTxt = eField.querySelector(".error-txt");
          //nese emaili nuk eshte empty shfaqe mesazhin "Enter a valid email address" ne te kunderten shfaq "Email can't be blank"
          (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";

        }else{ //nese paterni per validim eshte i njejte largo errorin dhe shto klasen valid
          eField.classList.remove("error");
          eField.classList.add("valid");
        }
          
      }

      function checkPass(){ 
        if(pInput.value == ""){ //nese passwordi eshte empty shto error dhe largo klasen valid
          pField.classList.add("error");
          pField.classList.remove("valid");
        }
        else{ //nese passwordi nuk eshte empty largo error dhe shto klasen valid
              pField.classList.remove("error");
              pField.classList.add("valid");
        }
      }
      nese eField dhe pField nuk kane klasen error do te thote qe perdoruesi ka plotesuar formen me sukses
      if(!eField.classList.contains("error") && !pField.classList.contains("error")){
          form.submit();
    }
    </script>
</body>
</html>
  



