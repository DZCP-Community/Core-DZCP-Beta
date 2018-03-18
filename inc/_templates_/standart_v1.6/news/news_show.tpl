<!-- start news_show.tpl -->
<tr>
	<td class="contentHead" colspan="5" align="center"><span class="fontBold">{$sticky} {if $intern}{lang msgID="votes_intern"}{/if} {$titel}</span></td>
</tr>
<tr>
	<td class="contentMainFirst">
		<table class="news" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="contentMainSecond news">
					<img src="{$kat}" alt="" class="newsImage" />
					<h1>{$sticky} {$intern} {$titel}</h1>
					{$text}
				</td>
			</tr>
			<tr>
				<td class="contentBottom">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" style="padding-left:5px">{$autor} - {$datum}{lang msgID="uhr"}</td>
						  <td align="right" style="padding-right:5px">
							  <a href="?action=show&amp;id={$id}">{if $comments >= 2}{$comments} {lang msgID="news_kommentare"}{else}{$comments} {lang msgID="news_kommentar"}{/if}</a>
						  </td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<!-- end news_show.tpl -->