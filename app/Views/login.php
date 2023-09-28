<div class="container my-5  py-5">

    <div class="row">
        <div class="col-lg-6 grid-center">
            <h1 class="heading">Login</h1>
        </div>
        <div class="col-lg-6 p-4">
            <form action="/login-validation" method="post">
                <div class=" mb-3">
                    <label for="floatingInput">Email address</label>
                    <input type="email" class="form-control form-control-sm" id="floatingInput" name="email" placeholder="name@example.com" required>

                </div>
                <div class="mb-3">
                    <label for="floatingInput">Password</label>
                    <div class="d-flex">
                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                        <a class="btn btn-light grid-center" onclick="togglePass()">&#128065;</a>
                    </div>

                </div>
                <button type="submit" class="btn btn-sm btn-success">Login</button>
                <a href="/forgot_password_form" class="btn btn-sm btn-secondary">Reset Password</a>
            </form>
            <hr>

              /////////////////////////////   /////////////////////////////   /////////////////////////////   ///////////////////////////// 
            <div id="g_id_onload" data-client_id="######################################.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="YOUR_LOGIN_PAGE_FULL_ROUTE" data-auto_prompt="false">
            </div>

            <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left">
            </div>
                 /////////////////////////////   /////////////////////////////   /////////////////////////////   /////////////////////////////
        </div>

    </div>
</div>
                 /////////////////////////////   /////////////////////////////   /////////////////////////////
<script src="https://accounts.google.com/gsi/client" async defer></script>
                 /////////////////////////////   /////////////////////////////   /////////////////////////////
<script>
    function togglePass() {
        let password = document.querySelector('#password');
        return password.type == "password" ? password.type = "text" : password.type = "password";


    }
</script>
