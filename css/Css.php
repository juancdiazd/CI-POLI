/*GENERAL*/
/*body*/
body {
  margin: 0;
  padding: 0;
  background: url(images/bk-sb.jpg) no-repeat center top;
  background-size: cover;
  font-family: sans-serif;
  background-attachment: fixed;
}

/*INDEX*/
/*login*/
.login-box {
  width: 320px;
  height: 380px;
  background: #000;
  color: #fff;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
  box-sizing: border-box;
  padding: 70px 30px;
  border-radius: 20px;
}
.login-box .logo {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  position: absolute;
  top: -50px;
  left: calc(50% - 50px);
}
.login-box h1 {
  margin: 0;
  padding: 0 0 20px;
  text-align: center;
  font-size: 22px;
}
.login-box label {
  margin: 0;
  padding: 0;
  font-weight: bold;
  display: block;
}
.login-box input {
  width: 100%;
  margin-bottom: 20px;
}
.login-box input[type="text"],
.login-box input[type="password"] {
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 40px;
  color: #fff;
  font-size: 16px;
}
.login-box input[type="submit"] {
  border: none;
  outline: none;
  height: 40px;
  background: #b80f22;
  color: #fff;
  font-size: 18px;
  border-radius: 20px;
}

/*footer*/
footer {
  width: 100%;
  background: #b80f22;
  opacity: 0.7;
  text-align: center;
  color: #fff;
  font-size: 8px;
  position: absolute;
  bottom: 0;
}

/*INTERNAL PAGES*/
/*header*/
header {
  width: 100%;
  background: rgba(184, 15, 34, 0.7);  
}
header nav {
  text-align: center;
  line-height: 20px;
}
header a {
  display: inline-block;
  color: #fff;
  font-family: sans-serif;
  text-decoration: none;
  padding: 20px;
  line-height: normal;
  font-size: 15px;
  -webkit-transition: all 500ms ease;
  -o-transition: all 500ms ease;
  transition: all 500ms ease;
}
header nav a:hover {
  background: #790c17;
  border-radius: 30px;
}

/*CONTEST*/
.contest-form {
  background-color: rgba(0, 0, 0, 0.7);  
  margin: 20px auto; 
  width: 350px;
  color: #d1d1d1;
  border-radius: 10px;
  font-size: 14px;
  padding: 20px 30px;
}
form h3{
  text-align: center;
}
select{
  left: 50%;
  position: relative;
  transform: translate(-50%, -50%);;
}
.contest-form input{
  outline: none;
  margin-bottom: 10px;
  background: rgba(55, 54, 54, 0.7);
}
.contest-form label{
  text-align: left;
  margin: 0px;
  padding: 5px;
  display: block;
}
form p{
   text-align: center; 
   margin: 2px;
}
.field{
    color: #fff;
    border: solid 1px #000;
    width: 345px;
}
.field:focus{
    border-color: #b80f22;
}
.contest-buttons input[type="submit"],
.contest-buttons input[type="reset"] {
  margin: 17px;
  border: none;
  outline: none;
  width: 80px;
  height: 30px;
  background: rgba(184, 15, 34, 0.7);  
  color: #fff;
  border-radius: 5px;
}
.sys-options input[type="submit"]{
  margin: 20px 130px ;
}
.sys-import input[type="submit"]{
  margin-left: 75px;
}
.browse input[type="submit"]{
  width: 100px;
  color: #fff;
  margin: 10px 125px;
  border: none;
  outline: none;
}
<?php
$corfundo = "#e0e0d0";
$corfrente = "#000000";
$corfundo2 = "#dfdfdf";
$cormenu = "#dfdfdf";
?>
<?php if( strstr(getenv("HTTP_USER_AGENT"), "MSIE")) { ?>
input.checkbox { border:none }
<?php } else { ?>
input.checkbox { }
<?php } ?>
div#popupnew {
position:absolute;
left:50%;
top:17%;
margin-left:-202px;
font-family:'Raleway',sans-serif
}
div#normal {
width:100%;
height:100%;
opacity:.95;
top:0;
left:0;
display:none;
position:fixed;
background-color:#313131;
overflow:auto
}
DIV.menu {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>}
DIV.menudown {background-color:<?php echo $cormenu?>; border-bottom:1px solid white; border-right:1px solid white;border-top:2px solid #555555;border-left:1px solid #555555}
DIV.fname {background-color:<?php echo $corfundo2?>; layer-background-color:<?php echo $corfundo2?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px; z-index:100;}
DIV.dir {background-color:<?php echo $corfundo?>; layer-background-color:<?php echo $corfundo?>; position:absolute; visibility:hidden; border:0; left:0px; top:0px; height:19px;z-index:100; }
A {font-family:"Courier New", Courier, mono; font-size:12pt; color:<?php echo $corfrente?>} 
A.header {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt} 
A.menu {font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none; font-size:12pt; border: 1px solid <?php echo $corfundo?>} 
A.menu:hover {background-color:<?php echo $cormenu?>; border-bottom:1px solid #555555; border-right:1px solid #555555;border-top:1px solid white;border-left:1px solid white} 
A.user {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt} 
A.user:hover {font-weight: bolder} 
A.disabled {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; text-decoration:none; color:#BFBFBF} 
A.form {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12pt; background-color:<?php echo $cormenu?>} 
TEXTAREA { border:1px solid #555555 }
TEXTAREA.edit { font-family:"Courier New", Courier, mono;font-size:10pt; background-color:#EFEFEF } 
SELECT { font-size:12pt;}
p.link a:hover {background-color: #2B2E21;;color:#fff;}
p.link a:link span{display: none;}
p.link a:visited span{display: none;}
p.link a:hover span {
  position: absolute;
  margin:15px 0px 0px 20px;
  background-color: beige;
  max-width:220;
  padding: 2px 10px 2px 10px;
  border: 1px solid #C0C0C0;
  font: normal 10px/12px verdana;
  color: #000;
  text-align:left;
  display: block;
}

