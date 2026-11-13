<?php
session_start();

// grab the errors from the session, or default to an empty 
// array if the key does not exist or is null
//
// store the errors in a variable so we don't have to keep reading $_SESSION
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// reset the inputted data so that if the user refreshes the page,
// the old information is no longer in the session
$_SESSION['form_input'] = [];

// do the same with our errors:
$_SESSION['form_errors'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- loading from WAMP / MAMP: -->
        <!-- WAMP: localhost/week_nine_inclass/adopt-form.php -->
        <!-- MAMP: localhost:8888/week_nine_inclass/adopt-form.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Technology Survey</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Student Technology Survey</h1>
        </header>
        
        <form action="includes/scripts/process-survey.php" method="POST">


    <!-- INTRO TEXT QUESTIONS -->
     <div>
        <?php
            if (array_key_exists('name', $errors)) {
                echo '<p style="color:red">' . $errors['name'] . '</p>';
            }
        ?>
        
        <label for="first_name">First Name</label>
        <input
            id="first-name"
            name="name"
            type="text"
            placeholder="Your First Name"
            <?php if (count($errors) > 0 && $submittedName) {
                echo 'value="' . $submittedName . '"';  
                // alternatively, you could use interpolation:
                //echo "value=\"{$submittedName}\"";          
                        }
                ?>
            >
     </div>
     <div>
        <?php
            if (array_key_exists('name', $errors)) {
                echo '<p style="color:red">' . $errors['name'] . '</p>';
            }
        ?>
        
        <label for="last_name">Last Name</label>
        <input
            id="last-name"
            name="name"
            type="text"
            placeholder="Your Last Name"
            <?php if (count($errors) > 0 && $submittedName) {
                echo 'value="' . $submittedName . '"';  
                // again, you could use interpolation:
                //echo "value=\"{$submittedName}\"";          
                        }
            ?>
     </div>
     <div>
        <?php 
            if (array_key_exists('email', $errors)) {
                echo '<p style="color:red">' . $errors['email'] . '</p>';
                        }
                    ?>
        <label for="email_address">Email Address</label>
        <!-- the 'name' attribute on the input is the key this value will be store in on the request; so 'name="email"' means the key will be 'email' -->
            <input id="email-address" name="email" type="email" placeholder="i.e. info@email.com">
     </div>

     <div>
        <label for="reason">What Type Of Device Do You Use?</label>
        <textarea id="reason" name="reason"></textarea>
     </div>
     <div>
        <select id="which_city">
            <option value="select">Please Select</option>
            <option value="london">London</option>
            <option value="hamilton">Hamilton</option>
            <option value="kingston">Kingston</option>
            <option value="mississauga">Mississauga</option>
        </select>
     </div>

     <fieldset>
        <!-- use fieldset to group inputs together if they're part of the same "question" -->
        <legend>Which other cats are you interested in?</legend>
            <label for="london">London</label>
            <input id="london" type="checkbox" name="ontario_canada[]" value="london">

            <label for="hamilton">Hamilton</label>
            <input id="hamilton" type="checkbox" name="ontario_canada[]" value="hamilton">

            <label for="kingston">Kingston</label>
            <input id="kingston" type="checkbox" name="ontario_canada[]" value="kingston">

            <label for="mississauga">Mississauga</label>
            <input id="mississauga" type="checkbox" name="ontario_canada[]" value="mississauga">
                </fieldset>


<!-- MULTIPLE SELECT #1 -->
    <label for="design_software">Design Software Used</label>

    <input type="checkbox" name="software[]" value="photoshop">Photoshop
    <input type="checkbox" name="software[]" value="illustrator">Illustrator
    <input type="checkbox" name="software[]" value="figma">Figma
    <input type="checkbox" name="software[]" value="canva">Canva


<!-- MULTIPLE SELECT #2 -->
    <label for="streaming_services">Streaming Services</label>

    <input type="checkbox" name="streaming[]" value="netflix">Netflix
    <input type="checkbox" name="streaming[]" value="disney+">Disney+
    <input type="checkbox" name="streaming[]" value="prime">Prime Video


<!-- MULTIPLE SELECT #3 -->
    <label for="social_media">Social Media Platforms</label>

    <input type="checkbox" name="social[]" value="instagram">Instagram
    <input type="checkbox" name="social[]" value="tikTok">TikTok
    <input type="checkbox" name="social[]" value="tumblr">Tumblr


<!-- LONG ANSWERS -->
    <label for="enjoy_technology">What Do You Enjoy Most About Technology?</label>
    <textarea id="technology" name="technology"></textarea>

    <label for="digital_workspace">Describe Your Ideal Digital Workspace.</label>
    <textarea id="digital-workspace" name="workspace"></textarea>


<!-- SINGLE SELECT QUESTIONS -->
    <label for="preferred-device">Preferred Device</label>

    <input type="radio" name="preferredDevice" value="desktop">Desktop
    <input type="radio" name="preferredDevice" value="laptop">Laptop
    <input type="radio" name="preferredDevice" value="tablet">Tablet


    <label for="learn_preferrence">Learning Preference</label>

    <input type="radio"
    name="learning"
    value="Online">Online
    <input type="radio"
    name="learning"
    value="In-Person">In-Person


    <label for="operate_system">Operating System</label>

    <input type="system" name="system" value="windows">Windows
    <input type="system" name="system" value="macOS">MacOS


    <label for="screen_time">Daily Screen Time</label>

    <input type="radio" name="screenTime" value="1-3">1-3 Hours
    <input type="radio" name="screenTime" value="4-6">4-6 Hours
    <input type="radio" name="screenTime" value="7+">7+ Hours


<!-- EXTRA QUESTIONS -->
    <label for="phone_number">Phone Number</label>
        <input type="tel" name="phone_number" placeholder="(888) 888 8888">

    <label for="fav_colour">Favourite Colour</label>
        <input type="color" name="color" placeholder="chartruese">

    <label for="fav_hobby">Favourite Hobby</label>
        <input type="hobby" name="hobby" placeholder="badminton">

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="main.js"></script>
</body>
</html>