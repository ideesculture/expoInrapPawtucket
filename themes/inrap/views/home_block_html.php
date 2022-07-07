<?php
$article = $this->getVar("article");
$id = $this->getVar("id");
$article["blocs"]=str_replace('\\\n',"",$article["blocs"]);
$blocs=json_decode($article["blocs"],true);
//var_dump($blocs);die();
$content= $blocs[1]["content"];

$content=strip_tags(mb_substr($content,0,119));
if(mb_strlen($content)==119) {
    $content=$content."...";
}
$date = explode(" ", $article["date"]);
?>
<div class="col-xs-6 col-sm-6 col-md-3 actualites" id="actualite<?php print $id; ?>">
	<div class="div_actu">
		<span class="day"><?php _p($date[0]); ?></span>
		<div class="rest-day">
			<div class="month"><?php _p($date[1]); ?></div>
			<div class="time"><?php _p($date[3]); ?></div>
		</div>
	</div>
	<div class="type" style="margin-top: -5px;"><?php _p($article["categorie"]); ?></div>
	<h3 class="h3_actu">
		<a style="color:#a6515d;"href="/index.php/Articles/Show/Details/id/<?php _p($id); ?>" class="card-footer-item"><?php _p($article["title"]); ?></a>
	</h3>
	<div class="content">
		<p class="textContentActualites"><?php _p($content); ?></p>
	</div>
</div>

