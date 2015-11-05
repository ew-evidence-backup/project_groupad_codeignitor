<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// create new instance of the control
$like = new LikeButton();

// Optional: set external URL
$like->SetUrl("http://faceconn.com");

// render the control on the page
$like->Render();

// set layout to button_count
$like->SetLayout("button_count");
$like->Render();

// set layout to box_count
$like->SetLayout("box_count");
$like->Render();

// set layout to standard and show send button
$like->SetLayout("standard");
$like->SetSend(true);
$like->Render();
</pre>
