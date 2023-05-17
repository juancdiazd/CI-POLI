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
// Last modified 05/aug/2012 by cassio@ime.usp.br

//optionlower.php: parte de baixo da tela de option.php, que eh igual para
//			todos os usuarios
require_once("globals.php");

if(!ValidSession()) { // || $_SESSION["usertable"]["usertype"] == 'team') {
        InvalidSession("optionlower.php");
        ForceLoad("index.php");
}
$loc = $_SESSION['loc'];

if (isset($_GET["username"]) && isset($_GET["userfullname"]) && isset($_GET["userdesc"]) && 
    isset($_GET["passwordo"]) && isset($_GET["passwordn"])) {
  if($_SESSION["usertable"]["usertype"] == 'team') {
    MSGError('Updates are not allowed');
    ForceLoad("option.php");
  }    

	$username = myhtmlspecialchars($_GET["username"]);
	$userfullname = myhtmlspecialchars($_GET["userfullname"]);
	$userdesc = myhtmlspecialchars($_GET["userdesc"]);
	$passwordo = $_GET["passwordo"];
	$passwordn = $_GET["passwordn"];
	DBUserUpdate($_SESSION["usertable"]["contestnumber"],
		     $_SESSION["usertable"]["usersitenumber"],
		     $_SESSION["usertable"]["usernumber"],
		     $_SESSION["usertable"]["username"], // $username, but users should not change their names
		     $userfullname,
		     $userdesc,
		     $passwordo,
		     $passwordn);
	ForceLoad("option.php");
}

$a = DBUserInfo($_SESSION["usertable"]["contestnumber"],
                $_SESSION["usertable"]["usersitenumber"],
                $_SESSION["usertable"]["usernumber"]);

?>

<script language="JavaScript" src="<?php echo $loc; ?>/sha256.js"></script>
<script language="JavaScript" src="<?php echo $loc; ?>/hex.js"></script>
<script language="JavaScript">
function computeHASH()
{
	var username, userdesc, userfull, passHASHo, passHASHn;
	if (document.form1.passwordn1.value != document.form1.passwordn2.value) return;
	if (document.form1.passwordn1.value == document.form1.passwordo.value) return;
	username = document.form1.username.value;
	userdesc = document.form1.userdesc.value;
	userfull = document.form1.userfull.value;

	passHASHo = js_myhash(js_myhash(document.form1.passwordo.value)+'<?php echo session_id(); ?>');
	passHASHn = bighexsoma(js_myhash(document.form1.passwordn2.value),js_myhash(document.form1.passwordo.value));
	document.form1.passwordo.value = '                                                         ';
	document.form1.passwordn1.value = '                                                         ';
	document.form1.passwordn2.value = '                                                         ';
	document.location='option.php?username='+username+'&userdesc='+userdesc+'&userfullname='+userfull+'&passwordo='+passHASHo+'&passwordn='+passHASHn;
}
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System's Page</title>
    <link rel="stylesheet" href="Css.php" type="text/css" />
  </head>
  <body>
    <form name="form1" action="javascript:computeHASH()">
        <label for="Name">Userame:</label>
        <input type="text" class="field" readonly name="username" value="<?php echo $a["username"]; ?>"/>
        <label for="userfull">User Full Name:</label>
        <input type="text" class="field" readonly name="userfull" value="<?php echo $a["userfullname"]; ?>"/>
        <label for="userdesc">User Description:</label>
        <input type="text" class="field" name="userdesc" value="<?php echo $a["userdesc"]; ?>"/>
        <label for="paswordo">Old Password:</label>
        <input type="password" class="field" name="passwordo"/>
        <label for="passwordn1">New Password:</label>
        <input type="password" class="field" name="passwordn1"/>
        <label for="passwordn2">Retype New Password:</label>
        <input type="password" class="field" name="passwordn2"/>
        <div class="contest-buttons">
            <div class="sys-options">
              <input type="submit" name="Submit" value="Send">
            </div>
      </form>
  </body>
</html>
