<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Javascript Files
    ================================================== -->
    <!-- Core JS -->
    <script src="{dir}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{dir}/assets/js/core-min.js"></script>

    <script language="javascript" type="text/javascript" src="{dir}/_js/highlight.min.js"></script>
    <!-- <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.min.js"></script> -->
    <script language="javascript" type="text/javascript" src="{dir}/_js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.tools.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery-ui.min.js"></script>
    {$java_vars}
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.colorpicker.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.magnific-popup.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.highlighter.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.barrating.min.js"></script>
    <script language="javascript" type="text/javascript" src="{dir}/_js/jquery.dzcp.js"></script>

    <!-- Vendor JS -->
   <!-- <script src="{dir}/assets/vendor/twitter/jquery.twitter.js"></script> -->

    <!-- Template JS -->
    <!-- <script src="{dir}/assets/js/custom.js"></script> -->

  <!-- Basic Page Needs
  ================================================== -->
  <title>{$title}</title>
  <meta http-equiv="title" content="{$title}" />
  <meta http-equiv="pragma" content="No-Cache" />
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

  <link rel="alternate" type="application/rss+xml" href="../rss.xml" title="{$clanname} RSS-Feed" />
  <link rel="home" href="/" title="Home" />

  <!-- Bot Trap
  ================================================== -->
  <a style="visibility:hidden;" href="../inc/bot.php"><img src="{idir}/1px.gif" width="1" height="1" border="0" alt="" /></a>

  <!-- Favicons
  ================================================== -->
  <link rel="icon" type="image/ico" href="{dir}/favicon.ico" />

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">

  <!-- Google Web Fonts
  ================================================== -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CSource+Sans+Pro:400,700" rel="stylesheet">

  <!-- CSS
  ================================================== -->
  <!-- DZCP Base CSS -->
  <link rel="stylesheet" type="text/css" href="../inc/ajax.php?i=less&refresh" />

  <!-- Preloader CSS -->
  <link href="{dir}/assets/css/preloader.css" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="{dir}/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{dir}/assets/fonts/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <link href="{dir}/assets/vendor/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
  <link href="{dir}/assets/vendor/slick/slick.css" rel="stylesheet">

  <!-- Template CSS-->
  <link href="{dir}/assets/css/style.css" rel="stylesheet">

  <!-- Custom CSS-->
  <link href="{dir}/assets/css/custom.css" rel="stylesheet">

</head>
<body class="template-basketball">

  <div class="site-wrapper clearfix">
    <div class="site-overlay"></div>

    <!-- Header
    ================================================== -->
  
    <!-- Header Mobile -->
    <div class="header-mobile clearfix" id="header-mobile">
      <div class="header-mobile__logo">
        <a href="/news"><img src="{dir}/assets/images/logo.png" srcset="{dir}/assets/images/logo@2x.png 2x" alt="DZCP" class="header-mobile__logo-img"></a>
      </div>
      <div class="header-mobile__inner">
        <a id="header-mobile__toggle" class="burger-menu-icon"><span class="burger-menu-icon__line"></span></a>
        <span class="header-mobile__search-icon" id="header-mobile__search-icon"></span>
      </div>
    </div>
  
    <!-- Header Desktop -->
    <header class="header">
  
      <!-- Header Top Bar -->
      <div class="header__top-bar clearfix">
        <div class="container">
  
          <!-- Account Navigation -->
          <ul class="nav-account">
            <li class="nav-account__item"><a href="#" data-toggle="modal" data-target="#modal-login-register"class="highlight" >Dein Konto</a></li>
            <li class="nav-account__item"><a href="#">Credits</a></li>
            <li class="nav-account__item"><a href="#">GitHub Projekte</span></a>
              <ul class="main-nav__sub">
                  {github_nav}
              </ul>
            </li>
            <li class="nav-account__item"><a href="#">Aktuelle Beta: <span class="highlight"> {version type="beta"}</span></a>
            </li>
              <li class="nav-account__item"><a href="#">Aktuelle Stable: <span class="highlight green"> {version type="stable"}</span></a>
              </li>
            <li class="nav-account__item"><a href="#"><span class="highlight">{languages}</span></a>
            </li>
          </ul>
          <!-- Account Navigation / End -->
  
        </div>
      </div>
      <!-- Header Top Bar / End -->
  
      <!-- Header Secondary -->
      <div class="header__secondary">
        <div class="container">
          <!-- Header Search Form -->
          <div class="header-search-form">
            <form action="#" id="mobile-search-form" class="search-form">
              <input type="text" class="form-control header-mobile__search-control" value="" placeholder="Enter your seach here...">
              <button type="submit" class="header-mobile__search-submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <!-- Header Search Form / End -->
          <ul class="info-block info-block--header">
            <li class="info-block__item info-block__item--contact-primary">
              <svg role="img" class="df-icon df-icon--jersey">
                <use xlink:href="{dir}/assets/images/icons-basket.svg#jersey"/>
              </svg>
              <h6 class="info-block__heading">Support</h6>
              <a class="info-block__link" href="/forum">Jetzt zum Supportforum</a>
            </li>
            <li class="info-block__item info-block__item--contact-secondary">
              <svg role="img" class="df-icon df-icon--basketball">
                <use xlink:href="{dir}/assets/images/icons-basket.svg#basketball"/>
              </svg>
              <h6 class="info-block__heading">Jobs</h6>
              <a class="info-block__link" href="/jobs">Derzeitige Jobs zu vergeben</a>
            </li>
            <li class="info-block__item info-block__item--shopping-cart">
              <a href="#" class="info-block__link-wrapper">
                <div class="df-icon-stack df-icon-stack--bag">
                  <svg role="img" class="df-icon df-icon--bag">
                    <use xlink:href="{dir}/assets/images/icons-basket.svg#bag"/>
                  </svg>
                  <svg role="img" class="df-icon df-icon--bag-handle">
                    <use xlink:href="{dir}/assets/images/icons-basket.svg#bag-handle"/>
                  </svg>
                </div>
                <h6 class="info-block__heading">Aktuelle Bug einsendungen</h6>
                <a class="info-block__link">398 Bugs gemeldet</a>
              </a>
  
              <!-- BugReporter -->
              <ul class="header-cart">
                <li class="header-cart__item">
                  <div class="header-cart__inner">
                    <span class="header-cart__product-cat">BugReport. #00398</span>
                    <h5 class="header-cart__product-name"><a href="#">Forum Doppelpost</a></h5>
                    <div class="header-cart__product-sum">
                      <span class="header-cart__product-price">Radio Butten geht nicht</span>
                    </div>
                  </div>
                </li>
                <li class="header-cart__item">

                  <div class="header-cart__inner">
                    <span class="header-cart__product-cat">BugReport. #00397</span>
                    <h5 class="header-cart__product-name"><a href="#">Installation MySql Error</a></h5>
                    <div class="header-cart__product-sum">
                      <span class="header-cart__product-price">FTP Automatike vergabe der Rechte</span>
                    </div>
                  </div>
                </li>
                <li class="header-cart__item">

                  <div class="header-cart__inner">
                    <span class="header-cart__product-cat">BugReport. #00396</span>
                    <h5 class="header-cart__product-name"><a href="#">Adminmenü</a></h5>
                    <div class="header-cart__product-sum">
                      <span class="header-cart__product-price">Newskategorie lädt Bild nicht</span>
                    </div>
                  </div>
                </li>
                <li class="header-cart__item header-cart__item--subtotal">
                  <span class="header-cart__subtotal">Bugs Insgesamt bearbeitet</span>
                  <span class="header-cart__subtotal-sum">389</span>
                </li>
                <li class="header-cart__item header-cart__item--action">
                  <a href="shop-cart.html" class="btn btn-default btn-block">Supportforum</a>
                  <a href="shop-checkout.html" class="btn btn-primary-inverse btn-block">Bug eintragen</a>
                </li>
              </ul>
              <!-- BugReporter / End -->
  
            </li>
          </ul>
        </div>
      </div>
      <!-- Header Secondary / End -->
  
      <!-- Header Primary -->
      <div class="header__primary">
        <div class="container">
          <div class="header__primary-inner">
            <!-- Header Logo -->
            <div class="header-logo">
              <a href="/news"><img src="{dir}/assets/images/logo.png" alt="DZCP" srcset="{dir}/assets/images/logo.png" class="header-logo__img"></a>
            </div>
            <!-- Header Logo / End -->
  
            <!-- Main Navigation -->
            <nav style="background: #D1181E  url({dir}/assets/images/menu-back.png) top right repeat-x !important;;" class="main-nav clearfix">
              <ul class="main-nav__list">
                <li class=""><a href="#">Information</a>
                  <ul class="main-nav__sub">
                      {navi kat="main"}
                  </ul>
                </li>
                <li class=""><a href="#">Community</a>
                  <ul class="main-nav__sub">
                      {navi kat="community"}
                  </ul>
                </li>
                <li class=""><a href="#">Multimedia</a>
                  <ul class="main-nav__sub">
                      {navi kat="media"}
                  </ul>
                </li>
                <li class=""><a href="#">Downloads</a>
                  <ul class="main-nav__sub">
                      {navi kat="downloads"}
                  </ul>
                </li>
              </ul>
  
              <!-- Social Links -->
              <ul class="social-links social-links--inline social-links--main-nav">
                <li class="social-links__item">
                  <a href="#" class="social-links__link" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="social-links__item">
                  <a href="#" class="social-links__link" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="social-links__item">
                  <a href="#" class="social-links__link" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus"></i></a>
                </li>
              </ul>
              <!-- Social Links / End -->
  
              <!-- Pushy Panel Toggle -->
              <a href="#" class="pushy-panel__toggle">
                <span class="pushy-panel__line"></span>
              </a>
              <!-- Pushy Panel Toggle / Eng -->
            </nav>
            <!-- Main Navigation / End -->
          </div>
        </div>
      </div>
      <!-- Header Primary / End -->
  
    </header>
    <!-- Header / End -->
  
    <!-- Pushy Panel -->
    <aside class="pushy-panel pushy-panel--dark">
      <div class="pushy-panel__inner">
        <header class="pushy-panel__header">
          <div class="pushy-panel__logo">
            <a href="/news"><img src="{dir}/assets/images/logo.png" srcset="{dir}/assets/images/logo@2x.png 2x" alt="DZCP"></a>
          </div>
        </header>
        <div class="pushy-panel__content">
    
          <!-- Widget: Posts -->
          <aside class="widget widget--side-panel">
            <div class="widget__content">
              <ul class="posts posts--simple-list posts--simple-list--lg">
                <li class="posts__item posts__item--category-1">
                  <div class="posts__inner">
                    <div class="posts__cat">
                      <span class="label posts__cat-label">Projekt 1.6.5</span>
                    </div>
                    <h6 class="posts__title"><a href="#">Die Version 1.6.5 BETA Phase</a></h6>
                    <time datetime="2017-08-23" class="posts__date">32.06.2017</time>
                    <div class="posts__excerpt">
                      Bald ist es soweit. Lucas aka Hammermaps.dev ist bereits an der neuen Beta DZCP 1.6.5 dran und wird diese Version noch dieses Quartal Öffentlich zu testzwecken zum Download anbieten. 
                    </div>
                  </div>
                  <footer class="posts__footer card__footer">
                    <div class="post-author">
                      <figure class="post-author__avatar">
                        <img src="{dir}/assets/images/samples/avatar-1.jpg" alt="7nd">
                      </figure>
                      <div class="post-author__info">
                        <h4 class="post-author__name">7nd</h4>
                      </div>
                    </div>
                    <ul class="post__meta meta">
                      <li class="meta__item meta__item--likes"><a href="#"><i class="meta-like meta-like--active icon-heart"></i> 530</a></li>
                      <li class="meta__item meta__item--comments"><a href="#">18</a></li>
                    </ul>
                  </footer>
                </li>
                <li class="posts__item posts__item--category-2">
                  <div class="posts__inner">
                    <div class="posts__cat">
                      <span class="label posts__cat-label">Mods / Addons</span>
                    </div>
                    <h6 class="posts__title"><a href="#">Die neusten Addons und Mods von DZCP</a></h6>
                    <time datetime="2017-08-23" class="posts__date">31.06.2017</time>
                    <div class="posts__excerpt">
                      Bald ist es soweit. Lucas aka Hammermaps.dev ist bereits an der neuen Beta DZCP 1.6.5 dran und wird diese Version noch dieses Quartal Öffentlich zu testzwecken zum Download anbieten. 
                    </div>
                  </div>
                  <footer class="posts__footer card__footer">
                    <div class="post-author">
                      <figure class="post-author__avatar">
                        <img src="{dir}/assets/images/samples/avatar-1.jpg" alt="7nd">
                      </figure>
                      <div class="post-author__info">
                        <h4 class="post-author__name">7nd</h4>
                      </div>
                    </div>
                    <ul class="post__meta meta">
                      <li class="meta__item meta__item--likes"><a href="#"><i class="meta-like icon-heart"></i> 530</a></li>
                      <li class="meta__item meta__item--comments"><a href="#">18</a></li>
                    </ul>
                  </footer>
                </li>
              </ul>
            </div>
          </aside>
          <!-- Widget: Posts / End -->
    
          <!-- Widget: Tag Cloud -->
          <aside class="widget widget--side-panel widget-tagcloud">
            <div class="widget__title">
              <h4>Tag Cloud</h4>
            </div>
            <div class="widget__content">
              <div class="tagcloud">
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">DZCP</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">PROGRAMMIERUNG</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">DESIGN</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">CMS</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">CLANMANAGER</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">RESPONSIVE</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">PROJEKTE</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">MODS</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">ADDONS</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">TEMPLATES</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">NEWS</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">TEAM</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">PRESSE</a>
                <a href="#" class="btn btn-primary btn-xs btn-outline btn-sm">CREDITS</a>
              </div>
            </div>
          </aside>
          <!-- Widget: Tag Cloud / End -->
    
          <!-- Widget: Banner -->
          <aside class="widget widget--side-panel widget-banner">
            <div class="widget__content">
              <figure class="widget-banner__img">
                <a href="#"><img src="{dir}/assets/images/samples/banner.jpg" alt="Banner"></a>
              </figure>
            </div>
          </aside>
          <!-- Widget: Banner / End -->
    
        </div>
        <a href="#" class="pushy-panel__back-btn"></a>
      </div>
    </aside>
    <!-- Pushy Panel / End -->
    
  

    <!-- Page Heading
    ================================================== -->
    <div class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <h1 class="page-heading__title">{$title}</h1>
          </div>
        </div>
      </div>
    </div>  

    <!-- Content
    ================================================== -->
    <div class="site-content">
      <div class="container">

        <div class="row">
          <!-- Content -->
          <div class="content col-md-8">
            {$index}
              {templateswitch}
          </div>
          <!-- Content / End -->

          <!-- Sidebar -->
          <div id="sidebar" class="sidebar col-md-4">
            <!-- Widget: Popular News -->
            <aside class="widget widget--sidebar card widget-popular-posts">
              <div class="widget__title card__header">
                <h4>Aktuelle News</h4>
              </div>
              <div class="widget__content card__content">
                  {l_news}
              </div>
            </aside>
            <!-- Widget: Popular News / End -->

            <!-- Widget: Trending News -->
            <aside class="widget widget--sidebar card widget-tabbed">
              <div class="widget__title card__header">
                <h4>Neuste Foren</h4>
              </div>
              <div class="widget__content card__content">
                  {ftopics}
              </div>
            </aside>
            <!-- Widget: Trending News / End -->
            

            <!-- Widget: Latest Comments -->
            <aside class="widget widget--sidebar card widget-comments">
              <div class="widget__title card__header">
                <h4>Top Artikel</h4>
              </div>
              <div class="widget__content card__content">
                {l_artikel}
                  
              </div>
            </aside>
            <!-- Widget: Latest Comments / End -->
            
          </div>
          <!-- Sidebar / End -->
        </div>

      </div>
    </div>

    <!-- Content / End -->

    <!-- Footer
    ================================================== -->
    <footer id="footer" class="footer">
    
      <!-- Footer Widgets -->
      <div class="footer-widgets">
        <div class="footer-widgets__inner">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-3">
                <div class="footer-col-inner">
    
                  <!-- Footer Logo -->
                  <div class="footer-logo">
                    <a href="index.html"><img src="{dir}/assets/images/logo.png" srcset="{dir}/assets/images/logo.png" alt="Alchemists" class="footer-logo__img"></a>
                  </div>
                  <!-- Footer Logo / End -->
    
                </div>
              </div>
              <div class="col-sm-4 col-md-3">
                <div class="footer-col-inner">
                  <!-- Widget: Contact Info -->
                  <div class="widget widget--footer widget-contact-info">
                    <h4 class="widget__title">Contact Info</h4>
                    <div class="widget__content">
                      <div class="widget-contact-info__desc">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisi nel elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                      </div>
                      <div class="widget-contact-info__body info-block">
                        <div class="info-block__item">
                          <svg role="img" class="df-icon df-icon--basketball">
                            <use xlink:href="{dir}/assets/images/icons-basket.svg#basketball"/>
                          </svg>
                          <h6 class="info-block__heading">Contact Us</h6>
                          <a class="info-block__link" href="mailto:"></a>
                        </div>
                        <div class="info-block__item">
                          <svg role="img" class="df-icon df-icon--jersey">
                            <use xlink:href="{dir}/assets/images/icons-basket.svg#jersey"/>
                          </svg>
                          <h6 class="info-block__heading">Join Our Team!</h6>
                          <a class="info-block__link" href="mailto:t"></a>
                        </div>
                        <div class="info-block__item info-block__item--nopadding">
                          <ul class="social-links">
                            <li class="social-links__item">
                              <a href="#" class="social-links__link"><i class="fa fa-facebook"></i> Facebook</a>
                            </li>
                            <li class="social-links__item">
                              <a href="#" class="social-links__link"><i class="fa fa-twitter"></i> Twitter</a>
                            </li>
                            <li class="social-links__item">
                              <a href="#" class="social-links__link"><i class="fa fa-google-plus"></i> Google+</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Widget: Contact Info / End -->
                </div>
              </div>
              <div class="col-sm-4 col-md-3">
                <div class="footer-col-inner">
                  <!-- Widget: Popular Posts / End -->
                  <div class="widget widget--footer widget-popular-posts">
                    <h4 class="widget__title">Popular News</h4>
                    <div class="widget__content">
                      <ul class="posts posts--simple-list">
                        <li class="posts__item posts__item--category-2">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">Injuries</span>
                          </div>
                          <h6 class="posts__title"><a href="#">Mark Johnson has a Tibia Fracture and is gonna be out</a></h6>
                          <time datetime="2017-08-23" class="posts__date">August 23rd, 2017</time>
                        </li>
                        <li class="posts__item posts__item--category-1">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">The Team</span>
                          </div>
                          <h6 class="posts__title"><a href="#">Jay Rorks is only 24 points away from breaking the record</a></h6>
                          <time datetime="2017-08-22" class="posts__date">August 22nd, 2017</time>
                        </li>
                        <li class="posts__item posts__item--category-1">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">The Team</span>
                          </div>
                          <h6 class="posts__title"><a href="#">The new eco friendly stadium won a Leafy Award in 2017</a></h6>
                          <time datetime="2017-08-21" class="posts__date">August 21st, 2017</time>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- Widget: Popular Posts / End -->
                </div>
              </div>
              <div class="col-sm-4 col-md-3">
                <div class="footer-col-inner">
    
                  <!-- Widget: Instagram -->
                  <div class="widget widget--footer widget-popular-posts">
                    <h4 class="widget__title">Popular News</h4>
                    <div class="widget__content">
                      <ul class="posts posts--simple-list">
                        <li class="posts__item posts__item--category-2">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">Injuries</span>
                          </div>
                          <h6 class="posts__title"><a href="#">Mark Johnson has a Tibia Fracture and is gonna be out</a></h6>
                          <time datetime="2017-08-23" class="posts__date">August 23rd, 2017</time>
                        </li>
                        <li class="posts__item posts__item--category-1">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">The Team</span>
                          </div>
                          <h6 class="posts__title"><a href="#">Jay Rorks is only 24 points away from breaking the record</a></h6>
                          <time datetime="2017-08-22" class="posts__date">August 22nd, 2017</time>
                        </li>
                        <li class="posts__item posts__item--category-1">
                          <div class="posts__cat">
                            <span class="label posts__cat-label">The Team</span>
                          </div>
                          <h6 class="posts__title"><a href="#">The new eco friendly stadium won a Leafy Award in 2017</a></h6>
                          <time datetime="2017-08-21" class="posts__date">August 21st, 2017</time>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- Widget: Instagram / End -->
                  
    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Widgets / End -->
    
      <!-- Footer Secondary -->
      <div class="footer-secondary footer-secondary--has-decor">
        <div class="container">
          <div class="footer-secondary__inner">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <ul class="footer-nav">
                    {navi kat="footer"}
                  <li class="footer-nav__item"><a href="#">Home</a></li>
                  <li class="footer-nav__item"><a href="#">Features</a></li>
                  <li class="footer-nav__item"><a href="#">Statistics</a></li>
                  <li class="footer-nav__item"><a href="#">The Team</a></li>
                  <li class="footer-nav__item"><a href="#">News</a></li>
                  <li class="footer-nav__item"><a href="#">Shop</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Secondary / End -->
    </footer>
    <!-- Footer / End -->
      
    <!-- Login/Register Modal -->
    <div class="modal fade" id="modal-login-register" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg modal--login" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
    
            <div class="modal-account-holder">
              <div class="modal-account__item">
		        <h2 class="headline">{lang msgID="txt_userarea"}</h2>
		        {login}
		        <div class="leftFloat">{avatar}</div>
		        <div class="leftFloat">{navi kat="user"}{navi kat="trial"}{navi kat="member"}{navi kat="admin"}</div>
		        <br style="clear:both" />
              </div>
              <div class="modal-account__item">
    
                <!-- Login Form -->
                <form action="#" class="modal-form">
                  <h5>Login to your account</h5>
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter your email address...">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter your password...">
                  </div>
                  <div class="form-group form-group--pass-reminder">
                    <label class="checkbox checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1" checked> Remember Me
                      <span class="checkbox-indicator"></span>
                    </label>
                    <a href="#">Forgot your password?</a>
                  </div>
                  <div class="form-group form-group--submit">
                    <a href="shop-account.html" class="btn btn-primary-inverse btn-block">Enter to your account</a>
                  </div>
                  <div class="modal-form--social">
                    <h6>or Login with your social profile:</h6>
                    <ul class="social-links social-links--btn text-center">
                      <li class="social-links__item">
                        <a href="#" class="social-links__link social-links__link--lg social-links__link--fb"><i class="fa fa-facebook"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="#" class="social-links__link social-links__link--lg social-links__link--twitter"><i class="fa fa-twitter"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="#" class="social-links__link social-links__link--lg social-links__link--gplus"><i class="fa fa-google-plus"></i></a>
                      </li>
                    </ul>
                  </div>
                </form>
                <!-- Login Form / End -->
    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Login/Register Modal / End -->   
  </div>
  </body>

    <script src="{dir}/assets/js/init.js"></script>
</html>