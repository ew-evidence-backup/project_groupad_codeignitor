<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// creating new instande of Login Button
$login = new LoginButton();

// Optional: setting title and size
$login->SetText("Sign up with Facebook");
$login->SetSize("small");

// Optional: setting list of extended permissions
$login->SetPermissions("email");

// Optional: setting the form id which will be submitted
// on successfull login (redirect on User Data page)
$login->SetOnLoginSubmitForm("form1");

// Render commmand on the page
$login->Render();
</pre>