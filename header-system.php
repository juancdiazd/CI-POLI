<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2012 by BOCA Development Team (bocasystem@gmail.com)
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////
// Last modified 13/mar/2023 by judiazdi1@poligran.edu.co
ob_start();
header ("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Type: text/html; charset=utf-8");
session_start();
ob_end_flush();
require_once('../version.php');

require_once("../globals.php");
require_once("../db.php");

echo "<html><head><title>System's Page</title>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<link rel=stylesheet href=\"../Css.php\" type=\"text/css\">\n";

//echo "<meta http-equiv=\"refresh\" content=\"60\" />";
if(!ValidSession()) {
	InvalidSession("system/index.php");
        ForceLoad("../index.php");
}
if($_SESSION["usertable"]["usertype"] != "system") {
	IntrusionNotify("system/index.php");
        ForceLoad("../index.php");
}
echo "</head><body><table border=1 width=\"100%\">\n";
echo "<tr><td nowrap bgcolor=\"#009cd4\" align=center>";
echo "<img src=\"../images/smallballoontransp.png\" alt=\"\">";
echo "<font color=\"#000000\">BOCA</font>";
echo "</td><td bgcolor=\"#009cd4\" width=\"99%\">\n";
echo "Username: " . $_SESSION["usertable"]["userfullname"] ."<br>\n";
list($clockstr,$clocktype)=siteclock();
echo "</td><td bgcolor=\"#009cd4\" align=center nowrap>&nbsp;".$clockstr."&nbsp;</td></tr>\n";
echo "</table>\n";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System's Page</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="../Css.php" type="text/css" />
  </head>
  <body>
    <header>
         <nav>
          <a href="contest.php">Contest</a>
          <a href="importxml.php">Import</a>
          <a href="option.php">Options</a>
          <a href="../index.php">Logout</a>
        </nav>
    </header>
  </body>
</html>