<!doctype html>
<html lang="en-us">
<head>
     <meta charset="utf-8">

     <title>White Label - a full featured Admin Skin</title>

     <meta name="description" content="">
     <meta name="author" content="revaxarts.com">


     <!-- Google Font and style definitions -->
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
     <link rel="stylesheet" href="<? echo site_url(); ?>application/views/css/style.css">

     <!-- include the skins (change to dark if you like) -->
     <link rel="stylesheet" href="css/light/theme.css" id="themestyle">

     <!-- <link rel="stylesheet" href="css/dark/theme.css" id="themestyle"> -->

     <!--[if lt IE 9]>
     <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
     <link rel="stylesheet" href="css/ie.css">
     <![endif]-->

     <!-- Apple iOS and Android stuff -->
     <meta name="apple-mobile-web-app-capable" content="no">
     <meta name="apple-mobile-web-app-status-bar-style" content="black">
     <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

     <!-- Apple iOS and Android stuff - don't remove! -->
     <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">

     <!-- Use Google CDN for jQuery and jQuery UI -->
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>

     <!-- Loading JS Files this way is not recommended! Merge them but keep their order -->

     <!-- some basic functions -->
     <script src="js/functions.js"></script>

     <!-- all Third Party Plugins and Whitelabel Plugins -->
     <script src="js/plugins.js"></script>
     <script src="js/editor.js"></script>
     <script src="js/calendar.js"></script>
     <script src="js/flot.js"></script>
     <script src="js/elfinder.js"></script>
     <script src="js/datatables.js"></script>
     <script src="js/wl_Alert.js"></script>
     <script src="js/wl_Autocomplete.js"></script>
     <script src="js/wl_Breadcrumb.js"></script>
     <script src="js/wl_Calendar.js"></script>
     <script src="js/wl_Chart.js"></script>
     <script src="js/wl_Color.js"></script>
     <script src="js/wl_Date.js"></script>
     <script src="js/wl_Editor.js"></script>
     <script src="js/wl_File.js"></script>
     <script src="js/wl_Dialog.js"></script>
     <script src="js/wl_Fileexplorer.js"></script>
     <script src="js/wl_Form.js"></script>
     <script src="js/wl_Gallery.js"></script>
     <script src="js/wl_Multiselect.js"></script>
     <script src="js/wl_Number.js"></script>
     <script src="js/wl_Password.js"></script>
     <script src="js/wl_Slider.js"></script>
     <script src="js/wl_Store.js"></script>
     <script src="js/wl_Time.js"></script>
     <script src="js/wl_Valid.js"></script>
     <script src="js/wl_Widget.js"></script>

     <!-- configuration to overwrite settings -->
     <script src="js/config.js"></script>

     <!-- the script which handles all the access to plugins etc... -->
     <script src="js/script.js"></script>


</head>
<body>
<div id="pageoptions">
     <ul>
          <li><a href="login.html">Logout</a></li>
          <li><a href="#" id="wl_config">Configuration</a></li>
          <li><a href="#">Settings</a></li>
     </ul>
     <div>
          <h3>Place for some configs</h3>

          <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica,
               sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li
               pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On
               refusa continuar payar custosi traductores.</p>
     </div>
</div>

<header>
     <div id="logo">
          <a href="test.html">Logo Here</a>
     </div>
     <div id="header">
          <ul id="headernav">
               <li>
                    <ul>
                         <li><a href="icons.html">Icons</a><span>300+</span></li>
                         <li><a href="#">Submenu</a><span>4</span>
                              <ul>
                                   <li><a href="#">Just</a></li>
                                   <li><a href="#">another</a></li>
                                   <li><a href="#">Dropdown</a></li>
                                   <li><a href="#">Menu</a></li>
                              </ul>
                         </li>
                         <li><a href="login.html">Login</a></li>
                         <li><a href="wizard.html">Wizard</a><span>Bonus</span></li>
                         <li><a href="#">Errorpage</a><span>new</span>
                              <ul>
                                   <li><a href="error-403.html">403</a></li>
                                   <li><a href="error-404.html">404</a></li>
                                   <li><a href="error-405.html">405</a></li>
                                   <li><a href="error-500.html">500</a></li>
                                   <li><a href="error-503.html">503</a></li>
                              </ul>
                         </li>
                    </ul>
               </li>
          </ul>
          <div id="searchbox">
               <form id="searchform" autocomplete="off">
                    <input type="search" name="query" id="search" placeholder="Search">
               </form>
          </div>
          <ul id="searchboxresult">
          </ul>
     </div>
</header>

<nav>
     <ul id="nav">
          <li class="i_house"><a href="dashboard.html"><span>Dashboard</span></a></li>
          <li class="i_book"><a><span>Documentation</span></a>
               <ul>
                    <li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
                    <li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
                    <li><a href="doc-calendar.html"><span>Calendar</span></a></li>
                    <li><a href="doc-charts.html"><span>Charts</span></a></li>
                    <li><a href="doc-dialog.html"><span>Dialog</span></a></li>
                    <li><a href="doc-editor.html"><span>Editor</span></a></li>
                    <li><a href="doc-file.html"><span>File</span></a></li>
                    <li><a href="doc-fileexplorer.html"><span>Fileexplorer</span></a></li>
                    <li><a href="doc-form.html"><span>Form</span></a></li>
                    <li><a href="doc-gallery.html"><span>Gallery</span></a></li>
                    <li><a href="doc-inputfields.html"><span>Inputfields</span></a></li>
                    <li><a href="doc-slider.html"><span>Slider</span></a></li>
                    <li><a href="doc-store.html"><span>Store</span></a></li>
                    <li><a href="doc-widget.html"><span>Widget</span></a></li>
               </ul>
          </li>
          <li class="i_create_write"><a href="form.html"><span>Form</span></a></li>
          <li class="i_graph"><a href="charts.html"><span>Charts</span></a></li>
          <li class="i_images"><a href="gallery.html"><span>Gallery</span></a></li>
          <li class="i_blocks_images"><a href="widgets.html"><span>Widgets</span></a></li>
          <li class="i_breadcrumb"><a href="breadcrumb.html"><span>Breadcrumb</span></a></li>
          <li class="i_file_cabinet"><a href="fileexplorer.html"><span>Fileexplorer</span></a></li>
          <li class="i_calendar_day"><a href="calendar.html"><span>Calendar</span></a></li>
          <li class="i_speech_bubbles_2"><a href="dialogs_and_buttons.html"><span>Dialogs &amp; Buttons</span></a></li>
          <li class="i_table"><a href="datatable.html"><span>Table</span></a></li>
          <li class="i_typo"><a href="typo.html"><span>Typo</span></a></li>
          <li class="i_grid"><a href="grid.html"><span>Grid</span></a></li>
     </ul>
</nav>


<section id="content">

<div class="g12 nodrop">
     <h1>Dashboard</h1>

     <p>This is a quick overview of some features</p>
</div>


<div class="g6 widgets">

     <div class="widget" id="calendar_widget" data-icon="calendar">
          <h3 class="handle">Calendar</h3>

          <div>
               <div class="calendar" data-header="small">
               </div>
               <p>
                    <a class="btn" href="calendar.html">Check out the Calendar section</a>
               </p>
          </div>
     </div>

     <div class="widget" id="widget_tabs">
          <h3 class="handle">Tabs</h3>

          <div class="tab">
               <ul>
                    <li><a href="#tabs-1">Nunc tincidunt</a></li>
                    <li><a href="#tabs-2">Proin dolor</a></li>
                    <li><a href="#tabs-3">Aenean lacinia</a></li>
               </ul>
               <div id="tabs-1">
                    <p>
                         Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu.
                         Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet
                         massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus
                         sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum.
                         Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed
                         ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.
                    </p>
               </div>
               <div id="tabs-2">
                    <p>
                         Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra
                         massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus
                         malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet
                         fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros
                         vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc.
                         Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis.
                         Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu
                         ornare leo nisi vel felis. Mauris consectetur tortor et purus.
                    </p>
               </div>
               <div id="tabs-3">
                    <p>
                         Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede
                         vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum
                         non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                         himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus
                         hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a,
                         lacus.
                    </p>

                    <p>
                         Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac
                         lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing
                         velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus
                         eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis
                         commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede.
                         Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit.
                         Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.
                    </p>
               </div>
          </div>
     </div>

     <div class="widget number-widget" id="widget_number">
          <h3 class="handle">Number</h3>

          <div>
               <ul>
                    <li><a href=""><span>7423</span> Total Visits</a></li>
                    <li><a href=""><span>392</span> Today Visits</a></li>
                    <li><a href=""><span>153</span> Unique Visits</a></li>
                    <li><a href=""><span>14</span> Support Tickets</a></li>
                    <li><a href=""><span>253</span> Comments</a></li>
               </ul>
          </div>
     </div>
</div>


<div class="g6 widgets">
<div class="widget" id="widget_charts" data-icon="graph">
     <h3 class="handle">Charts</h3>

     <div>
          <table class="chart" data-fill="true" data-tooltip-pattern="%1 %2 on the 2011-03-%3">
               <thead>
                    <tr>
                         <th></th>
                         <th>01</th>
                         <th>02</th>
                         <th>03</th>
                         <th>04</th>
                         <th>05</th>
                         <th>06</th>
                         <th>07</th>
                         <th>08</th>
                         <th>09</th>
                         <th>10</th>
                         <th>11</th>
                         <th>12</th>
                         <th>13</th>
                         <th>14</th>
                         <th>15</th>
                         <th>16</th>
                         <th>17</th>
                         <th>18</th>
                         <th>19</th>
                         <th>20</th>
                         <th>21</th>
                         <th>22</th>
                         <th>23</th>
                         <th>24</th>
                         <th>25</th>
                         <th>26</th>
                         <th>27</th>
                         <th>28</th>
                         <th>29</th>
                         <th>30</th>
                         <th>31</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <th>Total Visitors</th>
                         <td>331</td>
                         <td>306</td>
                         <td>337</td>
                         <td>340</td>
                         <td>332</td>
                         <td>330</td>
                         <td>307</td>
                         <td>343</td>
                         <td>307</td>
                         <td>322</td>
                         <td>319</td>
                         <td>314</td>
                         <td>326</td>
                         <td>317</td>
                         <td>323</td>
                         <td>347</td>
                         <td>317</td>
                         <td>341</td>
                         <td>328</td>
                         <td>307</td>
                         <td>350</td>
                         <td>330</td>
                         <td>313</td>
                         <td>314</td>
                         <td>332</td>
                         <td>330</td>
                         <td>317</td>
                         <td>346</td>
                         <td>328</td>
                         <td>312</td>
                         <td>311</td>
                    </tr>
                    <tr>
                         <th>Unique Visitors</th>
                         <td>113</td>
                         <td>126</td>
                         <td>143</td>
                         <td>126</td>
                         <td>147</td>
                         <td>131</td>
                         <td>150</td>
                         <td>112</td>
                         <td>110</td>
                         <td>130</td>
                         <td>109</td>
                         <td>115</td>
                         <td>146</td>
                         <td>129</td>
                         <td>138</td>
                         <td>122</td>
                         <td>114</td>
                         <td>112</td>
                         <td>128</td>
                         <td>111</td>
                         <td>122</td>
                         <td>136</td>
                         <td>109</td>
                         <td>106</td>
                         <td>104</td>
                         <td>146</td>
                         <td>123</td>
                         <td>139</td>
                         <td>117</td>
                         <td>116</td>
                         <td>143</td>
                    </tr>
               </tbody>
          </table>
          <p>
               <a class="btn" href="charts.html">Check out the Charts section</a>
          </p>
     </div>
</div>

<div class="widget" id="widget_accordion">
     <h3 class="handle">Accordion</h3>

     <div class="accordion">
          <h4><a href="#">Section 1</a></h4>

          <div>
               <p>
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus
                    nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec
                    suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit
                    eu ante scelerisque vulputate.
               </p>
          </div>
          <h4><a href="#">Section 2</a></h4>

          <div>
               <p>
                    Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus
                    hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum
                    tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.
               </p>
          </div>
          <h4><a href="#">Section 3</a></h4>

          <div>
               <p>
                    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus
                    pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque
                    semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu
                    iaculis leo purus venenatis dui.
               </p>
               <ul>
                    <li>List item one</li>
                    <li>List item two</li>
                    <li>List item three</li>
               </ul>
          </div>
          <h4><a href="#">Section 4</a></h4>

          <div>
               <p>
                    Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                    turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                    cubilia Curae; Aenean lacinia mauris vel est.
               </p>

               <p>
                    Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent
                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
               </p>
          </div>
     </div>
</div>

<div class="widget" id="widget_breadcrumb">
     <h3 class="handle">Breadcrumb</h3>

     <div>
          <ul class="breadcrumb" data-numbers="true">
               <li><a href="#">Ready</a></li>
               <li><a href="#">Set</a></li>
               <li><a href="#">GO!</a></li>
          </ul>
          <p>
               <a class="btn" href="breadcrumb.html">Check out the Breadcrumb section</a>
          </p>
     </div>
</div>

<div class="widget" id="widget_ajax" data-load="widget-content.php" data-reload="10"
     data-remove-content="false">
     <h3 class="handle">AJAX Widget with autoreload</h3>

     <div>
          This content get replaced
     </div>
</div>

<div class="widget" id="widget_info">
     <h3 class="handle">Do What you like!</h3>

     <div>
          <h3>Widgets can contain everything</h3>

          <p>
               Widgets are flexible, dragg-, sort-, and collapseable content boxes. Fill them with some html!
          </p>

          <p>
               <a class="btn" href="widgets.html">Check out the Widget section</a>
          </p>
     </div>
</div>

</div>

</section>
<footer>Copyright by revaxarts.com 2011</footer>
</body>
</html>