<form action="message.php" method="post">
    <style>
        .col1 {
            min-height: 400px;
            max-height: 400px;
            border-style: double;
            overflow: scroll;
        }

        .col2 {
            min-height: 400px;
            max-height: 400px;
            border-style: double;
            overflow: scroll;
        }
        .col3 {
            min-height: 400px;
            max-height: 400px;
            border-style: double;
            overflow: scroll;
        }
    </style>
   <fieldset>
       <!--create a window to show User Profile and populate it with their details-->
        <div class="container-fluid">
            <div class="row">
                <div class="col1 col-md-4"><h4>Your Profile</h4>  
                    <?php foreach ($user_profiles as $user_profile): ?>
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <p class="list-group-item-text">
                                    <p><strong>First Name:</strong> <?= $user_profile["first_name"]?></p>
                                    <p><strong>Last Name:</strong> <?= $user_profile["last_name"]?></p>
                                    <p><strong>User Name:</strong> <?= $user_profile["username"]?></p>
                                    <p><strong>email:</strong> <?= $user_profile["email"]?></p>
                                    <p><strong>Country:</strong> <?= $user_profile["country"]?></p>
                                    <p><strong>Region:</strong> <?= $user_profile["region"]?></p>
                                    <p><strong>Academic Interest:</strong> <?= $user_profile["academic_interests"]?></p>
                                    <strong>Biography:</strong> <?= $user_profile["biography"]?>
                                </p>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <!--create a window to show details of Mentor/Mentee and populate it with Mentee details-->
                <div class="col2 col-md-4"><h4>Mentor/Mentee Contacts</h4>
                    <?php foreach ($contact_profiles as $contact_profile): ?>
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <p class="list-group-item-text">
                                    <p><strong>First Name:</strong> <?= $contact_profile["first_name"]?></p>
                                    <p><strong>Last Name:</strong> <?= $contact_profile["last_name"]?></p>
                                    <p><strong>User Name:</strong> <?= $contact_profile["username"]?></p>
                                    <p><strong>email:</strong> <?= $contact_profile["email"]?></p>
                                    <p><strong>Country:</strong> <?= $contact_profile["country"]?></p>
                                    <p><strong>Region:</strong> <?= $contact_profile["region"]?></p>
                                    <p><strong>Academic Interest:</strong> <?= $contact_profile["academic_interests"]?></p>
                                    <strong>Biography:</strong> <?= $contact_profile["biography"]?>
                                </p>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <!--create a window to show details of Messages and populate it with Messages-->
                <div class="col3 col-md-4"><h4>Messages</h4>
                    <?php foreach ($messages as $message): ?>
                        <!--check if user is sender or receiver then make the messages blue or white respectively-->
                        <?php if($message["sender_id"] == $_SESSION["id"]): ?>
                            <div class="list-group">
                                <a href="#" class="list-group-item active">
                                    <h6 class="list-group-item-heading"><?= $message["date_time"] ?></h6>
                                    <p class="list-group-item-text">
                                        <option ><?= $message["text"]?>
                                        </option>
                                    </p>
                                </a>
                            </div>
                        <?php else : ?>
                           <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <h6 class="list-group-item-heading"><?= $message["date_time"] ?></h6>
                                    <p class="list-group-item-text">
                                        <option ><?= $message["text"]?>
                                        </option>
                                    </p>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <!--create a window for sending messages-->
            <label for="message">Message</label>
            <textarea name="message" rows="10" cols="50" class="form-control" id="message"
                placeholder="Type Message ..."></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Send Message
            </button>
        </div>
    </fieldset>
</form>