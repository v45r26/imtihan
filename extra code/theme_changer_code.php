<?php
// jab theme ban jayega tab is code ko setting page me theme change container me paste kar dena hai 
if($test_theme_db == "default-t" || $test_theme_db == "") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" checked value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="orang-t" disabled>
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';	
}
elseif ($test_theme_db == "orang-t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" checked value="orang-t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';
}
elseif ($test_theme_db == "red-t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="orang-t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" checked value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';
}
elseif ($test_theme_db == "grey-t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="orang-t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" checked value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';
}
elseif ($test_theme_db == "black-t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="orang-t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" checked value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';
}
elseif ($test_theme_db == "oth-t") 
{
	echo '
			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-1" value="default-t">
			<label class="theme-selector-cont rad-t-1" for="rad-t-1">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Default Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-2" value="orang-t">
			<label class="theme-selector-cont rad-t-2" for="rad-t-2">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Orange Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-3" value="red-t">
			<label class="theme-selector-cont rad-t-3" for="rad-t-3">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Red Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-4" value="grey-t">
			<label class="theme-selector-cont rad-t-4" for="rad-t-4">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Gray Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-5" value="black-t">	
			<label class="theme-selector-cont rad-t-5" for="rad-t-5">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Black Theme</div>
			</label>

			<input type="radio" name="test-p-theme" class="rad-theme" id="rad-t-6" checked value="oth-t">	
			<label class="theme-selector-cont rad-t-6" for="rad-t-6">
				<div class="theme-img"><img src="../--sample--/sample-theme-img.png"></div>
				<div class="theme-data">Other new Theme</div>
			</label>
	';
}
?>