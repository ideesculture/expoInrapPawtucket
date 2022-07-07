<?php
$blocks = $this->getVar("blocks");
?>
<section class="actualites-slider">
	<div class="container actu_container">
		<div class="row row-title">
			<div class="col-xs-6 col-sm-4" style="margin-bottom: 17px;">
				<!-- steven div class="col-xs-6 col-sm-4 col-md-4"-->
				<h2 class="titre_actualites">Actualités</h2>
			</div>
			<!--MODIFS RACHEL -->
			<div class="col-xs-6 col-sm-8 text-right titre_tte_actu">
				<!--FIN MODIFS RACHEL -->
				<!-- steven div class="col-xs-6 col-sm-8 text-right"-->
				<a href="/index.php/Articles/Show/All" class="h2-aligned" style="line-height: 0px;">Voir toutes les actualités
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
			<div class="col-xs-6 col-sm-8 text-right titre_tte_actu" id="seeMore">
				<a href="/index.php/Articles/Show/All" class="h2-aligned" style="line-height: 0px;">Voir plus
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
		<div class="row bloc-actualites">
			<?php print $blocks; ?>
		</div>
	</div>
</section>
<?php exit(); ?>