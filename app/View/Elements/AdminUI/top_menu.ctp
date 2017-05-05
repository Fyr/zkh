<style>
.page-logo a {
	padding: 10px 15px;
	line-height: 1.2em;
	height: 50px;
	font-size: 1.5em;
}
.top-menu .nav a, .top-menu .nav a:visited, .page-logo a, .page-logo a:visited {
	color: #fff;
}
.top-menu .nav a:hover, .page-logo a:hover {
	background: #fff;
	color: #747F8C;
	text-decoration: none;
}

</style>
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner ">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/admin/">
				<?=Configure::read('domain.title')?> CMS
				<!-- img src="/img/logo-white.png" alt="logo" class="logo-default" style="height: 30px; position: relative; top: -7px;" /-->
			</a>
			<div class="menu-toggler sidebar-toggler"> </div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li>
					<a class="" href="javascript:;">
						<i class="icon-home"></i> Главная
					</a>
				</li>
				<li>
					<a class="" href="<?=$this->Html->url(array('controller' => 'AdminAuth', 'action' => 'logout'))?>">
						<i class="icon-logout"></i> Выход
					</a>
				</li>
			</ul>

		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>

