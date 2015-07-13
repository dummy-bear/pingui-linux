<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>pingui service</TITLE>
<body>
<CENTER>
<IMG SRC="img/logo2.jpg"><BR>
<FONT COLOR=96ceff SIZE=5><B><I>
Pingui service
</I></B></FONT>
</CENTER>
<HR size=1 color=96ceff>
<?
$conn=mysql_connect ("localhost","root","") or die ("Невозможно установить соединение: ".mysql_error());
$database="pingui";
mysql_select_db($database);


        echo "<TD> <TABLE BORDER=2>";


        mysql_select_db("pingui");
        $sqlrk="SELECT rkp.ID, rkp.adres, rkp.prefix, host.ip, host.opis FROM rkp,host WHERE rkp.ID=host.rkpID AND host.ID=".$_REQUEST["id"].";";

        $q1=mysql_query ($sqlrk) or die ("Ошибка выбора ркп");
        echo "<H2> Статистика связи с ip ".mysql_result($q1,0,'prefix').mysql_result($q1,0,'ip')." РКП №".mysql_result($q1,0,ID)." ".mysql_result($q1,0,'adres').", ".mysql_result($q1,0,'opis').".</H2>\n";

if ($_REQUEST["day1"])$day1=$_REQUEST["day1"];
else $day1=date("Y-m-d H:i:s",strtotime("today"));
if ($_REQUEST["day2"]) $day2=$_REQUEST["day2"];
else $day2=date("Y-m-d H:i:s",strtotime("tomorrow"));

echo "<FORM METHOD=GET ACTION=\"pilog.php\" ENCTYPE=\"application/x-www-urlencoded\">";
echo "<INPUT TYPE=HIDDEN NAME=\"id\" VALUE=\"".$_REQUEST["id"]."\">";
echo "Время: с ";

echo "<INPUT TYPE=TEXT NAME=\"day1\" VALUE=\"".$day1."\"> до <INPUT TYPE=TEXT NAME=\"day2\" VALUE=\"".$day2."\">";
echo "<INPUT TYPE=SUBMIT VALUE=\"Применить\"></FORM><P>";


        $sqlp="SELECT kogda,errcod FROM pings WHERE hID=".$_REQUEST["id"]." AND kogda>'".$day1."' AND kogda<'".$day2."' ORDER BY kogda;";
        $q1=mysql_query ($sqlp) or die ("Ошибка выбора ");
        for ($rk=0;$rk<mysql_num_rows($q1);$rk++)
        {
                echo mysql_result($q1,$rk,0)." ";
                echo mysql_result($q1,$rk,1)+1;
                echo "<BR>\n";
        }
/*      {
                echo "<TR><TH COLSPAN=3> РКП №".mysql_result ($q1,$rk,0).". ".mysql_result ($q1,$rk,3)." </TH></TR>";
                $sqlh="SELECT * FROM host WHERE rkpID=".mysql_result($q1,$rk,0)." ORDER BY ip;";
                $q2=mysql_query($sqlh) or die ("Ошибка выбора хоста");
                for ($i=0;$i<mysql_num_rows($q2);$i++)

                        echo "<TR BGCOLOR=\"".mysql_result($q2,$i,'color')."\"><TD>".mysql_result($q1,$rk,'prefix').mysql_result($q2,$i,'ip')."  </TD><TD>".mysql_result($q2,$i,'opis')."  </TD> <TD><A HREF='pilog.php?id=".mysql_result($q2,$i,'ID')."'>Лог</A></TR>";
        }
        echo "</TABLE>";
*/



echo "</TD></TR></TABLE>\n";


?>


</body></html>
