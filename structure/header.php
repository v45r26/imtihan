<?php

//session_start();

if(isset($_SESSION['loggedin_it']) && $_SESSION['loggedin_it'] == true)
{
  $loggedin = true;
}
else
{
  $loggedin = false;
}
?>
<div class="navbar">
    <div class="nav-logo">
        <a href="/imtihan" class="nav-img-link">
            <img src="image/logo/imtihan-logo.png" class="nav-img" alt="WEB LOGO">
        </a>
    </div>

    <div class="nav-group" id="mySidenav">
    
        <div class="nav-group-item">
            
            <a class="nav-link" href="/imtihan/index.php">Home</a>
            
<?php
if($loggedin)
{
    echo '  <a class="nav-link" href="/imtihan/dashboard/">Dashboard</a>';
}
?>
            <a class="nav-link" href="/imtihan/features.php">Features</a>
        
            <a class="nav-link" href="pricing.php">Pricing</a>

            <a class="nav-link" href="demo-test.php">Demo Test</a>
           
            <a class="nav-link" href="faqs.php">FAQs</a>

            <a class="nav-link" href="about.php">About Us</a>
            
<?php

if(!$loggedin)
{
        echo '
            <a class="nav-link al-right" href="admin-credential/login.php" title="Login | Signup">
                Login | Signup
            </a>';
}
if($loggedin)
{
  echo '    <a onclick="myFunction()" class="nav-link al-right dropbtn" title="'.$admin_user_name.'">'.$admin_user_name.'</a>
        ';
}
?>
      </div>
    
    </div>
    
    <div class="nav-group-bar">
        <div class="nav-item menu-toggle">
            <i class="fas fa-bars" id="openNav" onclick="openNav()"></i>
            <i class="fas fa-times" id="closeNav" onclick="closeNav()"></i>
        </div>
    </div>
</div>
<div class="dropdown">
  <div class="profile" id="myDropdown">
    <a href="profile.php" class="profile-link" title="Profile">Profile</a>
    <a href="admin-credential/logout.php" class="profile-link" title="Logout">Logout</a>
  </div>
</div>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("profile");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
    

<script>
    const openNav = () =>
    {
        document.getElementById('mySidenav').style.left ="0px";
        document.getElementById('closeNav').style.display ="block";
        document.getElementById('openNav').style.display ="none";
        //document.body.style.backgroundColor = "rgba(64,82,20,1)";
    }
    const closeNav = () =>
    {
        document.getElementById('mySidenav').style.left ="-100%";
        document.getElementById('openNav').style.display ="block";
        document.getElementById('closeNav').style.display ="none";
        //document.body.style.backgroundColor = "white";
    }
</script>