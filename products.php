<?php include( "include/header.php" ); ?>
<?php include( "include/body.php" ); ?>


<!-- Breadcrumbs -->

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<ul>
				<li class="home"><a title="Go to Home Page" href="<?= SITEURL ?>">Home</a><span>&raquo;</span></li>
				<li class="category13"><strong>Products</strong></li>
			</ul>
		</div>
	</div>
</div>
<!-- Two columns content -->
<div class="main-container col2-right-layout">
	<div class="main container">
		<div class="row">
			<section class="col-main col-sm-9 col-sm-push-3">


				<?php
					$dbh  = new PDO( $dsn, $username, $password );
					$sql1 = $dbh->prepare( "SELECT * FROM p_categories
                                               WHERE pc_active='Y' ORDER BY pc_order ASC " );
					$sql1->execute();
					$rows1 = $sql1->fetchAll();
					//print_r($rows) ;
					for ( $j = 0; $j < count( $rows1 ); $j ++ ) { ?>


						<div style="background: #ecf0f1 none repeat scroll 0 0;border-bottom: 3px solid #2d5290;border-radius: 3px 3px 0 0;color: #000;font-size: 16px;font-weight:normal;padding: 14px 15px;text-transform: uppercase;margin-bottom: 10px;"  >
							<span  style="font-size: 22px;font-style: italic;font-weight: 400;letter-spacing: 1px;padding: 0;" ><?= urldecode( $rows1[ $j ]['pc_title'] ) ?> </span>
						</div>




							<?php $dbh = new PDO( $dsn, $username, $password );
								$sql2  = $dbh->prepare( "SELECT * FROM p_subcategories WHERE pc_id='" . $rows1[ $j ]['pc_id'] . "' " );
								$sql2->execute();
								$rows2 = $sql2->fetchAll(); ?>

							<?php if ( count( $rows2 ) > 0 ) {
								for ( $k = 0; $k < count( $rows2 ); $k ++ ) { ?>

							<div class="category-products">

										<h1 style="background: #F0EFED none repeat scroll 0 0;
color: #333;
font-size: 22px;
font-style: italic;
font-weight: 400;
letter-spacing: 1px;
margin-bottom: 10px;
margin-top: 0;
padding: 10px 20px;"><?= urldecode( $rows2[ $k ]['psubc_title'] ) ?> </h1>



							<ul class="products-grid">

										<?php $dbh = new PDO( $dsn, $username, $password );
											$sql3  = $dbh->prepare( " SELECT * FROM products p LEFT JOIN
                                										p_categories pc ON p.p_pc_id = pc.pc_id
										                                LEFT JOIN
										                                p_subcategories psc ON p.psubc_id = psc.psubc_id
										                                WHERE
										                                p.p_active='Y' and pc.pc_active='Y' and
                                										psc.psubc_active ='Y' and p.p_pc_id='" . $rows1[ $j ]['pc_id'] . "'
                                										and p.psubc_id='" .  $rows2[ $k ]['psubc_id']. "'  " );
											$sql3->execute();
											$rows3 = $sql3->fetchAll();
										?>

										<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) { ?>

											<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">


												<div class="item">
													<div class="col-item">

														<div class="item-inner">
															<div class="product-wrapper">
																<div class="thumb-wrapper">
																	<a href="<?= SITEURL ?>product/<?= urldecode( $rows3[ $l ]['pc_alias'] ) ?>/<?= urldecode( $rows3[ $l ]['psubc_alias'] ) ?>/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?>" class="thumb flip">
																		<span class="face">
																			<?php

																				$image = getProductMainImg( urldecode( $rows3[ $l ]['p_id'] ), urldecode( $rows3[ $l ]['p_featured_img'] ));

																				if ( strlen( $image ) > 0 ) { ?>

																					<img

																						src="<?= SITEURL ?>images/products/medium/<?= urldecode( htmlspecialchars_decode( $image ) ) ?>"

																						alt=""  />

																				<?php } else { ?>

																					<img src="<?= SITEURL ?>images/no-image.jpg"

																					     alt="" style="max-height: 150px;max-width: 210px;"/>

																				<?php } ?>

																			<!--<img src="products-images/product1.jpg" alt="Sample Product">-->
																		</span>

																	</a>
																</div>
															</div>
															<div class="item-info">

																<div class="actions">

																	<a   href="<?= SITEURL ?>product/<?= urldecode( $rows3[ $l ]['pc_alias'] ) ?>/<?= urldecode( $rows3[ $l ]['psubc_alias'] ) ?>/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?> "  title="<?= urldecode( $rows3[ $l ]['p_title'] ) ?>">  <button class="button btn-clear" title="View Details" type="button"><span><?= urldecode( $rows3[ $l ]['p_title'] ) ?></span></button> </a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>



										<?php } ?>
									</ul>

							</div>

								<?php } ?>

							<?php } else {?>
							<!--for products with no sub-category-->

							<div class="category-products">

								<ul class="products-grid">

									<?php $dbh = new PDO( $dsn, $username, $password );
										$sql3  = $dbh->prepare( " SELECT * FROM products p LEFT JOIN
										p_categories pc ON p.p_pc_id = pc.pc_id
										WHERE
										p.p_active='Y' and pc.pc_active='Y' and
										p.p_pc_id='" . $rows1[ $j ]['pc_id'] . "' " );
										$sql3->execute();
										$rows3 = $sql3->fetchAll();
									?>

									<?php for ( $l = 0; $l < count( $rows3 ); $l ++ ) { ?>

										<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">


											<div class="item">
												<div class="col-item">

													<div class="item-inner">
														<div class="product-wrapper">
															<div class="thumb-wrapper">
																<a href="<?= SITEURL ?>product/<?= urldecode( $rows3[ $l ]['pc_alias'] ) ?>/all/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?>" class="thumb flip">
																		<span class="face">
																			<?php

																				$image = getProductMainImg( urldecode( $rows3[ $l ]['p_id'] ), urldecode( $rows3[ $l ]['p_featured_img'] ));

																				if ( strlen( $image ) > 0 ) { ?>

																					<img

																						src="<?= SITEURL ?>images/products/medium/<?= urldecode( htmlspecialchars_decode( $image ) ) ?>"

																						alt="" />

																				<?php } else { ?>

																					<img src="<?= SITEURL ?>images/no-image.jpg"

																					     alt="" style="max-height: 150px;max-width: 210px;"/>

																				<?php } ?>

																			<!--<img src="products-images/product1.jpg" alt="Sample Product">-->
																		</span>

																</a>
															</div>
														</div>
														<div class="item-info">

															<div class="actions">

																<a   href="<?= SITEURL ?>product/<?= urldecode( $rows3[ $l ]['pc_alias'] ) ?>/all/<?= urldecode( $rows3[ $l ]['p_alias'] ) ?> "  title="<?= urldecode( $rows3[ $l ]['p_title'] ) ?>">  <button class="button btn-clear" title="View Details" type="button"><span><?= urldecode( $rows3[ $l ]['p_title'] ) ?></span></button> </a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>



									<?php } ?>
								</ul>

							</div>



							<?php } ?>



						<?php } ?>


			</section>
			<aside class="col-right sidebar col-sm-3 col-xs-12 col-sm-pull-9">
				<?php include( "include/sidebar.php" ); ?>
			</aside>
		</div>
	</div>
</div>
<!-- End Two columns content -->


<!-- MAIN CONTENT -->


<?php include( "include/footer.php" ); ?>
