$(document).ready(function(){
    var path = window.location.pathname;
    var page = path.split("/").pop();
    console.log(page);
    switch(page){
        case "home.php":
            $("#homeTab").addClass("active");
            $("#homeTab a").attr("href", "#");
            break;
        case "profile.php":
            $("#profileTab").addClass("active");
            $("#profileTab a").attr("href", "#");
            break;
        case "connections.php":
            $("#connectionsTab").addClass("active");
            $("#connectionsTab a").attr("href", "#");
            break;
        case "search.php":
            $("#searchTab").addClass("active");
            $("#searchTab a").attr("href", "#");
            break;
        case "listings.php":
            $("#listingsTab").addClass("active");
            $("#listingsTab a").attr("href", "#");
            break;
        case "message.php":
            $("#messagesTab").addClass("active");
            $("#messagesTab a").html("Messages");
            $("#messagesTab a").attr("href", "#");
            break;

        case "index.php":
        case "":
            $("#navbar-header").detach();
            $("#logo").detach();
        case "register.php":
        case "login.php":
            $("#homeTab").detach();
            $("#profileTab").detach();
            $("#connectionsTab").detach();
            $("#searchTab").detach();
            $("#listingsTab").detach();
            $("#logoutTab a").attr("href", "login.php");
            $("#logoutTab a").html("Log-In");
            break;
        case "login.php":
            $("#logoutTab a").attr("href", "#");
            break;
        default:
            //$(document).write(window.location.pathname);
            break;
    }
});