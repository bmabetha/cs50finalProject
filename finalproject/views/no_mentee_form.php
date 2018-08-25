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
        <div class="container-fluid">
            <div class="row">
                <!--create a window to show details of user profile and populate it with user details-->
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
                <!--create a window telling the user that they haven't being assigned a mentee-->
                <div class="col2 col-md-4"><h4>Mentee Profile</h4>
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <p class="list-group-item-text">
                                <p>Not Yet Assigned a Mentee</p>
                                <p>Once Assigned Their Details Will Appear Here</p>
                            </p>
                        </a>
                    </div>
                </div>
                <!--create a window showign the welcome message-->
                <div class="col3 col-md-4"><h4>Messages</h4>
                    <?php foreach ($messages as $message): ?>
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
        <!--<div class="form-group">-->
        <!--    <label for="message">Message</label>-->
        <!--    <textarea name="message" rows="10" cols="50" class="form-control" id="message"-->
        <!--        placeholder="Type Message ..."></textarea>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--    <button class="btn btn-default" type="submit">-->
        <!--        <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>-->
        <!--        Send Message-->
        <!--    </button>-->
        <!--</div>-->
    </fieldset>
</form>