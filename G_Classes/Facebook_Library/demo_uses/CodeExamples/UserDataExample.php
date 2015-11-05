<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// create facebook object.
$facebook = new Facebook(FacebookKeys::GetKeyArray());

// create facebook session
$session = $facebook-&gt;getSession();

// check if user if connected
if ($session) {
    $uid = $facebook-&gt;getUser();
    $loggedUser = $facebook-&gt;api('/me');

    // get user data
    echo "&lt;b&gt;User data:&lt;/b&gt;&lt;br /&gt;";
    echo "&lt;br /&gt;&lt;b&gt;User ID:&lt;/b&gt; " . $loggedUser['id'];
    echo "&lt;br /&gt;&lt;b&gt;First name:&lt;/b&gt; " . $loggedUser['first_name'];
    echo "&lt;br /&gt;&lt;b&gt;Last name:&lt;/b&gt; " . $loggedUser['last_name'];

    // get first 5 friends
    echo "&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;b&gt;Friends:&lt;/b&gt;&lt;br /&gt;";
    $friends = $facebook-&gt;api('/me/friends');
    $friendsData = $friends['data'];

    for ($i = 0; $i &lt; sizeof($friendsData), $i &lt; 5; $i++)
    {
        $friend = $friendsData[$i];
        echo $friend['name'] . ", ";
    }
}
else
{
    echo "Error: Facebook Session does not exists. Please log in.";
}
</pre>
