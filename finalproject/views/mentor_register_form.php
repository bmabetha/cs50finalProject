
    <form action = "mentor_register.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id = "firstname" class="form-control" name="firstname" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id = "lastname" class="form-control" name="lastname" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id = "username" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id = "email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id = "password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="confirmation">Confirm Password</label>
            <input type="password" id = "confirmation" class="form-control" name="confirmation" placeholder="Confirm Password">
        </div>
        <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id = "country" class="form-control" name="country" placeholder="Country">
        </div>
        <div class="form-group">
            <label for="region">Region</label>
            <input type="text" id = "region" class="form-control" name="region" placeholder="Region">
        </div>
        <div class="form-group">
            <label for="academic_interest">Academic Interest</label>
            <input type="text" id = "academic_interest" class="form-control" name="academic_interest" placeholder="Academic Interest">
        </div>
        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea name="biography" rows="15" cols="50" class="form-control" id="biography"
                      placeholder="Enter biography here (250 words max)..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <div>
        or <a href="../mentor_login.php">login</a> if you already have an account
    </div>