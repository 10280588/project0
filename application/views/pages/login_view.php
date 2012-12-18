<div data-role="page" id="login" data-theme="a">
    
    
    
    
    <div id="pictureFrame">
        <img src="http://www.fas.harvard.edu/home/sites/all/themes/fas/images/harvard_fas_logo.jpg" width="280" alt="" />
    </div>
    
    <div data-role="content" class="ui-content" role="main">
    
    <?php echo validation_errors(); ?>
    
    <form action="login" method="post">
    <h3>Student number:</h3>
    <input type="tel"  name="student_number" id="student_number" value="<?php echo set_value('student_number'); ?>"  />
    <h3>Password:</h3>
    <input type="password" name="password" id="password" value=""  />
    </br>
    <label><input type="checkbox" name="cookieCheck" data-role="none" /> Keep me logged in </label>
    </br>
    </br>
    <input type="submit"  value="Login" />
    </form>
    
    </div>
    
    
</div>
