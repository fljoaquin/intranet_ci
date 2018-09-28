<?php $this->load->view("templates/header"); ?>
<body>
<h2>Login Form</h2>
<div class="main-login-form-container">
    <?php if(! is_null($msg)){ ?>
    <div class="alert-danger center message-area">
        <?php echo $msg; ?>
    </div>
    <?php
        }
    ?>
    <form id="login" action="<?php echo base_url(); ?>login/process" method="POST">

        <div class="imgcontainer"></div>

        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" autocomplete="username" placeholder="Enter Username" name="username" id="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" autocomplete="current-password" placeholder="Enter Password" name="password" id="password" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <a href="home" class="cancelbtn">Cancel</a>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

</body>
</html>
