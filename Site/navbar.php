<?php
echo("<nav class=\"navbar navbar-default navbar-fixed-top\">
      <div class=\"container\">
      <div id='navbar-header' class=\"navbar-header\">
        <a id='logo' class='brand navbar-brand' href='home.php'>Link-Book</a>
      </div>
        <div id='navbar' class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav\">
            <li id='homeTab'><a href=\"home.php\">Home</a></li>
            <li id='profileTab'><a href=\"profile.php?uid=$_SESSION[uid]\">Profile</a></li>
            <li id='connectionsTab'><a href=\"connections.php\">Connections</a></li>
            <li id='searchTab'><a href=\"search.php\">Search</a></li>
            <li id='listingsTab'><a href=\"listings.php\">Listings</a></li>
            <li id='messagesTab'><a></a></li>
          </ul>
          <ul class=\"nav navbar-nav navbar-right\">
            <li id='logoutTab'><a href='logout.php'>Log-Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>");?>
