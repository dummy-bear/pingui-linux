<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>pingui service</TITLE>
<body>
<CENTER>
<IMG SRC="img/logo2.jpg"><BR>
<FONT COLOR=96ceff SIZE=5><B><I>
Pingui service.
</I></B></FONT>
</CENTER>
<HR size=1 color=96ceff>
<?
$conn=mysql_connect ("localhost","root","") or die ("Невозможно установить соединение: ".mysql_error());
$database="pingui";
mysql_select_db($database);

$sqlrk="SELECT * FROM rkp ORDER BY ID;";
$q1=mysql_query ($sqlrk) or die ("Ошибка выбора ркп");

echo "<TABLE BORDER=2>";
for ($rk=0;$rk<mysql_num_rows($q1);$rk++)
{
        echo "<TR><TH COLSPAN=3> РКП №".mysql_result ($q1,$rk,0).". ".mysql_result ($q1,$rk,3)." </TH></TR>";
        $sqlh="SELECT * FROM host WHERE rkpID=".mysql_result($q1,$rk,0)." ORDER BY ip;";
        $q2=mysql_query($sqlh) or die ("Ошибка выбора хоста");
        for ($i=0;$i<mysql_num_rows($q2);$i++)

                echo "<TR BGCOLOR=\"".mysql_result($q2,$i,'color')."\"><TD>".mysql_result($q1,$rk,'prefix').mysql_result($q2,$i,'ip')."  </TD><TD>".mysql_result($q2,$i,'opis')."  </TD> <TD><A HREF='pilog.php?id=".mysql_result($q2,$i,'ID')."'>Лог</A></TR>";
}
echo "</TABLE>";

?>
</body></html>
