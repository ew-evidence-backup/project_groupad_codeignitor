<pre style="background-color:#FAFAFA;border:1px solid gray;color:blue; width: 980px">
 // create instance of stream publich cotrols
 $publish = new StreamPublish();

 // Optional: set story name
 $publish->SetName("Story Name");

 // Optional: set caption
 $publish->SetCaption("{*actor*} publish this story:");

 // Optional: set description
 $publish->SetDescription("This is a description of the story");

 // Optional: set css class of publish button
 $publish->SetCssClass("facebookbutton");

 // Optional: set video as media
 $publish->SetMedia(new ImageMedia("http://images.vatlab.net/cat.png", "http://vatlab.com"));

 // Optional: display popup
 $publish->SetDisplayPopup(true);

// Optional: add property
$publish->AddPropery(new Property("Product Name", "Faceconn Toolkit"));
$publish->AddPropery(new LinkedProperty("Product Demo", "Faceconn Toolkit Demo", "http://faceconn.com/demo/"));

 // Optional: add action link
 $publish->AddActionLink(new ActionLink("Faceconn", "http://faceconn.com"));

 // render component on page
 $publish->Render();
</pre>