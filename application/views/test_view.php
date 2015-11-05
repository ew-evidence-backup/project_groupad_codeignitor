<?
     include('G_Classes/GSR.php');
     $GSR = new GSR;

     $template['default']['regions'] = array(
       'header',
       'content',
       'footer',
     );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <? $GSR->headBlock("GroupAd", "Description", "Ads") ?>
     <?  $GSR->css(); ?>
</head>

<body>

<div id="wrapper">

<? include('inc.header.php'); ?>
     <!-- #header-->

     <div id="middle">

          <div id="container">
               <div id="content">
                    <strong>Content:</strong> Sed placerat accumsan ligula. Aliquam felis magna, congue quis, tempus eu,
                    aliquam vitae, ante. Cras neque justo, ultrices at, rhoneeecus a, facilisis eget, nisl. Quisque vitae
                    pede. Nam et augue. Sed a elit. Ut vel massa. Suspendisse nibh pede, ultrices vitae, ultrices nec,
                    mollis non, nibh. In sit ffff pede quis leo vulputate hendrerit. Cras laoreet leo et justo auctor
                    condimentum. Integer id enim. Suspendisse egestas, dui ac egestas mollis, libero orci hendrerit
                    lacus, et malesuada lorem neque ac libero. Morbi tempor pulvinar pede. Donec vel elit.
               </div>
               <!-- #content-->
          </div>
          <!-- #container-->


               <? include('inc.left_side_menu.php'); ?>

          <!-- .sidebar#sideLeft -->

     </div>
     <!-- #middle-->

</div>
<!-- #wrapper -->

<!-- #footer -->
<? include('inc.footer.php'); ?>
</body>
</html>
     <? $GSR->developmentEnvironment(); ?>
