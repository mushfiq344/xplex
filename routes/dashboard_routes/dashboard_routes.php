<?php

// routes to pages
require_once "other_routes/pages_routes.php";
// routes to insert
require_once "other_routes/upload_routes.php";
// search movie,tv show,pc game using Api
require_once "other_routes/search_routes.php";
// Editing Dashboard
// Edit movie list
require_once "edit_routes/edit_movie_routes.php";
// Edit Tv Show list
require_once "edit_routes/edit_tv_show_routes.php";
// Edit pc game list
require_once "edit_routes/edit_games_routes.php";
// Edit admin list
require_once "edit_routes/edit_admin_routes.php";
// Show data list
require_once "other_routes/list_routes.php";
// Tv channel links
require_once "other_routes/tv_and_ad_routes.php";
//  Error Control

// Error Control End

require_once "other_routes/error_control_routes.php";
// Scan conctroller//
require_once "other_routes/scan_routes.php";
// routes to authenticate
require_once "other_routes/authentication_routes.php";