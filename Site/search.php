<head>
    <title>Link-Book: Search</title>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
include("searchController.php");
?>
<div class="container">
    <div class="row" style="padding-bottom: 1em">
        <div class="col-lg-4">
            <div class="input-group">
                <input type="text" id="field" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" id="btn" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>

    <?php populateUsers("Alex", 5, true); ?>
</div>
</body>