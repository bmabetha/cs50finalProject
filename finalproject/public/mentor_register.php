<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //render form
        render("mentor_register_form.php", ["title" => "Mentor Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // input verification
        if(empty($_POST["firstname"])||empty($_POST["lastname"])||empty($_POST["username"]))
        {
            apologize("First name, Last Name or Username not filled");
        }
        if (empty($_POST["password"]) || (empty($_POST["confirmation"])))
        {
            apologize("You must provide your password and confirmation");
        }
        if (empty($_POST["email"]))
        {
            apologize("Please provide your email");
        }
        if($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match");
        }
        if(empty($_POST["country"])||empty($_POST["region"])||empty($_POST["academic_interest"]))
        {
            apologize("Please fill all fields");
        }
        if(strlen($_POST["biography"]) == 0 || strlen($_POST["biography"]) > 250)
        {
            apologize("Biography does not satisfy the word count requirements");
        }
        $check_username = CS50::query("SELECT username FROM mentors WHERE username = ?", $_POST["username"]);
        if($check_username)
        {
            apologize("Username already exist");
        }
        
        if($_POST["password"] == $_POST["confirmation"])
        {
            // insert new mentor database
            $result = CS50::query("INSERT INTO mentors (first_name, last_name, username, email, password, country, region, academic_interests, biography)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", $_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["country"], $_POST["region"], $_POST["academic_interest"], $_POST["biography"]);
        }
        
        if($result!=false)
        {
            // remember user id
            $rows = CS50::query("SELECT id FROM mentors WHERE username = ?", $_POST["username"]);
            $_SESSION["id"] = $rows[0]["id"];
            
            $user_profiles = CS50::query("SELECT * FROM mentors WHERE id = ?", $_SESSION["id"]);
            
            // generate automatic message for new user
            CS50::query("INSERT INTO messages (sender_id, text, date_time) VALUES (?, ?, NOW())", $_SESSION["id"], "Welcome to MyMentor");
            $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
            // render a form that does not require mentee details because the user has not been assigned a mentee
            render("no_mentee_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "title" => "Message"]);
        }
    }
?>