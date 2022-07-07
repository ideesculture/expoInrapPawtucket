<?php
$article = $this->getVar("article");
$id = $this->getVar("id");
$article["blocs"]=str_replace('\\\n',"",$article["blocs"]);
$article["blocs"]=str_replace('\\\\"',"'",$article["blocs"]);

//extract blocs from json inside articles->blocs
$blocs=json_decode($article["blocs"],true);


//var_dump($blocs);die();
$content= $blocs[1]["content"];
$date = explode(" ", $article["date"]);



$categorie_bloc = $article["categorie"];
$categorie_class = str_replace(' ', '',$categorie_bloc);
?>
<div class="col-md-12 article_all <?php _p($categorie_class);?>" id="<?php _p($id);?>">
	<div class="div_actu <?php _p($categorie_class);?>">
		<span class="day"><?php _p($date[0]); ?></span>
		<div class="rest-day <?php _p($categorie_class);?>">
			<div class="month <?php _p($categorie_class);?>"><?php _p($date[1]); ?></div>
			<div class="time <?php _p($categorie_class);?>"><?php _p($date[3]); ?></div>
		</div>
	</div>
	<div class="<?php _p($categorie_class);?>" style="margin-top: -5px;"><?php _p($article["categorie"]); ?></div>
	<h3 class="h3_actu">
		<a style="color:#a6515d;" class="card-footer-item"><?php _p($article["title"]); ?></a>
	</h3>
	<div class="content <?php _p($categorie_class);?>">
		<div class="article <?php _p($categorie_class);?>">
			<?php
            

            foreach ($blocs as $bloc):
            	$bloc["content"] = str_replace("\\n", "", $bloc["content"]);
                switch ($bloc["type"]):
                    case "paragraph": ?>

						<div class="row <?php _p($categorie_class);?>">
							<div class="col-md-8 <?php _p($categorie_class);?>">
                            <?php print $bloc["content"]; ?>
							</div>
                        </div>

                        <?php break;
                    case "diapo-intermediaire": ?>

                        <div class="row <?php _p($categorie_class);?>">
                            <div class="col-md-8 <?php _p($categorie_class);?>">
                                <?php print $bloc["content"]; ?>
                            </div>
                        </div>

                        <?php break;
                        case "large-image":
                        ?>

						<div class="row <?php _p($categorie_class);?>">
							<div class="col-md-8 <?php _p($categorie_class);?>">
                            <img src="<?php print $bloc["image"]; ?>" alt="Image 2 fullwidth">
                            <figcaption><?php print $bloc["figcaption"]; ?></figcaption>
							</div>
                        </div>

                        <?php break;
                    case "two-images":
                        ?>

                        <div class="row <?php _p($categorie_class);?>">
                            <div class="col-md-3 <?php _p($categorie_class);?>">
                                <img src="<?php print $bloc["image1"]; ?>" alt="Image 3">
                                <figcaption><?php print $bloc["figcaption1"]; ?></figcaption>
                            </div>
                            <div class="col-md-3 <?php _p($categorie_class);?>">
                                <img src="<?php print $bloc["image2"]; ?>" alt="Image 4">
                                <figcaption><?php print $bloc["figcaption2"]; ?></figcaption>
                            </div>
                        </div>

                        <?php break;
                    case "image-with-text":
                        ?>


                        <div class="row <?php _p($categorie_class);?>">
                            <div class="col-md-2 <?php _p($categorie_class);?>">
                                    <img src="<?php print $bloc["image"]; ?>" alt="image 5">
                                </div>
                            <div class="col-md-10 <?php _p($categorie_class);?>">
                                <?php print str_replace("&quo;", '"', $bloc["content"]); ?>
                            </div>
                        </div>

                        <?php break;
                    case "text-with-image":
                        ?>


                        <div class="row <?php _p($categorie_class);?>">
	                        <div class="col-md-2 <?php _p($categorie_class);?>">
                            	<img src="<?php print $bloc["image"]; ?>" alt="image 5">
                            </div>
                            <div class="col-md-10 <?php _p($categorie_class);?>">
                                <?php print str_replace("&quo;", '"', $bloc["content"]); ?>
                            </div>
                        </div>

                        <?php break;	                        
                    case "references":
                        print "<div class=\"article-content footnotes\">";
                        if ($bloc["footnote1"]) print "<h4>Références</h4><ol>";
                        if ($bloc["footnote1"]) print "<li id=\"footnote1\">{$bloc["footnote1"]}</li>";
                        if ($bloc["footnote2"]) print "<li id=\"footnote1\">{$bloc["footnote2"]}</li>";
                        if ($bloc["footnote3"]) print "<li id=\"footnote1\">{$bloc["footnote3"]}</li>";
                        if ($bloc["footnote4"]) print "<li id=\"footnote1\">{$bloc["footnote4"]}</li>";
                        if ($bloc["footnote5"]) print "<li id=\"footnote1\">{$bloc["footnote5"]}</li>";
                        if ($bloc["footnote6"]) print "<li id=\"footnote1\">{$bloc["footnote6"]}</li>";
						if ($bloc["footnote1"]) print "</ol>";
                        print "<h4>Pour en savoir plus</h4>";
                        print $bloc["content"];
                        print "</div>";
                        break;
                    default:
                        //print "<div style='border:1px solid black; padding:50px;margin:20px 0;>Type JSON inconnu : {$bloc["type"]}</div>";

                        break;
                endswitch;
            endforeach; ?>
		</div>
	</div>
</div>
<style>
	.article_all {
		border: 1px #eeeeee solid;
		padding: 20px;
		margin-bottom: 10px;
	}
</style>