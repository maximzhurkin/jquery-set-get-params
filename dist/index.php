<?php
// Data simulation
$categories = array(
	array( 'id' => 1, 'title' => 'Bananas' ),
	array( 'id' => 2, 'title' => 'Corn' ),
	array( 'id' => 3, 'title' => 'Avocado' ),
	array( 'id' => 4, 'title' => 'Beans' ),
	array( 'id' => 5, 'title' => 'Courgettes')
);
$sorting = array(
	array( 'title' => 'Featured', 'value' => 'id|desc' ),
	array( 'title' => 'Price: Low to High', 'value' => 'price|asc' ),
	array( 'title' => 'Price: High to Low', 'value' => 'price|desc' )
);
$counts = array(10, 50, 100);
$pagination = array();
if (isset($_GET['page']) && $_GET['page'] > 1) { $pagination[] = array( 'title' => 'Previous page', 'page' => (intval($_GET['page']) - 1), 'active' => false ); }
else { $pagination[] = array( 'title' => 'Previous page', 'page' => 1, 'active' => false ); }
for ($i = 1; $i <= 3; $i ++) {
	if (isset($_GET['page']) && $i == $_GET['page']) { $pagination[] = array( 'title' => $i, 'page' => $i, 'active' => true ); }
	else { $pagination[] = array( 'title' => $i, 'page' => $i, 'active' => false); }
}
if (isset($_GET['page']) && $_GET['page'] < 3) { $pagination[] = array( 'title' => 'Next page', 'page' => (intval($_GET['page']) + 1), 'active' => false ); }
else if (isset($_GET['page']) && $_GET['page'] == 3) { $pagination[] = array( 'title' => 'Next page', 'page' => 3, 'active' => false ); }
else { $pagination[] = array( 'title' => 'Next page', 'page' => 2, 'active' => false ); }

?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta content="telephone=no" name="format-detection">
		<title>jQuery setGetParams plugin</title>
		<!-- if IE meta(http-equiv='X-UA-Compatible', content='IE=edge,chrome=1')-->
		<!-- if lt IE 9 script(src='http://html5shiv.googlecode.com/svn/trunk/html5.js')-->
		<link rel="shortcut icon" href="assets/images/favicons/favicon.ico" type="image/x-icon">
		<link rel="mask-icon" href="assets/images/favicons/favicon.svg" color="#000000">
		<link rel="apple-touch-icon" href="assets/images/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon-180x180.png">
		<link type="text/css" rel="stylesheet" href="assets/styles/bundle.css">
	</head>
	<body>
		<header class="section section--blue section--skew section--top">
			<div class="section__container">
				<div class="header">
					<div class="header__content">
						<h1 class="header__heading">jQuery setGetParams Plugin</h1>
						<div class="header__description">Plugin allows you to add and change GET parameters in the address bar</div>
						<div class="header__buttons"><span class="header__button"><a class="button button--yellow" href="https://github.com/maximzhurkin/jquery-set-get-params/archive/master.zip">Download plugin</a></span><span class="header__button"><a class="button button--white" href="https://github.com/maximzhurkin/jquery-set-get-params">Github</a></span></div>
					</div>
				</div>
			</div>
		</header>
		<section class="section">
			<div class="section__container">
				<div class="section__content">
					<h2 class="section__heading">Demo</h2>
				</div>
				<div class="butts group">
					<div class="butts__lside">
						<div class="categories">
							<ul class="categories__list">
								<?php foreach ($categories as $category): ?>
								<li class="categories__item">
									<?php if (isset($_GET['category']) && $category['id'] == $_GET['category']): ?>
									<a class="categories__link categories__link--active" href="#" data-id="<?=$category['id']?>"><?=$category['title']?></a>
									<?php else: ?>
									<a class="categories__link" href="#" data-id="<?=$category['id']?>"><?=$category['title']?></a>
									<?php endif ?>
								</li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
					<div class="butts__main">
						<div class="butts__search">
							<?php if (isset($_GET['search'])): ?>
							<input class="input input--search" type="search" name="search" value="<?=$_GET['search']?>" placeholder="Enter search query and press enter">
							<?php else:?>
							<input class="input input--search" type="search" name="search" placeholder="Enter search query and press enter">
							<?php endif ?>
						</div>
						<div class="butts__sorting group">
							<div class="butts__sorting-item group">
								<div class="butts__sorting-caption">Sort by:</div>
								<div class="butts__sorting-select">
									<div class="select">
										<select name="sort">
											<?php foreach ($sorting as $sort): ?>
												<?php if (isset($_GET['sort']) && $sort['value'] == $_GET['sort']): ?>
												<option value="<?=$sort['value']?>" selected><?=$sort['title']?></option>
												<?php else: ?>
												<option value="<?=$sort['value']?>"><?=$sort['title']?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="butts__sorting-item butts__sorting-item--right group">
								<div class="butts__sorting-caption">Count on page:</div>
								<div class="butts__sorting-select">
									<div class="select">
										<select name="count">
											<?php foreach ($counts as $count): ?>
												<?php if (isset($_GET['count']) && $count == $_GET['count']): ?>
												<option value="<?=$count?>" selected><?=$count?></option>
												<?php else: ?>
												<option value="<?=$count?>"><?=$count?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="butts__products"></div>
						<div class="butts__pagination">
							<div class="pagination">
								<ul class="pagination__list">
									<?php foreach ($pagination as $page): ?>
									<li class="pagination__item">
										<?php if (isset($_GET['page']) && $page['active']): ?>
										<a class="pagination__link pagination__link--active" href="#" data-page="<?=$page['page']?>"><?=$page['title']?></a>
										<?php else: ?>
										<a class="pagination__link" href="#" data-page="<?=$page['page']?>"><?=$page['title']?></a>
										<?php endif ?>
									</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section section--gray section--skew">
			<div class="section__container">
				<div class="section__content">
					<h2 class="section__heading">Use</h2>
				</div>
				<div class="section__row group">
					<div class="section__column section__column--six">
						<h3 class="section__heading section__heading--three">Include jQuery and setGetParams</h3>
						<div class="section__code"><code class="code">
								<p>&lt;script src="jquery.min.js"&gt;&lt;/script&gt;</p>
								<p>&lt;script src="jquery-set-get-params.min.js"&gt;&lt;/script&gt;</p></code></div>
					</div>
					<div class="section__column section__column--six">
						<h3 class="section__heading section__heading--three">Bind plugin on event</h3>
						<div class="section__code"><code class="code">
								<p>$(el).click(function() {</p>
								<p>&nbsp;&nbsp;$().setGetParams({</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;'param1': value1,</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;'param2': value2</p>
								<p>&nbsp;&nbsp;});</p>
								<p>});</p></code></div>
					</div>
				</div>
			</div>
		</section>
		<section class="section">
			<div class="section__container">
				<div class="section__content">
					<h2 class="section__heading">Examples</h2>
				</div>
				<div class="section__row group">
					<div class="section__column section__column--six">
						<h3 class="section__heading section__heading--three">Pagination</h3>
						<div class="section__code"><code class="code">
								<p>&lt;nav class="pagination"&gt;</p>
								<p>&nbsp;&nbsp;&lt;ul class="pagination__list"&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;li class="pagination__item"&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="pagination__link" href="#" data-page='1'&gt;1&lt;/a&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;/li&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;li class="pagination__item"&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="pagination__link" href="#" data-page='2'&gt;2&lt;/a&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;/li&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;li class="pagination__item"&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="pagination__link" href="#" data-page='3'&gt;3&lt;/a&gt;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&lt;/li&gt;</p>
								<p>&nbsp;&nbsp;&lt;/ul&gt;</p>
								<p>&lt;/nav&gt;</p>
								<p>&nbsp;</p>
								<p>&lt;script&gt;</p>
								<p>&nbsp;&nbsp;$('.pagination__link').click(function() {</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;var page = $(this).data('page');</p>
								<p>&nbsp;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;$().setGetParams({</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'page': page</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;});</p>
								<p>&nbsp;&nbsp;});</p>
								<p>&lt;/script&gt;</p></code></div>
					</div>
					<div class="section__column section__column--six">
						<h3 class="section__heading section__heading--three">Sorting</h3>
						<div class="section__code"><code class="code">
								<p>&lt;select name="sorting"&gt;</p>
								<p>&nbsp;&nbsp;&lt;option value="id|desc"&gt;Featured&lt;/option&gt;</p>
								<p>&nbsp;&nbsp;&lt;option value="price|asc"&gt;Price: Low to High&lt;/option&gt;</p>
								<p>&nbsp;&nbsp;&lt;option value="price|desc"&gt;Price: High to Low&lt;/option&gt;</p>
								<p>&lt;/select&gt;</p>
								<p>&nbsp;</p>
								<p>&lt;script&gt;</p>
								<p>&nbsp;&nbsp;$('select[name=sorting]').change(function() {</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;var sort = $(@).val();</p>
								<p>&nbsp;</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;$().setGetParams({</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'sort': sort</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'page': 1</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;});</p>
								<p>&nbsp;&nbsp;});</p>
								<p>&lt;/script&gt;</p></code></div>
					</div>
				</div>
			</div>
		</section>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="assets/scripts/jquery-set-get-params.js"></script>
		<script src="assets/scripts/app.js"></script>
	</body>
</html>
