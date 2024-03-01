<?php

include '../dbconnect.php';

/* random chracter for question id */

$m=3;
$n=4;
$o=3;
function getName1($m) { 
  $characters1 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString1 = ''; 

  for ($i1 = 0; $i1 < $m; $i1++) { 
    $index1 = rand(0, strlen($characters1) - 1); 
    $randomString1 .= $characters1[$index1]; 
  } 

  return $randomString1; 
}

function getName2($n) { 
  $characters2 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString2 = ''; 

  for ($i2 = 0; $i2 < $n; $i2++) { 
    $index2 = rand(0, strlen($characters2) - 1); 
    $randomString2 .= $characters2[$index2]; 
  } 

  return $randomString2; 
}


function getName3($o) { 
  $characters3 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  $randomString3 = ''; 

  for ($i3 = 0; $i3 < $o; $i3++) { 
    $index3 = rand(0, strlen($characters3) - 1); 
    $randomString3 .= $characters3[$index3]; 
  } 

  return $randomString3; 
}

$_rn1 = getName1($m); 
$_rn2 = getName2($n); 
$_rn3 = getName3($o);

$admin_id = $_rn1."-".$_rn2."-".$_rn3;



?>
<!DOCTYPE html>
<html>
<head>
	<title>IMTIHAN - Signup</title>
	<!-- Required meta tags -->
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  	<link rel="stylesheet" href="../css/log-sign.css">
</head>
<body>


<div class="container">
  <form action="" method="post">
    <h2>Signup</h2>
    <hr>

    <div class="inp-form-cont-group">
      <input type="text" class="inp-form-cont" name="name" placeholder="Name" required="required">
    </div>

    <div class="inp-form-cont-group">
      <input type="text" class="inp-form-cont" name="username" placeholder="Username" required="required">
    </div>

    <div class="inp-form-cont-group">
      <select id="inputState" class="inp-form-cont" name="gender">
        <option selected>Select Your Gender</option>
        <option>Male</option>
        <option>Female</option>
        <option>Others</option>
      </select>
    </div>

    <div class="inp-form-cont-group">
      <select id="country" name="country" class="inp-form-cont">
        <option selected>Select Your Country</option>
          <option value="Afganistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="American Samoa">American Samoa</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
          <option value="Antigua & Barbuda">Antigua & Barbuda</option>
          <option value="Argentina">Argentina</option>
          <option value="Armenia">Armenia</option>
          <option value="Aruba">Aruba</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Azerbaijan">Azerbaijan</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bahrain">Bahrain</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Barbados">Barbados</option>
          <option value="Belarus">Belarus</option>
          <option value="Belgium">Belgium</option>
          <option value="Belize">Belize</option>
          <option value="Benin">Benin</option>
          <option value="Bermuda">Bermuda</option>
          <option value="Bhutan">Bhutan</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Bonaire">Bonaire</option>
          <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
          <option value="Botswana">Botswana</option>
          <option value="Brazil">Brazil</option>
          <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
          <option value="Brunei">Brunei</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Burkina Faso">Burkina Faso</option>
          <option value="Burundi">Burundi</option>
          <option value="Cambodia">Cambodia</option>
          <option value="Cameroon">Cameroon</option>
          <option value="Canada">Canada</option>
          <option value="Canary Islands">Canary Islands</option>
          <option value="Cape Verde">Cape Verde</option>
          <option value="Cayman Islands">Cayman Islands</option>
          <option value="Central African Republic">Central African Republic</option>
          <option value="Chad">Chad</option>
          <option value="Channel Islands">Channel Islands</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Christmas Island">Christmas Island</option>
          <option value="Cocos Island">Cocos Island</option>
          <option value="Colombia">Colombia</option>
          <option value="Comoros">Comoros</option>
          <option value="Congo">Congo</option>
          <option value="Cook Islands">Cook Islands</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Cote DIvoire">Cote DIvoire</option>
          <option value="Croatia">Croatia</option>
          <option value="Cuba">Cuba</option>
          <option value="Curaco">Curacao</option>
          <option value="Cyprus">Cyprus</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Djibouti">Djibouti</option>
          <option value="Dominica">Dominica</option>
          <option value="Dominican Republic">Dominican Republic</option>
          <option value="East Timor">East Timor</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egypt">Egypt</option>
          <option value="El Salvador">El Salvador</option>
          <option value="Equatorial Guinea">Equatorial Guinea</option>
          <option value="Eritrea">Eritrea</option>
          <option value="Estonia">Estonia</option>
          <option value="Ethiopia">Ethiopia</option>
          <option value="Falkland Islands">Falkland Islands</option>
          <option value="Faroe Islands">Faroe Islands</option>
          <option value="Fiji">Fiji</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="French Guiana">French Guiana</option>
          <option value="French Polynesia">French Polynesia</option>
          <option value="French Southern Ter">French Southern Ter</option>
          <option value="Gabon">Gabon</option>
          <option value="Gambia">Gambia</option>
          <option value="Georgia">Georgia</option>
          <option value="Germany">Germany</option>
          <option value="Ghana">Ghana</option>
          <option value="Gibraltar">Gibraltar</option>
          <option value="Great Britain">Great Britain</option>
          <option value="Greece">Greece</option>
          <option value="Greenland">Greenland</option>
          <option value="Grenada">Grenada</option>
          <option value="Guadeloupe">Guadeloupe</option>
          <option value="Guam">Guam</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Guinea">Guinea</option>
          <option value="Guyana">Guyana</option>
          <option value="Haiti">Haiti</option>
          <option value="Hawaii">Hawaii</option>
          <option value="Honduras">Honduras</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Hungary">Hungary</option>
          <option value="Iceland">Iceland</option>
          <option value="Indonesia">Indonesia</option>
          <option value="India">India</option>
          <option value="Iran">Iran</option>
          <option value="Iraq">Iraq</option>
          <option value="Ireland">Ireland</option>
          <option value="Isle of Man">Isle of Man</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Japan">Japan</option>
          <option value="Jordan">Jordan</option>
          <option value="Kazakhstan">Kazakhstan</option>
          <option value="Kenya">Kenya</option>
          <option value="Kiribati">Kiribati</option>
          <option value="Korea North">Korea North</option>
          <option value="Korea Sout">Korea South</option>
          <option value="Kuwait">Kuwait</option>
          <option value="Kyrgyzstan">Kyrgyzstan</option>
          <option value="Laos">Laos</option>
          <option value="Latvia">Latvia</option>
          <option value="Lebanon">Lebanon</option>
          <option value="Lesotho">Lesotho</option>
          <option value="Liberia">Liberia</option>
          <option value="Libya">Libya</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Lithuania">Lithuania</option>
          <option value="Luxembourg">Luxembourg</option>
          <option value="Macau">Macau</option>
          <option value="Macedonia">Macedonia</option>
          <option value="Madagascar">Madagascar</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Malawi">Malawi</option>
          <option value="Maldives">Maldives</option>
          <option value="Mali">Mali</option>
          <option value="Malta">Malta</option>
          <option value="Marshall Islands">Marshall Islands</option>
          <option value="Martinique">Martinique</option>
          <option value="Mauritania">Mauritania</option>
          <option value="Mauritius">Mauritius</option>
          <option value="Mayotte">Mayotte</option>
          <option value="Mexico">Mexico</option>
          <option value="Midway Islands">Midway Islands</option>
          <option value="Moldova">Moldova</option>
          <option value="Monaco">Monaco</option>
          <option value="Mongolia">Mongolia</option>
          <option value="Montserrat">Montserrat</option>
          <option value="Morocco">Morocco</option>
          <option value="Mozambique">Mozambique</option>
          <option value="Myanmar">Myanmar</option>
          <option value="Nambia">Nambia</option>
          <option value="Nauru">Nauru</option>
          <option value="Nepal">Nepal</option>
          <option value="Netherland Antilles">Netherland Antilles</option>
          <option value="Netherlands">Netherlands (Holland, Europe)</option>
          <option value="Nevis">Nevis</option>
          <option value="New Caledonia">New Caledonia</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Niger">Niger</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Niue">Niue</option>
          <option value="Norfolk Island">Norfolk Island</option>
          <option value="Norway">Norway</option>
          <option value="Oman">Oman</option>
          <option value="Pakistan">Pakistan</option>
          <option value="Palau Island">Palau Island</option>
          <option value="Palestine">Palestine</option>
          <option value="Panama">Panama</option>
          <option value="Papua New Guinea">Papua New Guinea</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Peru">Peru</option>
          <option value="Phillipines">Philippines</option>
          <option value="Pitcairn Island">Pitcairn Island</option>
          <option value="Poland">Poland</option>
          <option value="Portugal">Portugal</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Qatar">Qatar</option>
          <option value="Republic of Montenegro">Republic of Montenegro</option>
          <option value="Republic of Serbia">Republic of Serbia</option>
          <option value="Reunion">Reunion</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russia</option>
          <option value="Rwanda">Rwanda</option>
          <option value="St Barthelemy">St Barthelemy</option>
          <option value="St Eustatius">St Eustatius</option>
          <option value="St Helena">St Helena</option>
          <option value="St Kitts-Nevis">St Kitts-Nevis</option>
          <option value="St Lucia">St Lucia</option>
          <option value="St Maarten">St Maarten</option>
          <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
          <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
          <option value="Saipan">Saipan</option>
          <option value="Samoa">Samoa</option>
          <option value="Samoa American">Samoa American</option>
          <option value="San Marino">San Marino</option>
          <option value="Sao Tome & Principe">Sao Tome & Principe</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="Senegal">Senegal</option>
          <option value="Seychelles">Seychelles</option>
          <option value="Sierra Leone">Sierra Leone</option>
          <option value="Singapore">Singapore</option>
          <option value="Slovakia">Slovakia</option>
          <option value="Slovenia">Slovenia</option>
          <option value="Solomon Islands">Solomon Islands</option>
          <option value="Somalia">Somalia</option>
          <option value="South Africa">South Africa</option>
          <option value="Spain">Spain</option>
          <option value="Sri Lanka">Sri Lanka</option>
          <option value="Sudan">Sudan</option>
          <option value="Suriname">Suriname</option>
          <option value="Swaziland">Swaziland</option>
          <option value="Sweden">Sweden</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Syria">Syria</option>
          <option value="Tahiti">Tahiti</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Tajikistan">Tajikistan</option>
          <option value="Tanzania">Tanzania</option>
          <option value="Thailand">Thailand</option>
          <option value="Togo">Togo</option>
          <option value="Tokelau">Tokelau</option>
          <option value="Tonga">Tonga</option>
          <option value="Trinidad & Tobago">Trinidad & Tobago</option>
          <option value="Tunisia">Tunisia</option>
          <option value="Turkey">Turkey</option>
          <option value="Turkmenistan">Turkmenistan</option>
          <option value="Turks & Caicos Is">Turks & Caicos Is</option>
          <option value="Tuvalu">Tuvalu</option>
          <option value="Uganda">Uganda</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Arab Erimates">United Arab Emirates</option>
          <option value="United States of America">United States of America</option>
          <option value="Uraguay">Uruguay</option>
          <option value="Uzbekistan">Uzbekistan</option>
          <option value="Vanuatu">Vanuatu</option>
          <option value="Vatican City State">Vatican City State</option>
          <option value="Venezuela">Venezuela</option>
          <option value="Vietnam">Vietnam</option>
          <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
          <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
          <option value="Wake Island">Wake Island</option>
          <option value="Wallis & Futana Is">Wallis & Futana Is</option>
          <option value="Yemen">Yemen</option>
          <option value="Zaire">Zaire</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
      </select>
    </div>

    <div class="inp-form-cont-group">
      <input type="password" class="inp-form-cont" name="password" placeholder="Password" required="required">
    </div>

    <div class="inp-form-cont-group">
      <input type="password" class="inp-form-cont" name="cpassword" placeholder="Confirm Password" required="required">
    </div>
    
    <input type="submit" name="sign-btn" class="log-btn" value="Signup">
    
    <hr>
    <div class="clearfix mb-3">
      <span class="alm float-left">Already a member ?
      <a href="../admin-credential/login.php" class="blink">Login</a></span>
    </div>

  </form>
</div>
	
</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$_name = $_POST['name'];
	$admin_user_name = $_POST['username'];
	$_gender = $_POST['gender'];
	$_country = $_POST['country'];
	$_password = $_POST['password'];
	$_c_password = $_POST['cpassword'];

	if(empty($_name) || empty($admin_user_name) || empty($_gender) || empty($_country) || empty($_password) || empty($_c_password))
	{
		echo "<script>alert('Please Fill all the filed');</script>";
	}
	else
	{
		// check weather this username is exist or not
    	$exist_sql = "SELECT * FROM `admin-table` WHERE `admin_username` = '$admin_user_name' ";
    	$run_exist_sql = mysqli_query($conn , $exist_sql);
    	echo $NumExistRows = mysqli_num_rows($run_exist_sql);
    	
    	if($NumExistRows > 0)
    	{
     		echo "<script>alert('Username ".$admin_user_name." Already Exist. Plese Enter A Unique Username');</script>";
    	}
    	else
    	{
    		if ($_gender == 'Select Your Gender' || $_country == 'Select Your Country') 
    		{
    			echo "<script>alert('Plese Select Gender & Country');</script>";
    		}
    		else
    		{
				if ($_password == $_c_password) 
				{
				/*
				after completing use password hash

				$hash_password = password_hash($_password, PASSWORD_DEFAULT);	
				
				and write $hash_password at place of $_password in insert query
				*/
					$_insert_sql = "INSERT INTO `admin-table` (`Sno`, `admin_id`, `admin_name`, `admin_username`, `admin_gender`, `admin_country`, `admin_password`, `date_time`) VALUES (NULL,'$admin_id' ,'$_name', '$admin_user_name', '$_gender', '$_country', '$_password', current_timestamp())";
					$_run_insert_sql = mysqli_query($conn , $_insert_sql);
					if($_run_insert_sql) 
					{
						echo "<script>alert('Account Created Successfully !');</script>";
						echo "<script>location = '../admin-credential/login.php';</script>";
					}
					else
					{
						echo "Problem !";
					}
				}
				else
				{
					echo "<script>alert('".$admin_user_name." Password Must be Equal');</script>";
				}
    		}
		}
	}
}

?>