<tr>
  <td class="contentHead" align="center"><a name="top"><span class="fontBold">{lang msgID="forum_head"}</span></a></td>
</tr>
<tr>
  <td class="contentMainTop">{$where}</td>
</tr>
{$admin}
{$f_abo}
</table>
<table class="mainContent" cellspacing="1">
<tr>
  <td class="contentHead" align="center" colspan="2">
    <table class="hperc" cellspacing="0">
      <tr>
        <td class="gray"><span class="fontBold">{$threadhead}</span></td>
        <td class="gray" style="text-align:right">{$nav}</td>
      </tr>
    </table>
  </td>
</tr>
<!-- 1. Post -->
<tr>
  <td colspan="2" class="contentMainTop">
    <table class="hperc" cellspacing="0">
      <tr>
        <td style="vertical-align:middle"><a name="p{$postnr}"></a>{$titel}</td>
        <td style="text-align:right">{$zitat}</td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td class="commentsLeft">
    <table class="hperc">
      <tr>
        <td>{$nick}</td>
        <td align="right">{$onoff}</td>
      </tr>
      <tr>
        <td colspan="2"><span class="fontItalic">{$status}</span></td>
      </tr>
      <tr>
        <td>{$posts}</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center;padding:6px">{$avatar}</td>
      </tr>
    </table>
  </td>
  <td {$class}>
    <table class="hperc">
      <tr>
        <td height="108">{$text}</td>
      </tr>
        {if $is_vote}<tr><td>{$vote}</td></tr>{/if}
      <tr>
        <td><span class="fontItalic">{$edited}&nbsp;</span>{$signatur}</td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td class="contentMainTop" align="center">{$ip}</td>
  <td class="contentMainTop" style="text-align:left;vertical-align:middle">{$pn} {$hp} {$email}</td>
</tr>
{$show}
<tr>
  <td class="contentMainFirst" colspan="2">
    <table class="hperc" cellspacing="0">
      <tr>
        <td class="contentMainTop" style="vertical-align:middle">{$nav}</td>
        <td class="contentMainTop" style="text-align:right">
            {if $closed && !$permission}<img src="{idir}/closed.png" alt="">{elseif !$closed && $permission}<a href="?action=post&amp;do=add&amp;id={$id}">
                <img src="{idir}/forum_admin_reply.gif" alt="" title="{lang msgID="forum_addpost"}" class="icon" /></a>{else}<a href="?action=post&amp;do=add&amp;id={$id}">
          <img src="{idir}/forum_reply.gif" alt="" title="{lang msgID="forum_addpost"}" class="icon" /></a>{/if} {$lpost}</td>
      </tr>
    </table>
  </td>
</tr>