<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>MyMentor: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>MyMentor</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>
        <style>
            .space {
                padding: 70px 30px 70px 80px;
            }
                        
            .container
            {
                 /*center contents */
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
            
            #top
            {
                 /*surround with whitespace */
                margin-bottom: 15px;
                margin-top: 15px;
            }
            
            #top .nav
            {
                 /*center navigation pills */
                display: inline-block;
            }
            
            #middle .form-control
            {
                 /*center form controls */
                display: inline-block;
            
                 /*override Bootstrap's 100% width for form controls */
                width: auto;
            }
            
            #bottom
            {
                 /*shrink bottom's font size */
                font-size: smaller;
            
                 /*surround with whitespace */
                margin: 20px;
            }
        </style>

    </head>
    <body>
      
         <div class="container">

            <div id="top">
                <div>
                    <a href="/"><img alt="MyMentor" src="/img/mymentorlogo.gif"/></a>
                </div>
            </div>
            
            <div id="middle">
            
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Welcome to MyMentor</a>
                    </div>
    
                    <!--Navigation bar with dropdown-->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="student_login.php">Student Login</a></li>
                            <li><a href="mentor_login.php">Mentor Login</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="student_register.php">Student Register</a></li>
                            <li><a href="mentor_register.php">Mentor Register</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <p class = "space">
                
            </p>
            <form action="student_login.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id = "password" name="password" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="submit">
                            <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                            Student Log In
                        </button>
                    </div>
                </fieldset>
            </form>
            <div>
                or <a href="student_register.php">Student Register</a> for an account
            </div>
            </div>
        </div>
    </body>
</html>
