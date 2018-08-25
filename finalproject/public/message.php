<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // get the profile of the user
        $user_profiles = CS50::query("SELECT * FROM students WHERE id = ?", $_SESSION["id"]);
        if($user_profiles)
        {
            // get mentor profile
            $contact_profiles = CS50::query("SELECT * FROM mentors WHERE mentee_id = ?", $_SESSION["id"]);
            // get messages corresponding to current user
            $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
            if($messages)
            {
                render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
            }
            else
            {
                // generate automatic message for new user
                CS50::query("INSERT INTO messages sender_id = ?, receiver_id = ?, text = ?, date_time = NOW()", $_SESSION["id"], $contact_profiles[0]["id"], "Welcome to MyMentor");
                $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
                render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
            }
        }
        else
        {
            // get user profile
            $user_profiles = CS50::query("SELECT * FROM mentors WHERE id = ?", $_SESSION["id"]);
            
            // get student profile
            $contact_profiles = CS50::query("SELECT * FROM students WHERE mentor_id = ?", $_SESSION["id"]);
            
            // store messages corresponding to current user
            $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
            if($contact_profiles)
            {
                render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
            }
            else
            {
              render("no_mentee_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "title" => "Message"]);
                
            }
        }
        
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $text = $_POST["message"];
        // validate submission
        if (empty($text))
        {
            apologize("Enter Message");
        }
        //   check if message length less than 500
        if(strlen($text) > 500)
        {
            apologize("Text tooooo long");
        }
        
        // query database for user
        $student = CS50::query("SELECT mentor_id FROM students WHERE id = ?", $_SESSION["id"]);
        if($student)
        {
            // student is sender and mentor is the receiver
            $mentor_receiver = $student[0];
            CS50::query("INSERT INTO messages (sender_id, receiver_id, text, date_time) VALUES ( ?, ? , ?, NOW())", $_SESSION["id"], $mentor_receiver["mentor_id"], $_POST["message"]);
        }
        
        else
        {
            // mentor is sender and student is the receiver
            $mentor = CS50::query("SELECT mentee_id FROM mentors WHERE id = ?", $_SESSION["id"]);
            $student_receiver= $mentor[0];
            CS50::query("INSERT INTO messages (sender_id, receiver_id, text, date_time) VALUES ( ?, ? , ?, NOW())", $_SESSION["id"], $student_receiver["mentee_id"], $_POST["message"]);
        }
        
        // get the profile of the user
        $user_profiles = CS50::query("SELECT * FROM students WHERE id = ?", $_SESSION["id"]);
        if($user_profiles)
        {
            // get mentor profile
            $contact_profiles = CS50::query("SELECT * FROM mentors WHERE mentee_id = ?", $_SESSION["id"]);
            // get messages corresponding to current user
            $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
            if($messages)
            {
                render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
            }
        }
        else
        {
            // get user profile
            $user_profiles = CS50::query("SELECT * FROM mentors WHERE id = ?", $_SESSION["id"]);
            
            // get student profile
            $contact_profiles = CS50::query("SELECT * FROM students WHERE mentor_id = ?", $_SESSION["id"]);
            
            if($contact_profiles)
            {
                // store messages corresponding to current user
                $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
                if($messages)
                {
                    render("message_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "contact_profiles" => $contact_profiles, "title" => "Message"]);
                }
            }
            
            else
            {
                // if mentor has not been assigned a student, transfer to no_mentee_form
                $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY id DESC", $_SESSION["id"], $_SESSION["id"]);
                render("no_mentee_form.php", ["messages" => $messages, "user_profiles" => $user_profiles, "title" => "Message"]);
            }
        }
    }
?>