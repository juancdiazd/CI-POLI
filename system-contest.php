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
//Change list: 
// 02/jul/2006 by cassio@ime.usp.br
// 25/aug/2007 by cassio@ime.usp.br: php initial tag changed to complete form

require 'header.php';

if (isset($_GET["new"]) && $_GET["new"]=="1") {
	$n = DBNewContest();
	ForceLoad("contest.php?contest=$n");
}

if (isset($_GET["contest"]) && is_numeric($_GET["contest"]))
  $contest=$_GET["contest"];
else
  $contest=$_SESSION["usertable"]["contestnumber"];

if(($ct = DBContestInfo($contest)) == null)
	ForceLoad("../index.php");
if ($ct["contestlocalsite"]==$ct["contestmainsite"]) $main=true; else $main=false;

if (isset($_POST["Submit3"]) && isset($_POST["penalty"]) && is_numeric($_POST["penalty"]) && 
    isset($_POST["maxfilesize"]) && isset($_POST["mainsite"]) && isset($_POST['localsite']) &&
    isset($_POST["name"]) && $_POST["name"] != "" && isset($_POST["lastmileanswer"]) && 
    is_numeric($_POST["lastmileanswer"]) && is_numeric($_POST["mainsite"]) && is_numeric($_POST['localsite']) &&
    isset($_POST["lastmilescore"]) && is_numeric($_POST["lastmilescore"]) && isset($_POST["duration"]) && 
    is_numeric($_POST["duration"]) &&
    isset($_POST["startdateh"]) && $_POST["startdateh"] >= 0 && $_POST["startdateh"] <= 23 && 
    isset($_POST["contest"]) && is_numeric($_POST["contest"]) &&
    isset($_POST["startdatemin"]) && $_POST["startdatemin"] >= 0 && $_POST["startdatemin"] <= 59 &&
    isset($_POST["startdated"]) && isset($_POST["startdatem"]) && isset($_POST["startdatey"]) && 
    checkdate($_POST["startdatem"], $_POST["startdated"], $_POST["startdatey"])) {
	if ($_POST["confirmation"] == "confirm") {
		$t = mktime ($_POST["startdateh"], $_POST["startdatemin"], 0, $_POST["startdatem"], 
                             $_POST["startdated"], $_POST["startdatey"]);
		if ($_POST["Submit3"] == "Activate") $ac=1;
		else $ac=0;
		$param['number']=$_POST["contest"];
		$param['name']=$_POST["name"];
		$param['startdate']=$t;
		$param['duration']=$_POST["duration"]*60;
		$param['lastmileanswer']=$_POST["lastmileanswer"]*60;
		$param['lastmilescore']= $_POST["lastmilescore"]*60;
		$param['penalty']=$_POST["penalty"]*60;
		$param['maxfilesize']=$_POST["maxfilesize"]*1000;
		$param['active']=$ac;
		$param['mainsite']=$_POST["mainsite"];
		$param['localsite']=$_POST["localsite"];
		$param['mainsiteurl']=$_POST["mainsiteurl"];

		DBUpdateContest ($param);
		if ($ac == 1 && $_POST["contest"] != $_SESSION["usertable"]["contestnumber"]) {
			$cf = globalconf();
			if($cf["basepass"] == "")
				MSGError("You must log in the new contest. The standard admin password is empty (if not changed yet).");
			else
				MSGError("You must log in the new contest. The standard admin password is " . $cf["basepass"] . " (if not changed yet).");

			ForceLoad("../index.php");
		}
	}
	ForceLoad("contest.php?contest=".$_POST["contest"]);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System's Page</title>
    <link rel="stylesheet" href="../Css.php" type="text/css" />
  </head>
  <body>
    <div class="contest-form">  
      <form name="form1" enctype="multipart/form-data" method="post" action="contest.php">
        <input type=hidden name="confirmation" value="noconfirm" />
        <script language="javascript">
          function conf() {
            if (confirm("Confirm?")) {
              document.form1.confirmation.value='confirm';
            }
          }
          function newcontest() {
            document.location='contest.php?new=1';
          }
          function contestch(n) {
            if(n==null) {
              k=document.form1.contest[document.form1.contest.selectedIndex].value;
              if(k=='new') newcontest();
              else document.location='contest.php?contest='+k;
            } else {
              document.location='contest.php?contest='+n;
            }
          }
        </script>
        <h3>Contest number:</h3>
        <div class="select-box">
          <select onChange="contestch()" name="contest">
            <?php 
            $cs = DBAllContestInfo();
            $isfake=false;
            for ($i=0; $i<count($cs); $i++) {
              echo "<option value=\"" . $cs[$i]["contestnumber"] . "\" ";
              if ($contest == $cs[$i]["contestnumber"]) {
                echo "selected";
              if($cs[$i]["contestnumber"] == 0) $isfake=true;
              }
              echo ">" . $cs[$i]["contestnumber"] . ($cs[$i]["contestactive"]=="t"?"*":"") ."</option>\n";
            }
            ?>
            <option value="new">new</option>
          </select>
        </div>

        <?php if(!$isfake) { ?>
      
        <label for="Name">Name:</label>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="name" value="<?php echo $ct["contestname"]; ?>"/>
        <label for="Start date">Start date:</label>
        <p>HH:MM</p>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="startdateh" value="<?php echo date("H", $ct["conteststartdate"]); ?>"/>
        <p>:</p>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="startdatemin" value="<?php echo date("i", $ct["conteststartdate"]); ?>"/> &nbsp; &nbsp; 
        <p>DD/MM/YYYY</p>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="startdated" value="<?php echo date("d", $ct["conteststartdate"]); ?>"/>
        <p>/</p>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="startdatem" value="<?php echo date("m", $ct["conteststartdate"]); ?>"/>
        <p>/</p>
        <input type="text" class="field" <?php if(!$main) echo "readonly"; ?> name="startdatey" value="<?php echo date("Y", $ct["conteststartdate"]); ?>">
        <label for="Duration">Duration (in minutes):</label>
        <input type="text" class="field" name="duration" <?php if(!$main) echo "readonly"; ?> value="<?php echo $ct["contestduration"]/60; ?>"/>
        <label for="Stop answering">Stop answering (in minutes):</label>
        <input type="text" class="field" name="lastmileanswer" <?php if(!$main) echo "readonly"; ?> value="<?php echo $ct["contestlastmileanswer"]/60; ?>"/>
        <label for="Stop scoreboard">Stop scoreboard (in minutes):</label>
        <input type="text" class="field" name="lastmilescore" <?php if(!$main) echo "readonly"; ?> value="<?php echo $ct["contestlastmilescore"]/60; ?>"/>
        <label for="Penalty">Penalty (in minutes):</label>
        <input type="text" class="field" name="penalty" <?php if(!$main) echo "readonly"; ?> value="<?php echo $ct["contestpenalty"]/60; ?>"/>
        <label for="Max file size allowed for teams">Max file size allowed for teams (in KB):</label>
        <input type="text" class="field" name="maxfilesize" <?php if(!$main) echo "readonly"; ?> value="<?php echo $ct["contestmaxfilesize"]/1000; ?>" />
        <h4>Your PHP config. allows at most:</h4> 
          <?php echo ini_get('post_max_size').'B(max. post) and '.ini_get('upload_max_filesize').'B(max. filesize)'; ?>
        <label for="Contest main site URL (IP/bocafolder)">Contest main site URL (IP/bocafolder):</label>
        <input type="text" class="field" name="mainsiteurl" value="<?php echo $ct["contestmainsiteurl"]; ?>" />
        <label for="Contest main site number">Contest main site number:</label>
        <input type="text" class="field" name="mainsite" value="<?php echo $ct["contestmainsite"]; ?>"/>
        <label for="Contest local site number">Contest local site number:</label>
        <input type="text" class="field" name="localsite" value="<?php echo $ct["contestlocalsite"]; ?>"/>
    
        <div class="contest-buttons">
          <input type="submit" name="Submit3" value="Send" onClick="conf()">
          <input type="submit" name="Submit3" value="Activate" onClick="conf()">
          <input type="reset" name="Submit4" value="Clear">
        </div>
        <?php } else { echo "<br><br><center>Select a contest or create a new one.</center><br><br>"; } ?>
      </form>
    </div>
  </body>
</html>
