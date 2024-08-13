<!-- Cannel Setting -->
<?php
// Layout::$Header = false; // Remove header on all pages
// Layout::$Footer = false; // Remove footer on all pages
// Page::RemoveHeader("pagename"); // Remove Header in Specific page
// Page::RemoveFooter("pagename"); // Remove Footer in Specific page
// DB::LoadDB(true); // Load mysql database
// Router::$Extention = ".html"; // Switch to html mode
// Page::LoadBootstrap(false); // Remove Bootstrap

Page::$AutoRouter = false; // Disable Auto Router
Router::$Root = "/php-router"; // Project name (remove if deploy to server eg."/")