<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
// create instance of the control
$likeBox = new LikeBox();

// setting of page Id
$likeBox->SetPageId("224341998463");

// render the default control on the page
$likeBox->Render();

// render without fan list
$likeBox->SetFansCount(0);
$likeBox->Render();

// render without fan list and stream
$likeBox->SetShowStream(false);
$likeBox->Render();
</pre>