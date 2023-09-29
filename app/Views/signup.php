<div class="container-fluid  bg-dark text-light  p-5  mt-5 main-bg half-vh d-flex flex-column justify-content-center ">
    <div class="container">
        <h1 class="heading pt-3 ">Register</h1>
    </div>
</div>

<div class="container my-5">

    <div class="row">
        <div class="col-lg-6 grid-center">
            <h1 class="heading">Register</h1>
        </div>
        <div class="col-lg-6 p-4">

<!------------------------------------------------------------------------------------------------>
          
            <div id="g_id_onload" data-client_id="######################################.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="YOUR_SIGNUP_PAGE_FULL_ROUTE" data-auto_prompt="false">
            </div>

            <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signup_with" data-size="large" data-logo_alignment="left">
            </div>

<!------------------------------------------------------------------------------------------------>

          
            <hr>
            <form action="/signupvalidation" method="post">
                <div class=" mb-3">
                    <label for="floatingInput">Name</label>
                    <input type="text" class="form-control form-control-sm" id="floatingInput" name="name" placeholder="name@example.com" required>

                </div>
                <div class=" mb-3">
                    <label for="floatingInput">Email address</label>
                    <input type="email" class="form-control form-control-sm" id="floatingInput" name="email" placeholder="name@example.com" required>

                </div>
                <div class=" mb-3 ">
                    <label for="floatingInput">Password</label>
                    <input type="password" class="form-control form-control-sm" id="password" name="password" required>

                </div>
                <div class=" mb-3 ">
                    <label for="floatingInput">Confirm Password</label>
                    <input type="password" class="form-control form-control-sm " id="cpassword" name="cpassword" required oninput="checkcpass()">

                </div>
                <div id="match" class="hide mb-3 text-danger">
                    Password is not matching
                </div>
                <button type="submit" id="submit" class="btn btn-sm btn-success">Sign up</button>
            </form>

        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------>
<script src="https://accounts.google.com/gsi/client" async defer></script>

<!------------------------------------------------------------------------------------------------>
<script>
    function togglePass() {
        let password = document.querySelector('#password');
        return password.type == "password" ? password.type = "text" : password.type = "password";
    }

    function checkcpass() {
        let password = document.querySelector('#password');
        let cpassword = document.querySelector('#cpassword');
        let feedback = document.querySelector('#match');
        let submit = document.querySelector('#submit');
        if (password.value != cpassword.value) {
            feedback.classList.remove('hide');
            submit.setAttribute('disabled', '');
        } else {
            feedback.classList.add('hide');
            submit.removeAttribute('disabled', '');
        }

    }
</script>
