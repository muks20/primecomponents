<body class="cms-index-index">
<div class="page">
	<!-- Header -->
	<header class="header-container">
		<div class="header container">
			<div class="row align-items-center justify-content-between">
					<div class="col-lg-4 col-md-6">
						<!-- Header Logo -->
						<a class="logo" title="Prime Components" href="<?= SITEURL ?>">
							<img alt="Prime Components" src="<?=SITEURL?>images/logo.png" class="img-fluid">
						</a>
						<!-- End Header Logo -->
					</div>
					<div class="col-lg-4 col-md-6">
						<!-- Search-col -->
						<div class="row">
							<div class="search-box col d-flex justify-content-end">
								<form action="<?=SITEURL?>search" method="post" id="search_mini_form" name="Categories">
									<div class="input-group">
		                                <input type="text" class="form-control w-100" placeholder="Search entire store here..." value="" maxlength="70" name="search" id="search">
		                                <span class="input-group-btn">
		                                    <button id="search-submit" type="submit" class="btn round btn-primary search-btn-bg " type="button">Search</button>
		                                </span>
		                            </div>
								</form>
							</div>
						</div>
						<!-- End Search-col -->
					</div>
			</div>
		</div>
	</header>
	<!-- end header -->
	<?php include("include/menu.php"); ?>
		<?php  /* if($pageName=="index.php")
		{ 
			include("include/slider.php");
		}
		else
		{ ?>
		<?php }*/
	?>