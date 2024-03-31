<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Importing Poppins font from Google Fonts -->
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
      /* Resetting default styles and applying Poppins font */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      /* Styling for the body */
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background:url("https://img.freepik.com/free-photo/business-person-futuristic-business-environment_23-2150970201.jpg?t=st=1708012636~exp=1708016236~hmac=e4e04bb794e07e80277ad73d1a8a00bc2065bdafdf111acf17da3dec33bbd98e&w=996");
        background-repeat: no-repeat;
        background-size: cover;
        padding: 30px;
      }
      /* Styling for the container */
      .container {
        position: relative;
        max-width: 850px;
        width: 100%;
        background: #fff;
        padding: 40px 30px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        perspective: 2700px;
      }
      /* Styling for the cover */
      .container .cover {
        position: absolute;
        top: 0;
        left: 50%;
        height: 100%;
        width: 50%;
        z-index: 98;
        transition: all 1s ease;
        transform-origin: left;
        transform-style: preserve-3d;
      }
      /* Flipping animation on checkbox change */
      .container #flip:checked ~ .cover {
        transform: rotateY(-180deg);
      }
      /* Styling for the front and back sides of the cover */
      .container .cover .front,
      .container .cover .back {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
      }
      .cover .back {
        transform: rotateY(180deg);
        backface-visibility: hidden;
      }
      /* Background overlay on front and back sides */
      .container .cover::before,
      .container .cover::after {
        content: "";
        position: absolute;
        height: 100%;
        width: 100%;
        background: #fff;
        opacity: 0.5;
        z-index: 12;
      }
      .container .cover::after {
        opacity: 0.3;
        transform: rotateY(180deg);
        backface-visibility: hidden;
      }
      /* Styling for images and text inside the cover */
      .container .cover img {
        position: absolute;
        height: 100%;
        width: 100%;
        object-fit: cover;
        z-index: 10;
      }
      .container .cover .text {
        position: absolute;
        z-index: 130;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .cover .text .text-1,
      .cover .text .text-2 {
        font-size: 26px;
        font-weight: 600;
        color: #fff;
        text-align: center;
      }
      .cover .text .text-2 {
        font-size: 15px;
        font-weight: 500;
      }
      /* Styling for the forms container */
      .container .forms {
        height: 100%;
        width: 100%;
        background: #fff;
      }
      /* Styling for the form content */
      .container .form-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .form-content .login-form,
      .form-content .signup-form {
        width: calc(100% / 2 - 25px);
      }
      /* Styling for form titles */
      .forms .form-content .title {
        position: relative;
        font-size: 24px;
        font-weight: 500;
        color: #333;
      }
      .forms .form-content .title:before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 25px;
        background: orange;
      }
      .forms .signup-form .title:before {
        width: 20px;
      }
      /* Styling for input boxes and labels */
      .forms .form-content .input-boxes {
        margin-top: 30px;
      }
      .forms .form-content .input-box {
        display: flex;
        align-items: center;
        height: 50px;
        width: 100%;
        margin: 10px 0;
        position: relative;
      }
      .form-content .input-box input {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
      }
      .form-content .input-box input:focus,
      .form-content .input-box input:valid {
        border-color: #fff;
      }
      .form-content .input-box i {
        position: absolute;
        color: orange;
        font-size: 17px;
      }
      /* Styling for text and links */
      .forms .form-content .text {
        font-size: 14px;
        font-weight: 500;
        color: #333;
      }
      .forms .form-content .text a {
        text-decoration: none;
      }
      .forms .form-content .text a:hover {
        text-decoration: underline;
      }
      /* Styling for buttons */
      .forms .form-content .button {
        color: #fff;
        margin-top: 40px;
      }
      .forms .form-content .button input {
        color: #fff;
        background: orange;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
      }
      .forms .form-content .button input:hover {
        background: black;
      }
      .forms .form-content label {
        color: #5b13b9;
        cursor: pointer;
      }
      .forms .form-content label:hover {
        text-decoration: underline;
      }
      /* Styling for login and signup text */
      .forms .form-content .login-text,
      .forms .form-content .sign-up-text {
        text-align: center;
        margin-top: 25px;
      }
      /* Hiding the flip checkbox on larger screens */
      .container #flip {
        display: none;
      }
      /* Media query for smaller screens */
      @media (max-width: 730px) {
        .container .cover {
          display: none;
        }
        .form-content .login-form,
        .form-content .signup-form {
          width: 100%;
        }
        .form-content .signup-form {
          display: none;
        }
        .container #flip:checked ~ .forms .signup-form {
          display: block;
        }
        .container #flip:checked ~ .forms .login-form {
          display: none;
        }
      }
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #333;
        color: #fff;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      /* Styling for navigation links */
      .navbar a {
        color: #fff;
        text-decoration: none;
        margin: 0 15px;
      }

      /* Logo styling */
      .navbar img {
        height: 30px; /* Adjust the height as needed */
      }
    </style>
    <!-- Meta tags for character set, title, stylesheet, font-awesome, and viewport settings -->
    <meta charset="UTF-8" />
    <title>Login and Registration Form in HTML & CSS | CodingLab</title>
    <link rel="icon" href="media/favicon-32x32.png" type="image/png" sizes="32x32" />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
  <section>
      <!-- Navigation bar section -->
      <div class="navbar">
      <a href="index.html"><img src="media/logo.jpg" alt="Logo"></a>
        <a href="index.html">Home</a>
        <a href="index.html#Services">Services</a>
        <a href="about.html">About</a>
        <a href="contact-us.html">Contact Us</a>
        <a href="login.php">Login</a>
      </div>
    </section>
    <!-- Main container for the login and registration form -->
    <div class="container">
      <!-- Checkbox for flipping animation -->
      <input type="checkbox" id="flip" />
      <!-- Cover container with front and back sides -->
      <div class="cover">
        <div class="front">
          <!-- Logo and text for the front side -->
          <img src="media/logo.jpg" alt="" />
          <div class="text">
            <span class="text-1"><br /></span>
            <span class="text-2"></span>
          </div>
        </div>
        <div class="back">
          <!-- Text for the back side -->
          <div class="text">
            <span class="text-1"
              >Complete miles of journey <br />
              with one step</span
            >
            <span class="text-2">Let's get started</span>
          </div>
        </div>
      </div>
      <!-- Forms container with login and signup forms -->
      <div class="forms">
        <div class="form-content">
          <!-- Login form -->
          <div class="login-form">
            <div class="title">Login</div>
            <form  method="POST" action="processlogin.php">
              <!-- Input boxes for email and password -->
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="email" id="email" name="email" placeholder="Enter your email" required />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password" id="password" name="password" placeholder="Enter your password" required
                  />
                </div>
                <!-- Forgot password link -->
                <div class="text"><a href="checkemaill.html">Forgot password?</a></div>
                <!-- Submit button -->
                <div class="button input-box">
                  <input type="submit" value="Submit" />
                </div>
                <!-- Signup link -->
                <div class="text sign-up-text">
                  Don't have an account? <label for="flip">Signup now</label>
                </div>
              </div>
            </form>
          </div>
          <!-- Signup form -->
 <!-- Signup form -->
          <div class="signup-form">
            <div class="title">Signup</div>
            <form action="process_signup.php" method="POST">
              <!-- Input boxes for name, email, and password -->
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" id="full_name" name="full_name" placeholder="Enter your fullname" required />
                </div>
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                   <input type="email" id="email1" name="email1" placeholder="Enter your email" required />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"  id="password1" name="password1"  placeholder="Enter your password"  required
                  />
                </div>
                <!-- Submit button -->
                <div class="button input-box">
                  <input type="submit" value="Submit" />
                </div>
                <!-- Login link -->
                <div class="text sign-up-text">
                  Already have an account? <label for="flip">Login now</label>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
