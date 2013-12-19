<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<!-- head -->
<head>
      <meta charset="utf-8">
      <title>ThinkCMF-Powerd by ThinkCMF.com</title>
      <meta property="qc:admins" content="4351046525764016335663757" />
      <meta name="description" content="Pixma Responsive HTML5/CSS3 Template from FIFOTHEMES.COM">
      <meta name="author" content="ThinkCMF.com">
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Google Fonts -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
      <!-- Library CSS -->
      <link rel="stylesheet" href="__TMPL__Public/css/bootstrap.css">
      <link rel="stylesheet" href="__TMPL__Public/css/fonts/font-awesome/css/font-awesome.css">
      <link rel="stylesheet" href="__TMPL__Public/css/animations.css" media="screen">
      <link rel="stylesheet" href="__TMPL__Public/css/superfish.css" media="screen">
      <link rel="stylesheet" href="__TMPL__Public/css/revolution-slider/css/settings.css" media="screen">
      <link rel="stylesheet" href="__TMPL__Public/css/prettyPhoto.css" media="screen">
      <!-- Theme CSS -->
      <link rel="stylesheet" href="__TMPL__Public/css/style.css">
      <!-- Skin -->
      <link rel="stylesheet" href="__TMPL__Public/css/colors/blue.css" id="colors">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="__TMPL__Public/css/theme-responsive.css">
      <!-- Switcher CSS -->
     <link href="__TMPL__Public/css/switcher.css" rel="stylesheet">
     <link href="__TMPL__Public/css/spectrum.css" rel="stylesheet">
      <!-- Favicons -->
      <link rel="shortcut icon" href="__TMPL__Public/img/ico/favicon.ico">
      <link rel="apple-touch-icon" href="__TMPL__Public/img/ico/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="72x72" href="__TMPL__Public/img/ico/apple-touch-icon-72.png">
      <link rel="apple-touch-icon" sizes="114x114" href="__TMPL__Public/img/ico/apple-touch-icon-114.png">
      <link rel="apple-touch-icon" sizes="144x144" href="__TMPL__Public/img/ico/apple-touch-icon-144.png">
      <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="__TMPL__Public/js/respond.min.js"></script>
      <![endif]-->
      <!--[if IE]>
      <link rel="stylesheet" href="__TMPL__Public/css/ie.css">
      <![endif]-->
   </head>
<!-- head -->
<body class="page">
	<div class="wrap">
		<!-- Header start -->
		 <!-- Header Start -->
         <header id="header">
            <!-- Header Top Bar Start -->
            <div class="top-bar">
               <div class="slidedown collapse">
                  <div class="container">
                     <div class="phone-email pull-left">
                        <a><i class="icon-phone"></i> Call Us : +86 021 31120248</a>
                        <a href="mailto:cmf@simplewind.net"><i class="icon-envelope"></i> Email : cmf@simplewind.net</a>
                     </div>
                     <div class="pull-right">
                    <?php if((strtolower($_SESSION['MEMBER_type']) == 'qq') OR (strtolower($_SESSION['MEMBER_type']) == 'sina')): ?>欢迎您，来自<?php echo (session('MEMBER_type')); ?>的用户：<?php echo (session('MEMBER_name')); ?>
						<a href="index.php?g=member&m=index&a=logout">退出</a>
					<?php elseif($_SESSION['MEMBER_type'] == 'local'): ?>
						欢迎您，<?php echo (session('MEMBER_name')); ?>
						<a href="index.php?g=member&m=index&a=logout">退出</a>
					<?php else: ?>
                        <ul class="social pull-left">
                           <li class="facebook"><a href="index.php?g=api&m=oauth&a=login&type=qq"><img src="__TMPL__/Public/img/qq.png" /></a></li>
                           <li class="twitter"><a href="index.php?g=api&m=oauth&a=login&type=sina"><img width="16" src="__TMPL__/Public/img/weibo.png" /></a></li>
                        </ul><?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Header Top Bar End -->
            <!-- Main Header Start -->
            <div class="main-header">
               <div class="container">
                  <!-- TopNav Start -->
                  <div class="topnav navbar-header">
                     <a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
                     <i class="icon-angle-down icon-current"></i>
                     </a> 
                  </div>
                  <!-- TopNav End -->
                  <!-- Logo Start -->
                  <div class="logo pull-left">
                     <h1>
                        <a href="<?php echo ($site_host); ?>">
                        <img src="__TMPL__Public/img/logo.png" alt="pixma" width="125" height="60">
                        </a>
                     </h1>
                  </div>
                  <!-- Logo End -->
                  <!-- Mobile Menu Start -->
                  <div class="mobile navbar-header">
                     <a class="navbar-toggle" data-toggle="collapse" href=".navbar-collapse">
                     <i class="icon-reorder icon-2x"></i>
                     </a> 
                  </div>
                  <!-- Mobile Menu End -->
                  <!-- Menu Start -->
                  <nav class="collapse navbar-collapse menu">
              <?php $effected_id="menu-header"; $filetpl="<a  href='\$href'>\$label</a>"; $foldertpl="<a  href='\$href'>\$label<span><i class='icon-angle-down'></i></span></a>"; $ul_class="" ; $li_class="" ; $style="nav"; $showlevel=6; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel); ?>
                    <!--  <ul class="nav navbar-nav sf-menu">
                        <li>
                           <a id="current" href="index.html">
                           Home
                           <span class="sf-sub-indicator">
                           <i class="icon-angle-down "></i>
                           </span>
                           </a>
                           <ul>
                              <li><a href="index-2.html" class="sf-with-ul">Home 2</a></li>
                              <li><a href="index-3.html" class="sf-with-ul">Home 3</a></li>
                              <li><a href="index-nivo.html" class="sf-with-ul">Nivo Slider</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#" class="sf-with-ul">
                           Features 
                           <span class="sf-sub-indicator">
                           <i class="icon-angle-down "></i>
                           </span>
                           </a>
                           <ul>
                              <li><a href="shortcodes.html" class="sf-with-ul">Shortcodes</a></li>
                              <li><a href="icons.html" class="sf-with-ul">Icons</a></li>
                              <li><a href="pricing-table.html" class="sf-with-ul">Pricing Tables</a></li>
                              <li>
                                 <a href="#" class="sf-with-ul"> 
                                 Third Level Menu 
                                 <span class="sf-sub-indicator pull-right">
                                 <i class="icon-angle-right "></i>
                                 </span>
                                 </a>
                                 <ul>
                                    <li><a href="#" class="sf-with-ul">Menu Item</a></li>
                                    <li><a href="#" class="sf-with-ul">Menu Item</a></li>
                                    <li><a href="#" class="sf-with-ul">Menu Item</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="#" class="sf-with-ul">
                           Pages
                           <span class="sf-sub-indicator">
                           <i class="icon-angle-down "></i>
                           </span>
                           </a>
                           <ul>
                              <li><a href="about.html" class="sf-with-ul">About Us</a></li>
                              <li><a href="services.html" class="sf-with-ul">Services</a></li>
                              <li><a href="testimonials.html" class="sf-with-ul">Testimonials</a></li>
                              <li><a href="full-width.html" class="sf-with-ul">Full Width Page</a></li>
                              <li><a href="page-left-sidebar.html" class="sf-with-ul">Left Sidebar</a></li>
                              <li><a href="page-right-sidebar.html" class="sf-with-ul">Right Sidebar</a></li>
                              <li><a href="page-left-navigation.html" class="sf-with-ul">Left Navigation</a></li>
                              <li><a href="page-right-navigation.html" class="sf-with-ul">Right Navigation</a></li>
                              <li><a href="faq.html" class="sf-with-ul">FAQ</a></li>
                              <li><a href="page-404.html" class="sf-with-ul">404 Page</a></li>
                              <li><a href="sitemap.html" class="sf-with-ul">Sitemap</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#" class="sf-with-ul">
                           Portfolio
                           <span class="sf-sub-indicator">
                           <i class="icon-angle-down "></i>
                           </span>
                           </a>
                           <ul>
                              <li><a href="portfolio-two.html" class="sf-with-ul">2 Column</a></li>
                              <li><a href="portfolio-three.html" class="sf-with-ul">3 Column</a></li>
                              <li><a href="portfolio-four.html" class="sf-with-ul">4 Column</a></li>
                              <li><a href="portfolio-single.html" class="sf-with-ul">Single Item Page</a></li>
                              <li><a href="portfolio-single-big.html" class="sf-with-ul">Single Large Item Page</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="#" class="sf-with-ul">
                           Blog
                           <span class="sf-sub-indicator">
                           <i class="icon-angle-down "></i>
                           </span>
                           </a>
                           <ul>
                              <li><a href="blog-left-sidebar.html" class="sf-with-ul">Left Sidebar Blog</a></li>
                              <li><a href="blog-right-sidebar.html" class="sf-with-ul">Right Sidebar Blog</a></li>
                              <li><a href="blog-small.html" class="sf-with-ul">Small Blog</a></li>
                              <li><a href="single-post.html" class="sf-with-ul">Single Post</a></li>
                           </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                     </ul> -->
                  </nav>
                  <!-- Menu End --> 
               </div>
            </div>
            <!-- Main Header End -->
         </header>
         <!-- Header End --> 
		<!-- Header End -->

		<!-- Content Start -->
		<div id="main">
			<!-- Title, Breadcrumb Start-->
			<div class="breadcrumb-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<h2 class="title">可用代码</h2>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<div class="breadcrumbs pull-right">
								<ul>
									<li>你的位置:</li>
									<li><a href="#">前端工具</a></li>
									<li>可用代码</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Title, Breadcrumb End-->
			<!-- Main Content start-->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
							<h3 class="title">提醒框工具</h3>
							<div class="alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								这是个警告信息提示框
							</div>
							<div class="alert-danger alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								这是个错误信息提示框
							</div>
							<div class=" alert-info alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								这是个消息提示框
							</div>
							<div class=" alert-success alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								这是个成功信息提示框
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">进度条工具</h3>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="85"
									aria-valuemin="0" aria-valuemax="100" style="width: 85%;">PHP
									85%</div>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="65"
									aria-valuemin="0" aria-valuemax="100" style="width: 65%;">mysql 65%</div>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="90"
									aria-valuemin="0" aria-valuemax="100" style="width: 90%;">HTML/CSS
									90%</div>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="60"
									aria-valuemin="0" aria-valuemax="100" style="width: 60%;">SEO
									60%</div>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="85"
									aria-valuemin="0" aria-valuemax="100" style="width: 75%;">BootStrap
									85%</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<!-- Left Section End -->
					</div>
					<div class="divider"></div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<!-- Tab Start -->
							<h3 class="title">选项卡工具</h3>
							<div class="widget tabs">
								<div id="horizontal-tabs">
									<ul class="tabs">
										<li id="tab1" class="current">设计</li>
										<li id="tab2">开发</li>
										<li id="tab3">测试</li>
									</ul>
									<div class="contents">
										<div class="tabscontent" id="content1" style="display: block;">
											<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
										</div>
										<div class="tabscontent" id="content2">
											<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
										</div>
										<div class="tabscontent" id="content3">
											<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。<br>
											这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到ThinkCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Tab End -->
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">折叠框工具</h3>
							<div class="accordionMod panel-group">
								<div class="accordion-item">
									<h4 class="accordion-toggle">Google</h4>
									<section class="accordion-inner panel-body">
										<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到SimpleCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
									</section>
								</div>
								<div class="accordion-item">
									<h4 class="accordion-toggle">HTML</h4>
									<section class="accordion-inner panel-body">
										<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到SimpleCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
									</section>
								</div>
								<div class="accordion-item">
									<h4 class="accordion-toggle">Ajax</h4>
									<section class="accordion-inner panel-body">
										<p>这是由ThinkCMF提供的前端开发工具包，你可以很方便的将这里的样式或图表集成到SimpleCMF系统中。试用时只要在模板中直接键入相应CSS类即可。</p>
									</section>
								</div>
							</div>
						</div>
					</div>
					<div class="divider"></div>
					<!-- End Second Row -->
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">tips工具</h3>
							<div class="tooltips">
								<div class="well">
									<button type="button" class="btn btn-success"
										data-toggle="tooltip" data-placement="right" title=""
										data-original-title="Tooltip on right">Tooltip on
										right</button>
									<button type="button" class="btn btn-success pull-right"
										data-toggle="tooltip" data-placement="left" title=""
										data-original-title="Tooltip on left">Tooltip on left</button>
								</div>
								<div class="well">
									<button type="button" class="btn btn-success"
										data-toggle="tooltip" data-placement="top" title=""
										data-original-title="Tooltip on top">Tooltip on top</button>
									<button type="button" class="btn btn-success pull-right"
										data-toggle="tooltip" data-placement="bottom" title=""
										data-original-title="Tooltip on bottom">Tooltip on
										bottom</button>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">Popovers</h3>
							<div class="well">
								<a id="example" class="btn btn-success" data-rel="popover"
									data-content="It's so simple to create a tooltip for my website!"
									data-original-title="Twitter Bootstrap">Right popover</a> <a
									id="example_left" class="btn btn-success pull-right"
									data-rel="popover"
									data-content="It's so simple to create a tooltop for my website!"
									data-original-title="Twitter Bootstrap">Left popover</a>
							</div>
							<div class="well">
								<a id="example_top" class="btn btn-success" data-rel="popover"
									data-content="It's so simple to create a tooltop for my website!"
									data-original-title="Twitter Bootstrap">Top popover</a> <a
									id="example_bottom" class="btn btn-success pull-right"
									data-rel="popover"
									data-content="It's so simple to create a tooltop for my website!"
									data-original-title="Twitter Bootstrap"> Bottom popover</a>
							</div>
						</div>
					</div>
					<div class="divider"></div>
					<!-- End Third Row -->
					<div class="row">
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">按钮</h3>
							<div class="well">
								<a class="btn-grey btn-small btn-pad" href="#">Small</a> <a
									class="btn-small btn-color btn-pad" href="#">Small</a>
								<div class="clearfix"></div>
								<a class="btn-grey btn-normal btn-pad" href="#">Medium</a> <a
									class="btn-color btn-normal btn-pad" href="#">Medium</a>
								<div class="clearfix"></div>
								<a class="btn-large btn-grey btn-pad" href="#">Large</a> <a
									class="btn-large btn-color btn-pad" href="#">Large</a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
							<h3 class="title">表格</h3>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Header1</th>
										<th>Header2</th>
										<th>Header3</th>
										<th>Header4</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>item</td>
										<td>item</td>
										<td>item</td>
										<td>item</td>
									</tr>
									<tr>
										<td>item</td>
										<td>item</td>
										<td>item</td>
										<td>item</td>
									</tr>
									<tr>
										<td>item</td>
										<td>item</td>
										<td>item</td>
										<td>item</td>
									</tr>
									<tr>
										<td>item</td>
										<td>item</td>
										<td>item</td>
										<td>item</td>
									</tr>
									<tr>
										<td>item</td>
										<td>item</td>
										<td>item</td>
										<td>item</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="divider"></div>
					<!-- End 4th Row-->
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h3 class="title">表单元素</h3>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
									<input type="text" class="form-control"
										placeholder="Text input"><br>
									<textarea class="form-control" rows="4"></textarea>
									<br>
									<div class="input-group">
										<input type="text" class="form-control"> <span
											class="input-group-btn">
											<button class="btn btn-default" type="button">Go!</button>
										</span>
									</div>
									<!-- /input-group -->
									<br>
									<div class="input-group">
										<input type="text" class="form-control">
										<div class="input-group-btn">
											<button type="button" class="btn btn-default dropdown-toggle"
												data-toggle="dropdown">
												Action <span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right">
												<li><a href="#">Action</a></li>
												<li><a href="#">另一个action</a></li>
												<li><a href="#">其他</a></li>
												<li class="divider"></li>
												<li><a href="#">有一个分割线</a></li>
											</ul>
										</div>
										<!-- /btn-group -->
									</div>
									<!-- /input-group -->
									<br>
									<div class="widget search-form">
										<div class="input-group">
											<input type="text" value="Search..."
												onfocus="if(this.value=='Search...')this.value='';"
												onblur="if(this.value=='')this.value='Search...';"
												class="search-input form-control"> <span
												class="input-group-btn">
												<button type="submit" class="subscribe-btn btn">
													<i class="icon-search"></i>
												</button>
											</span>
										</div>
										<!-- /input-group -->
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
									<select class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select> <br>
									<div class="input-group">
										<span class="input-group-addon">@</span> <input type="text"
											class="form-control" placeholder="Username">
									</div>
									<br>
									<div class="input-group">
										<input type="text" class="form-control"> <span
											class="input-group-addon">.00</span>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon">$</span> <input type="text"
											class="form-control"> <span class="input-group-addon">.00</span>
									</div>
									<br> <input class="form-control" id="disabledInput"
										type="text" placeholder="输入框锁定..." disabled><br>
									<div class="checkbox">
										<label> <input type="checkbox" value="">
											多选框
										</label>
									</div>
									<div class="radio">
										<label> <input type="radio" name="optionsRadios"
											id="optionsRadios1" value="option1" checked> 单选
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End 5th Row-->
				</div>
			</div>
		</div>
			<!-- Content End -->

			<!-- Footer Start -->
			<footer id="footer">
            <!-- Footer Top Start -->
            <div class="footer-top">
               <div class="container">
                  <div class="row">
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-one">
                        <h3>关于我们</h3>
                        <p> 
                        	中国领先的内容管理框架提供商，崇尚自由与免费，乐于分享。团队理念:"授人以鱼亦授人以渔"。
                        </p>
                     </section>
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-two">
                        <h3>合作媒体</h3>
                        <ul id="tweets">
                        </ul>
                     </section>
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-three">
                        <h3>联系我们</h3>
                        <ul class="contact-us">
                           <li>
                              <i class="icon-map-marker"></i>
                              <p> 
                                 <strong>Address:</strong>上海市徐汇区斜土路2601号 
                              </p>
                           </li>
                           <li>
                              <i class="icon-phone"></i>
                              <p><strong>Phone:</strong> +86 21 31120248</p>
                           </li>
                           <li>
                              <i class="icon-envelope"></i>
                              <p><strong>Email:</strong><a href="mailto:cmf@simplewind.net">cmf@simplewind.net</a></p>
                           </li>
                        </ul>
                     </section>
                     <section class="goble">
                        <h3>simpelwind全球</h3>
                        <ul id="" class="">
                        <li>中国总部</li>
                        <li>上海研发中心</li>
                        <li>北美办事处</li>
                        </ul>
                     </section>
                  </div>
               </div>
            </div>
            <!-- Footer Top End --> 
            <!-- Footer Bottom Start -->
            <div class="footer-bottom">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 "> &copy; Copyright 2013 by <a href="#">ThinkCMF</a>. All Rights Reserved. </div>
                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                        
                     </div>
                  </div>
               </div>
            </div>
            <!-- Footer Bottom End --> 
         </footer>
			<!-- Footer End -->
			<!-- Scroll To Top -->
			<a href="#" class="scrollup"><i class="icon-angle-up"></i></a>
		</div>
		<!-- Wrap End -->
		<!-- switcher start -->
		<section id="style-switcher">
        <h2>样式切换器 <a href="#"><i class="icon-cog"></i></a></h2>
        <div>
           <!-- <h3>Predefined Colors</h3>
           <ul id="colors" class="colors">
              <li><a title="Blue" class="blue" href="#"></a></li>
              <li><a title="Green" class="green" href="#"></a></li>
              <li><a title="Orange" class="orange" href="#"></a></li>
              <li><a title="Purple" class="purple" href="#"></a></li>
              <li><a title="Red" class="red" href="#"></a></li>
              <li><a title="Magenta" class="magenta" href="#"></a></li>
              <li><a title="Brown" class="brown" href="#"></a></li>
              <li><a title="Gray" class="gray" href="#"></a></li>
              <li><a title="Golden" class="golden" href="#"></a></li>
              <li><a title="Teal" class="teal" href="#"></a></li>
           </ul> -->
           <h3>布局样式</h3>
           <div class="layout-style">
              <select autocomplete="off" id="layout-style">
                 <option value="1">宽屏</option>
                 <option value="2">窄屏</option>
              </select>
           </div>
           <h3>头部颜色</h3>
           <div class="header-color">
              <input type='text' class="header-bg" />
           </div>
           <h3>页脚顶部颜色</h3>
           <div class="header-color">
              <input type='text' class="footer-bg" />
           </div>
           <h3>页脚底部颜色</h3>
           <div class="header-color">
              <input type='text' class="footer-bottom" />
           </div>
           <!-- <h3>背景图片</h3>
           <ul id="bg" class="colors bg">
              <li><a class="bg1" href="#"></a></li>
              <li><a class="bg2" href="#"></a></li>
              <li><a class="bg3" href="#"></a></li>
              <li><a class="bg4" href="#"></a></li>
              <li><a class="bg5" href="#"></a></li>
              <li><a class="bg6" href="#"></a></li>
              <li><a class="bg7" href="#"></a></li>
              <li><a class="bg8" href="#"></a></li>
              <li><a class="bg9" href="#"></a></li>
              <li><a class="bg10" href="#"></a></li>
           </ul> -->
        </div>
     </section>
		<!-- switcher end -->
		<!-- The Scripts -->
		<script src="__TMPL__Public/js/jquery.min.js"></script>
      <script src="__TMPL__Public/js/bootstrap.js"></script>
      <script src="__TMPL__Public/js/jquery.parallax.js"></script> 
      <script src="__TMPL__Public/js/modernizr-2.6.2.min.js"></script> 
      <script src="__TMPL__Public/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
      <script src="__TMPL__Public/js/jquery.nivo.slider.pack.js"></script>
      <script src="__TMPL__Public/js/jquery.prettyPhoto.js"></script>
      <script src="__TMPL__Public/js/superfish.js"></script>
      <script src="__TMPL__Public/js/tweetMachine.js"></script>
      <script src="__TMPL__Public/js/tytabs.js"></script>
      <script src="__TMPL__Public/js/jquery.gmap.min.js"></script>
      <script src="__TMPL__Public/js/circularnav.js"></script>
      <script src="__TMPL__Public/js/jquery.sticky.js"></script>
      <script src="__TMPL__Public/js/jflickrfeed.js"></script>
      <script src="__TMPL__Public/js/imagesloaded.pkgd.min.js"></script>
      <script src="__TMPL__Public/js/waypoints.min.js"></script>
      <script src="__TMPL__Public/js/spectrum.js"></script>
      <script src="__TMPL__Public/js/switcher.js"></script>
      <script src="__TMPL__Public/js/custom.js"></script>
      
      <script>
   
      
      $(function(){
    	  
    	  $("#menu-header li a").each(function() {
              //设置样式
            //  alert($(this)[0].href + "::" + window.location.toString());
				if ($(this)[0].href+"/" == window.location.toString() || $(this)[0].href == window.location.toString()) {
					if($(this).parent().parent().is($("#menu-header"))){
						$(this)[0].id="current";
					}else{
						$(this).parents(".hasChild").children('a')[0].id="current";
					}
					return false;
				}
			});

    	  
      });
      
      </script>
		<!-- The Scripts -->
		</body>
</html>