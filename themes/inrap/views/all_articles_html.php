<?php
$blocks = $this->getVar("blocks");
$categories = $this->getVar("categories");
?>
<div class="container">
	<div class="row" style="">
		<ol class="breadcrumb">
			<li><a href="/" target="" title="Accueil">Accueil</a></li>
			<li>Nouveautés &amp; actualités</li>
		</ol>
		<div class="col-md-12 mt-3">
			<h1 class="text-left mb-3 ml-3 titre_template_page">Nouveautés &amp; actualités</h1>
			<h3 class="text-left ml-3"></h3>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8" id="elements"><?php print $blocks; ?>
		</div>
		<div class="col-md-2" id="filtres">
			<h3>Filtrer par catégorie d'article</h3>
			<li class="filter active" data-filter="all"><p><a style="cursor:pointer">Tout</a></p></li>
			<?php  
		        foreach ($categories as $categorie) :
		        $categorie_filtre = str_replace(' ', '', $categorie);
		        echo "<li class='filter' data-filter='".$categorie_filtre."'><p><a style='cursor:pointer'>".$categorie."</a></p></li>";
		        endforeach;
			?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#filtres li').click(function(){
			// on recupère la valeur du filtre
			value = $(this).data('filter');
			// on enlève la classe active de l'ancien élément
			$('#filtres li').removeClass('active'),
			// on ajoute la classe active sur l'élément cliqué
			$(this).addClass('active');
		 
			// pour chaque div
			
			$('#elements div').each(function(){
				el = $(this);
				// on montre tout
				el.show();
				// on teste si l'élément n'a pas la classe du filtre ou que l'utilisateur ne souhaite pas tout affiché
				if(!el.hasClass(value) && value != "all" )
					el.hide();
			});
		}); 
		
	});
</script>
<style>
	li {
	  list-style-type: none;
	}
	#filtres {
		border: 1px #eeeeee solid;
		padding: 20px;
	}
	p > a {
	box-sizing: border-box;
    color: #4d4d4d;
    text-decoration: underline;
    overflow-wrap: break-word;
   	}
   	#nouveaute_actualites_link_id{
   		color: rgba(255,255,255,1);
	}
</style>