# ci4-googleAuth\
This is a simple Sample Code for Google Signin in Codeigniter 4\
\
Before implementing signin \\
\
go to \\
Credential ['https://console.cloud.google.com/apis/credentials']\\
Click "Create Credential";\\
Click "OAuth client ID"\\
Type "Web Application"\\
Enter name \\
Enter URL of your website\\
Click Create\\
Copy CLIENT ID = XXXXXXXXXXXXX-xxxxxxxxxxxxxxxxxxxxxxx.apps.googleusercontent.com Which Looks Like This \
\
and paste that in \
\
app/views/Login.php\\
\\
```html
<div
   id="g_id_onload" 
   data-client_id="PASTE_HERE"
   data-context="signin"
   data-ux_mode="popup"
   data-login_uri="YOUR_LOGIN_PAGE_FULL_ROUTE"
   data-auto_prompt="false">
</div>

 <div
   class="g_id_signin"
   data-type="standard"
   data-shape="rectangular"
   data-theme="outline"
   data-text="signin_with"
   data-size="large"
   data-logo_alignment="left">
            </div>

```
