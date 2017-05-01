<!-- start news_show_full.tpl -->
<tr>
  <td>
    <table class="news" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="news">
          <img src="{$kat}" alt="" class="newsImage" />
          <div>
            <h1>{$sticky} {$intern} {$titel}</h1>
            {$text}
          </div>
        </td>
      </tr>
      <tr>
        <td class="newsContent">{$more}</td>
      </tr>
      <tr>
        <td class="newsContent"><br />{$links}</td>
      </tr>
      <tr>
        <td class="contentBottom">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" style="padding-left:5px">{$autor} - {$datum}{lang msgID="uhr"}</td>
              <td align="right" style="padding-right:5px">{$comments}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
<table class="mainContent" cellspacing="1">
{notification index="news_tr"}
{$showmore}
<!-- end news_show_full.tpl -->