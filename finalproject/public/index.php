<?php

    // configuration
    require("../includes/config.php");
    
    $messages = CS50::query("SELECT * FROM messages WHERE sender_id = ?", $_SESSION["id"]);
    $sender = CS50::query("SELECT username FROM students WHERE id = ?", $_SESSION["id"]);

    $positions = [];
    foreach ($messages as $message)
    {
        $receiver = CS50::query("SELECT username FROM mentors WHERE id = ?", $message["receiver_id"]);
        $positions[] = [
            "sender" => $sender,
            "receiver" => $receiver,
            "time" => $messages["date_time"],
            "message" => $messages["text"],
        ];
    }
    
    // render message
    render("message_form.php", ["positions" => $positions, "title" => "Message"]);
    
    
?>
