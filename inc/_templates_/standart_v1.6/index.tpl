<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
        <head>
            <title>{$title}</title>
            <meta http-equiv="title" content="{$title}" />
            <meta http-equiv="pragma" content="No-Cache" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <link rel="stylesheet" type="text/css" href="../inc/ajax.php?i=less{$regen}" />
            <link rel="alternate" type="application/rss+xml" href="../rss.xml" title="{$clanname} RSS-Feed" />
            <link rel="icon" href="{dir}/favicon.ico" />
            <link rel="home" href="/" title="Home" />
            <script language="javascript" type="text/javascript" src="{dir}/_js/highlight.min.js"></script>
            <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.min.js"></script>
            <script language="javascript" type="text/javascript" src="{dir}/_js/bootstrap.min.js"></script>
	    	<script language="javascript" type="text/javascript" src="{dir}/_js/jquery.tools.min.js"></script>
	    	<script language="javascript" type="text/javascript" src="{dir}/_js/jquery-ui.min.js"></script>
            {$java_vars}
            <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.colorpicker.min.js"></script>
            <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.magnific-popup.min.js"></script>
            <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.highlighter.min.js"></script>
			<script language="javascript" type="text/javascript" src="{dir}/_js/jquery.barrating.min.js"></script>
            <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.dzcp.js"></script>
        </head>
	<body>
		{$check_msg}
		<a style="visibility:hidden;" href="../inc/bot.php"><img src="{idir}/1px.gif" width="1" height="1" border="0" alt="" /></a>
		<a name="toplink"></a>
		<!-- Template Start -->
		<!-- Wrapper bereich Start -->
		<div id="wrapper">
		  <!-- Header Start -->
		  <div id="header">
		    <img src="{dir}/images/clanlogo.png" alt="Clanlogo"/>
		    <div id="rotationsbanner" class="corner">{rotationsbanner}</div>
		  </div>
		  <!-- Header Ende -->
		  <div id="content">
		    <!-- linke Spalte Start -->
		    <div class="sideContent">
		      <!-- Main Navigation Start -->
		      <div class="mainNavigation corner">
		        <h2 class="headline">{lang msgID="txt_navi_main"}</h2>
		        <ul>
                    {navi kat="main"}
		        </ul>
		      </div>
		      <!-- Main Navigation Ende -->
		      <!-- Vote Box Start -->
		      <div class="box corner">
		        <h2 class="headline">{lang msgID="txt_vote"}</h2>
		        {vote}
		      </div>
		      <!-- Vote Box Ende -->
		      <!-- Top Downloads Box Start -->
		      <div class="box corner">
		        <h2 class="headline">{lang msgID="txt_top_dl"}</h2>
		        {top_dl}
		      </div>
		      <!-- Top Downloads Box Ende -->
		      <!-- Switchbox Sponsors/Partners Start -->
		      <div class="box corner">
		        <h2 class="headline tabs">
		          <span class="tabright">{lang msgID="txt_sponsors"}</span>
		          <span class="tableft">{lang msgID="txt_partners"}</span>
		        </h2>
		        <div class="switchs">{sponsors}</div>
		        <div class="switchs">{partners}</div>
		      </div>
		      <!-- Switchbox News/Forum Ende -->
		    </div>
		    <!-- linke Spalte Ende -->
		    <!-- mittlere Spalte Start -->
		    <div id="middleContent">
		      <div class="index corner" style="margin-bottom:5px; padding:7px">
		        <div class="leftFloat">{welcome}</div>
		        <div class="rightFloat">{languages}</div>
		        <div class="clearFix"></div>
		      </div>
		      <div class="index corner">
		        <!-- Wo bin ich & Suche Start -->
		        <div id="brackets">
		          {$where}
		          <div id="search">{search}</div>
		        </div>
		        <!-- Wo bin ich $ Suche Ende -->
		        <!-- Main Content Frame Start -->
		        <div id="index">{$index}</div>
		        <!-- Main Content Frame Ende -->
		      </div>
		    </div>
		    <!-- mittlere Spalte Ende -->
		    <!-- rechte Spalte Start -->
		    <div class="sideContent">
		      <!-- Userbereich Start -->
			{if $lock}
		      <div class="box corner">
		        <h2 class="headline">{lang msgID="txt_userarea"}</h2>
		        {login}
		        <div class="leftFloat">{avatar}</div>
		        <div class="leftFloat">{navi kat="user"}{navi kat="trial"}{navi kat="member"}{navi kat="admin"}</div>
		        <br style="clear:both" />
		      </div>
			{/if}
		      <!-- Userbereich Ende -->
		      <!-- Switchbox News/Artikel Start -->
		      <div class="box corner">
		        <h2 class="headline tabs">
		          <span class="tabright">{lang msgID="txt_l_news"}</span>
		          <span class="tableft">{lang msgID="txt_l_artikel"}</span>
		        </h2>
		        <div class="switchs">{l_news}</div>
		        <div class="switchs">{l_artikel}</div>
		      </div>
		      <!-- Switchbox News/Artikel Ende -->
		      <!-- Ftopics Box Start -->
		      <div class="box corner">
		        <h2 class="headline">{lang msgID="txt_ftopics"}</h2>
		        {ftopics}
		      </div>
		      <!-- Ftopics Box Ende -->
				<!-- Counter Box Start -->
				<div class="box corner">
					<h2 class="headline">{lang msgID="txt_counter"}</h2>
					{counter}
				</div>
				<!-- Counter Box Ende -->
		      <!-- Switchbox Kalender/Events Start -->
		      <div class="box corner">
		        <h2 class="headline tabs">
		          <span class="tabright">{lang msgID="txt_kalender"}</span>
		          <span class="tableft">{lang msgID="txt_events"}</span>
		        </h2>
		        <div class="switchs">{kalender}</div>
		        <div class="switchs">{events}</div>
		      </div>
		      <!-- Switchbox Kalender/Events Ende -->
		      <!-- Templateswitch Box Start -->
			{if $lock}
		      <div class="box corner">
		        <h2 class="headline">{lang msgID="txt_template_switch"}</h2>
		        {templateswitch}
		      </div>
			{/if}
		      <!-- Templateswitch Box Ende -->
		    </div>
		    <!-- rechte Spalte Ende -->
		    <!-- Clearfix Hack Start -->
		    <div class="clearFix"></div>
		    <!-- ClearFix Hack Ende -->
		  </div>
		</div>
		<!-- Wrapper bereich Ende -->
		<!-- Footer Start -->
		<div id="footer">
		  <div id="footwrapper">
		    <!-- Foot Platzhalter fï¿½r weiteren Content Start -->
		    <div class="leftFloat">&nbsp;</div>
		    <!-- Foot Platzhalter fï¿½r weiteren Content Ende -->
		    <div class="clearFix"></div>
		  </div>
		</div>
		<!-- Footer Ende -->
		<!-- Template Ende -->
	</body>
</html>
