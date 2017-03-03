<?
include("config.php");
?>

BODY	{
			font-family: <? echo $font; ?>; 
			color: <? echo $fontcolor; ?>; 
			font-size: <? echo $fontsize; ?>; 
			SCROLLBAR-BASE-COLOR: <? echo $scrollbars; ?>; 
			SCROLLBAR-ARROW-COLOR: <? echo $scrollarrows; ?>;
			}

TD		{
			font-family: <? echo $font; ?>; 
			color: <? echo $fontcolor; ?>; 
			font-size: <? echo $fontsize; ?>;
			}

A:link	{
			text-decoration: none; 
			color: <? echo $linkfont; ?>;
			}

A:visited	{
				text-decoration: none; 
				color: <? echo $vlinkfont; ?>;
				}

A:hover	 {
			  font-style: normal; 
			  color: <? echo $hlinkfont; ?>; 
			  text-decoration: none;
			  }

.cjfont	{
			font-family: <? echo $formfont; ?>; 
			color: <? echo $formfontcolor; ?>; 
			font-size: <? echo $formfontsize; ?>;			
			}

A:link.cjfont		{
						text-decoration: none; 
						color: <? echo $formlinkfont; ?>;
						}

A:visited.cjfont	{
						text-decoration: none; 
						color: <? echo $formvlinkfont; ?>;
						}

A:hover.cjfont	{
						text-decoration: bold;
						color: <? echo $formhlinkfont; ?>;
						}

.cjmsg  {
			background: <? echo $formbgcolor; ?>;
			color: <? echo $formfgcolor; ?>; 
			font-family: <? echo $formfont?>;
			font-size: <? echo $formfontsize?>; 
			SCROLLBAR-BASE-COLOR: <? echo $formscrollbars; ?>;
			SCROLLBAR-ARROW-COLOR: <? echo $formscrollarrows; ?>;
			}

.xtra {
		background: <? echo $xtrabgcolor; ?>;
		color: <? echo $xtrafgcolor; ?>; 
		font-family:<? echo $font?>;
		font-size:<? echo $fontsize?>; 
		}