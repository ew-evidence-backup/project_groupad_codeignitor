<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// create new instance of Permssions control
$perms = new Permissions();

// set permissions on email and SMS
$perms->SetPermissions("email, sms");

// Optional: set CSS class for add permissions button
$perms->SetCssClass("facebookbutton");

// Optional: set JavaScript code for confirmation
$perms->SetOnConfirmJavaScript("alert('permissions added')");

// Optional: set submit form id for confirmation
$perms->SetOnConfirmSubmitForm("form1");

// render the control on the page
$perms->Render();
</pre>

