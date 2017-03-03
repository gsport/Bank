
<HTML>
<HEAD>
<TITLE>Smiley-k/szövegformázások berszúrása</TITLE>
<link rel="stylesheet" href="stylesheet.php" type="text/css">
<script language="javascript" type="text/javascript">
<!--
function insertcode(code) {
	code = ' ' + code + ' ';
	opener.document.forms['tagboard'].cjmsg.value  += code;
	if(document.my.ifClose.checked == true){
		opener.document.forms['tagboard'].cjmsg.focus();
        window.close();
     }
}
function insertsmilie(smilie) {
	smilie = ' ' + smilie + ' ';
	opener.document.forms['tagboard'].cjmsg.value  += smilie;
	if(document.my.ifClose.checked == true){
		opener.document.forms['tagboard'].cjmsg.focus();
        window.close();
     }
}
//-->
</script>

</HEAD>

<? 
include("config.php");
?>

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="50%" valign="top">
          <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
              <td width="100%" bgcolor="<? echo $bgcolor1; ?>"><b>Szövegformázás</b></td>
            </tr>
            <tr>
              <td width="100%">
              <a href="javascript:insertcode('[b]'+ prompt('Írd ide a szöveget', '') +'[/b]')">Félkövér betûk</a><br>
    			<a href="javascript:insertcode('[i]'+ prompt('Írd ide a szöveget', '') +'[/i]')">Dõlt betûk</a><br>
    			<a href="javascript:insertcode('[u]'+ prompt('Írd ide a szöveget', '') +'[/u]')">Aláhúzott betûk</a><br>
			   <a href="javascript:insertcode('[color=' + prompt('Add meg a szín nevét vagy kódját','') + ']' + prompt('Írd ide a szöveget','') + '[/color]')">Színes betûk</a></td>
            	</tr>
            <tr>
              <td width="100%" bgcolor="<? echo $bgcolor1; ?>"><b>Linkek</b></td>
            </tr>
            <tr>
              <td width="100%">
               <a href="javascript:insertcode('[url=' + prompt('Add meg a webcím teljes elérési útját', 'http://') + ']' + prompt('Add meg a link szövegét (pl. webhely neve)', '') + '[/url]' )">URL beszúrása</a><br>
				 <a href="javascript:insertcode('[email=' + prompt('Add meg az e-mail címet', 'yourname@email.com') + ']' + prompt('Add meg a link szövegét', '') + '[/email]' )">E-mail cím beszúrása</a>
    			<br>
    			<form name=my>
                    <div align="center">
                      <center>
                      <table border="0" cellspacing="0" width="100%">
                        <tr>
                          <td width="1%">
					<input type=checkbox checked name=ifClose>
                          </td>
                          <td width="99%">
				    <font size="1">Ablak bezárása<br>
                    a beszúrás után</font>
                          </td>
                        </tr>
                        <tr>
                          <td width="1%" valign="top">
						  <br>
                    <font size="1"><b></b></font>
                          </td>
                          <td width="99%">
						  <br>
                    <font size="1">&nbsp;</font>
                          </td>
                        </tr>
                      </table>
                      </center>
                    </div>
                    &nbsp;
				</form>
        		</td>
            </tr>
          </table>
      </td>
      <td width="50%" valign="top">
          <table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr>
              <td width="100%" bgcolor="<? echo $bgcolor1; ?>"><b>Smiley-k</b></td>
            </tr>
            <tr>
              <td width="100%">
 
 <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="1%"><A HREF="javascript:insertcode(':D')"><img border="0" src="e/grin.gif"></A></td>
    <td width="99%"><A HREF="javascript:insertcode(':D')"><b>:D</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':evil')"><img border="0" src="e/evil.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':evil')"><b>:evil</b></a></td>
   </tr> 
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':)')"><img border="0" src="e/smile.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':)')"><b>:)</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':|')"><img border="0" src="e/shocked.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':|')"><b>:|</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':(')"><img border="0" src="e/sad.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':(')"><b>:(</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':cry')"><img border="0" src="e/cry.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':cry')"><b>:cry</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':o')"><img border="0" src="e/suprised.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':o')"><b>:o</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode('B)')"><img border="0" src="e/cool.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode('B)')"><b>B)</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':red')"><img border="0" src="e/redface.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':red')"><b>:red</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':s')"><img border="0" src="e/confused.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':s')"><b>:s</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':p')"><img border="0" src="e/razz.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':p')"><b>:p</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(';)')"><img border="0" src="e/wink.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(';)')"><b>;)</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':x')"><img border="0" src="e/mad.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':x')"><b>:x</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':blink')"><img border="0" src="e/rolleyes.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':blink')"><b>:blink</b></a></td>
  </tr>
  <tr> 
    <td width="1%"><A HREF="javascript:insertcode(':lol')"><img border="0" src="e/lol.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':lol')"><b>:lol</b></a></td>
    <td width="1%"><A HREF="javascript:insertcode(':?')"><img border="0" src="e/question.gif"></a></td>
    <td width="99%"><A HREF="javascript:insertcode(':?')"><b>:?</b></a></td>
  </tr>
</table>
<div align="right"><br><br><font size="1">Kattints a smiley-ra a hozzáadáshoz</font></div>
              </td>
            </tr>
          </table>
      </td>
    </tr>
  </table>
	
