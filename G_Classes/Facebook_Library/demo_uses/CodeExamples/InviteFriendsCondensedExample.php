<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// create instance of login control
$invite2 = new InviteFriendsCondensed();

// set URL where app will be redirected after invitations are sent
$invite2-&gt;SetActionUrl("http://localhost:81/");

// set content inside invite request
$invite2-&gt;SetContent("This is content of invite request.");

// render the command
$invite2-&gt;Render();
</pre>



