<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barangay Records Management System</title>
  <link rel ="icon" href="img/Barangay Logo.png" type ="image/x-icon">
  <link rel="stylesheet" href="css/index.css"/>
  <link rel="stylesheet" href="css/contact form style.css"/>
  <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
  <link type="text/css" rel="stylesheet" href="css/ionicons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="body">
  <section id="sidebar">
        <div class="sidebar-brand">
            <h3><i class="fa fa-dashboard"></i><span>Barangay Records Management System</span></h3>
			<a href="#"><img src="img/Barangay Logo.png" width="120"><i class="logo"></a>
        </div>
        <div class="sidebar-menu">
		    <ul>
          <li><a href="Admin Panel Dashboard.php"><i class="fa fa-user"></i><span>Home Dashboard</span></a></li>
          <li><a href="Barangay Clearance User.php"><i class="fa fa-users"></i><span>Barangay Clearance</span></a></li>
          <li><a href="Certificate of Indigency User.php"><i class="fa fa-users"></i><span>Certificate of Indigency</span></a></li>
          <li><a href="Barangay Permit User.php"><i class="fa fa-users"></i><span>Barangay Permit</span></a></li>
				  <li><a href="Contact Form Page.php"><i class="fa fa-envelope" aria-hidden="true"></i><span>Contact Us</span></a></li>
          <li ng-click="logout()"><a><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></li>
		    </ul>
		</div>
    </section>
<div class="wrapper">
  <h2>Feedback</h2>
  <div id="error_message"></div>
  <form action="https://formsubmit.co/kennethfroymobo1975@gmail.com" onsubmit="return validate();" method="POST">
    <div class="input_field">
        <input type="text" placeholder="Fullname" id="name">
    </div>
    <div class="input_field">
        <input type="text" placeholder="Subject" id="subject">
    </div>
    <div class="input_field">
        <input type="number" placeholder="Contact Number" id="phone">
    </div>
    <div class="input_field">
        <input type="text" placeholder="Email Address" id="email">
    </div>
    <div class="input_field">
        <textarea placeholder="Message" id="message"></textarea>
    </div>
	<center>
    <div class="btn">
        <input type="submit" value="Submit"/>
    </div>
	</center>
  </form>
</div>
<script>
function validate(){
  var name = document.getElementById("name").value;
  var subject = document.getElementById("subject").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;
  var error_message = document.getElementById("error_message");
  error_message.style.padding = "14px";
  var text;
  if(name.length < 20){
    text = "Please enter your specific valid name!!!";
    error_message.innerHTML = text;
    return false;
  }
  if(subject.length < 15){
    text = "Please enter your specific correct subject!!!";
    error_message.innerHTML = text;
    return false;
  }
  if(isNaN(phone) || phone.length != 11){
    text = "Please enter your specific valid phone or contact number!!!";
    error_message.innerHTML = text;
    return false;
  }
  if(email.indexOf("@") == -1 || email.length < 6){
    text = "Please enter your specific valid email address!!!";
    error_message.innerHTML = text;
    return false;
  }
  if(message.length <= 20){
    text = "Please enter more than 10 characters!!!";
    error_message.innerHTML = text;
    return false;
  }
  alert("Form Submitted Successfully!!!");
  return true;
}
</script>
</body>
</html>