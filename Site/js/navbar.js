$(document).ready(function(){
    var path = window.location.pathname;
    var page = path.split("/").pop();
    switch(page){
        case "home.php":
            $("#homeTab").addClass("active");
            break;
        case "profile.php":
            $("#profileTab").addClass("active");
            break;
        case "connections.php":
            $("#connectionsTab").addClass("active");
            break;
        case "search.php":
            $("#searchTab").addClass("active");
            break;
        case "listings.php":
            $("#listingsTab").addClass("active");
            break;
        default:
            //$(document).write(window.location.pathname);
            break;
    }
});