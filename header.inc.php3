<?php
/* $Id$ */


/**
 * Gets a core script and starts output buffering work 
 */
require('./lib.inc.php3');
require('./ob_lib.inc.php3');
if ($cfgOBGzip) {
    $ob_mode = out_buffer_mode_get();
    if ($ob_mode) {
        out_buffer_pre($ob_mode);
    }
}


/**
 * Sends http headers
 */
// Don't use cache (required for Opera)
$now = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $now);
header('Last-Modified: ' . $now);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
// Define the charset to be used
header('Content-Type: text/html; charset=' . $charset);


/**
 * Sends the beginning of the html page then returns to the calling script
 */
// Gets the font sizes to use
set_font_sizes();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>phpMyAdmin</title>
<style type="text/css">
<!--
body          {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>}
pre, tt       {font-size: <?php echo $font_size; ?>}
th            {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>; font-weight: bold; background-color: <?php echo $cfgThBgcolor;?>}
td            {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>}
form          {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>}
h1            {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_bigger; ?>; font-weight: bold}
A:link        {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>; text-decoration: none; color: #0000ff}
A:visited     {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>; text-decoration: none; color: #0000ff}
A:hover       {font-family: <?php echo $right_font_family; ?>; font-size: <?php echo $font_size; ?>; text-decoration: underline; color: #FF0000}
A:link.nav    {font-family: <?php echo $right_font_family; ?>; color: #000000}
A:visited.nav {font-family: <?php echo $right_font_family; ?>; color: #000000}
A:hover.nav   {font-family: <?php echo $right_font_family; ?>; color: #FF0000}
.nav          {font-family: <?php echo $right_font_family; ?>; color: #000000}
//-->
</style>

<?php
if (isset($db)) {
    $title = str_replace('\'', '\\\'', $db);
}
if (isset($table)) {
    $title = (isset($title) ? $title . '.' . str_replace('\'', '\\\'', $table) : str_replace('\'', '\\\'', $table));
}
if (!empty($cfgServer) && isset($cfgServer['host'])) {
    $title = (isset($title) ? $title . ' ' . trim($strRunning) . ' ' . str_replace('\'', '\\\'', $cfgServer['host']) : str_replace('\'', '\\\'', $cfgServer['host']));
}
$title = (isset($title) ? $title . ' - phpMyAdmin ' . PHPMYADMIN_VERSION : 'phpMyAdmin ' . PHPMYADMIN_VERSION);
?>
<script type="text/javascript" language="javascript">
<!--
// Updates the title of the frameset if possible (ns4 does not allow this)
if (typeof(parent.document.title) == 'string') {
    parent.document.title = '<?php echo $title; ?>';
}
<?php
// Add some javascript instructions if required
if (isset($js_to_run) && $js_to_run == 'functions.js') {
    echo "\n";
    ?>
// js form validation stuff
var errorMsg0   = '<?php echo str_replace('\'', '\\\'', $strFormEmpty); ?>';
var errorMsg1   = '<?php echo str_replace('\'', '\\\'', $strNotNumber); ?>';
var errorMsg2   = '<?php echo str_replace('\'', '\\\'', $strNotValidNumber); ?>';
var noDropDbMsg = '<?php echo((!$cfgAllowUserDropDatabase) ? str_replace('\'', '\\\'', $strNoDropDatabases) : ''); ?>';
var confirmMsg  = '<?php echo(($cfgConfirm) ? str_replace('\'', '\\\'', $strDoYouReally) : ''); ?>';
//-->
</script>
<script src="functions.js" type="text/javascript" language="javascript"></script>
    <?php
} else {
    echo "\n";
    ?>
//-->
</script>
    <?php
}
echo "\n";
?>
</head>


<body bgcolor="#F5F5F5" text="#000000" background="images/bkg.gif">
<?php
if (isset($db)) {
    echo '<h1> ' . $strDatabase . ' ' . htmlspecialchars($db);
    if (!empty($table)) {
        echo ' - ' . $strTable . ' ' . htmlspecialchars($table);
    }
    echo '</h1>' . "\n";
}
echo "\n";
?>
