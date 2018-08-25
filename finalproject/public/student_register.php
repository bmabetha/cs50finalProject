<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // find subjects with available mentors
        $mentors_academic_interests = CS50::query("SELECT DISTINCT academic_interests FROM mentors WHERE mentee_no= ?", 0);
        
        render("student_register_form.php", ["mentors_academic_interests" => $mentors_academic_interests, "title" => "Student Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
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
            // insert user in database
            $result = CS50::query("INSERT INTO students (first_name, last_name, username, email, password, country, region, academic_interests, biography)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", $_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["country"], $_POST["region"], $_POST["academic_interest"], $_POST["biography"]);
        }
        
        if($result!=false)
        {
            // remember user id
            $rows = CS50::query("SELECT id FROM students WHERE username = ?", $_POST["username"]);
            $_SESSION["id"] = $rows[0]["id"];
           
             // match student and mentor and update database
             
            $mentors_avail = CS50::query("SELECT id FROM mentors WHERE academic_interests = ? AND mentee_no = ?", $_POST["academic_interest"], 0);
            $student_mentor = $mentors_avail[0];
            
            CS50::query("UPDATE mentors SET mentee_no = mentee_no + 1 WHERE id = ?", $student_mentor["id"]);
            
            CS50::query("UPDATE students SET mentor_id = ? WHERE id = ?", $student_mentor["id"], $_SESSION["id"]);
    
            CS50::query("UPDATE mentors SET mentee_id = ? WHERE id = ?", $_SESSION["id"], $student_mentor["id"]);
            
            
            $user_profiles = CS50::query("SELECT * FROM students WHERE id = ?", $_SESSION["id"]);
            $contact_profiles = CS50::query("SELECT * FROM mentors WHERE mentee_id = ?", $_SESSION["id"]);
            
            // generate automatic message for new user
            CS50::query("INSERT INTO messages (sender_id, receiver_id, text, date_time) VALUES (?, ?, ?, NOW())", $_SESSION["id"], $contact_profiles[0]["id"], "Welcome to MyMentor");
            $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
            
            //transfer to message_form.php
            render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
        }
    }
?>