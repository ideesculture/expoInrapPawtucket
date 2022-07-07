<?php
$article = $this->getVar("article");
$article["blocs"] = str_replace("\\\\", "\\", $article["blocs"]);
$vb_multi = false;
$locale = "fr_FR";
$blocs = json_decode($article["blocs"], true);
//var_dump($blocs);die();

if ($blocs["language"] && is_array($blocs["language"])) {
    $vb_multi = true;
    $t_locale = caGetUserLocaleRules();
    $locale = reset(array_keys($t_locale["preferred"]));
    if (!in_array($locale, $article["blocs"]["language"])) {
        $locale = "fr_FR";
    }
    unset($blocs["language"]);
}

require_once(__CA_MODELS_DIR__ . "/ca_sets.php");
require_once(__CA_MODELS_DIR__ . "/ca_set_items.php");
require_once(__CA_MODELS_DIR__ . "/ca_objects.php");
?>
</div>
</div>
</div>
</div>
<div class="container article-title" style="">
    <div class="row" style="">
        <div class="col-md-12 mt-3">
            <h1 onClick="reveal(1)" class="text-left mb-3 ml-3 titre_template_page" style="color:white;cursor:pointer;font-size: 22px;">EXPOSITION : <?php _p($article["title"]); ?> <span class="visiter" onClick="visiter()">VISITER <span class="button">▶</span></span></h1>
        </div>
    </div>
</div>

<div class="article">
    <?php
    $blocs = json_decode($article["blocs"], true);
    $blocs = $blocs["blocks"];  
    unset($blocs["language"]);
    $count = 0;

    //var_dump($blocs);die();

    foreach ($blocs as $index => $bloc) :
        $bloc["content"] = str_replace("\\n", "", $bloc["content"]);
        $data = $bloc["data"];
        $color = (strpos($data["color"], "#") === false) ? "#".$data["color"] : $data["color"];
        //var_dump($blocs);die();
        switch ($bloc["type"]):
            case "diapoTitre": ?>
                
                <div id="diapo-<?= $count ?>" class="diapo container">
                    <div class="row first" style="background-color:<?= $color ?>;color:white;margin:0 auto;">
                        <div class="col-md-6 col-sm-12 col-lg-6 leftcol">
                            <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6 rightcol" style="padding:20px 30px;">
                            <h2><?php if (!$vb_multi || !is_array($data["title"])) {
                                    _p($data["title"]);
                                } else {
                                    _p($data["title"][$locale]);
                                } ?></h2>
                            <h3><?php if (!$vb_multi || !is_array($data["subtitle"])) {
                                    _p($data["subtitle"]);
                                } else {
                                    _p($data["subtitle"][$locale]);
                                } ?></h3>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-sm-6">
                            <h3 style="padding:0;margin:0;color:<?= $color ?>"><?php if (!$vb_multi || !is_array($data["title"])) {
                                                                                    _p($data["title"]);
                                                                                } else {
                                                                                    _p($data["title"][$locale]);
                                                                                } ?></h3>
                            <h4 style="padding:0;margin:0;color:gray"><?php if (!$vb_multi || !is_array($data["subtitle"])) {
                                                                            _p($data["subtitle"]);
                                                                        } else {
                                                                            _p($data["subtitle"][$locale]);
                                                                        } ?></h4>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:0 30px 40px 30px;background-color:#fff4d5">
                        <div class="col-sm-12 columns2" style="">
                            <?php if (!$vb_multi && !is_array($data["text"])) {
                                _p($data["text"]);
                            } else {
                                _p($data["text"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12">
                        <?php if (!$vb_multi && !is_array($data["illustration"])) {
                                _p($data["illustration"]);
                            } else {
                                _p($data["illustration"][$locale]);
                            } ?>
                        </div>
                    </div>
                    <?php
                        // GENERATION TABLEAU ANIM - GM 07/06 //
                        if($blocs[$index+1]["type"]=="animationDiapo") {
                            $data_anim = $blocs[$index+1]["data"];
                            $i=0;
                            $headers=[];
                            $data = [];
                            foreach($data_anim["content"] as $row) {
                                if(!$i) {
                                    foreach($row as $index=>$col) {
                                        $headers[$index]=$col;
                                    }
                                } else {
                                    $data[$i] = [];
                                    foreach($row as $index=>$col) {
                                        $data[$i][$headers[$index]]=$col;
                                    }
                                }
                                $i++;
                            }
                            
                            print "<!--\n\n";
                            var_dump($data);
                            print " -->\n\n";
                            // GENERATION TABLEAU ANIM - GM 07/06 //
                        }
                    ?>    
                </div>
                <style>
                    #diapo-titre-<?= $index ?>b {
                        color: <?= $color ?>;
                    }
                </style>
            <?php break;
            case "diapoInter": ?>
                <div id="diapo-<?= $count ?>" class="diapo container">
                    <div class="row first" style="background-color:<?= $data["color"] ?>;color:white;margin:0 auto;">
                        <div class="col-sm-6 leftcol">
                            <?php if ($data["url"]) : ?>
                                <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                            <?php else : ?>
                                <div style="height:200px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 rightcol" style="text-align: right;padding:20px 30px;">
                            <h2><?php if (!$vb_multi || !is_array($data["title"])) {
                                    _p($data["title"]);
                                } else {
                                    _p($data["title"][$locale]);
                                } ?></h2>
                            <h3><?php if (!$vb_multi && !is_array($data["subtitle"])) {
                                    _p($data["subtitle"]);
                                } else {
                                    _p($data["subtitle"][$locale]);
                                } ?></h3>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-sm-5 col-sm-offset-1">
                            <h3 style="padding:0;margin:0;color:<?= $color ?>"><?php _p($data["title"]); ?></h3>
                            <h4 style="padding:0;margin:0;color:gray"><?php _p($data["subtitle"]); ?></h4>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:0 30px 40px 30px;background-color:#fff4d5">
                        <div class="col-sm-10 col-sm-offset-1 columns2">
                            <?php if (!$vb_multi || !is_array($data["text"])) {
                                _p($data["text"]);
                            } else {
                                _p($data["text"][$locale]);
                            } ?>
                        </div>
                    </div>
                    <?php
                        // GENERATION TABLEAU ANIM - GM 07/06 //
                        if($blocs[$index+1]["type"]=="animationDiapo") {
                            $data_anim = $blocs[$index+1]["data"];
                            $i=0;
                            $headers=[];
                            $data = [];
                            foreach($data_anim["content"] as $row) {
                                if(!$i) {
                                    foreach($row as $index=>$col) {
                                        $headers[$index]=$col;
                                    }
                                } else {
                                    $data[$i] = [];
                                    foreach($row as $index=>$col) {
                                        $data[$i][$headers[$index]]=$col;
                                    }
                                }
                                $i++;
                            }
                            
                            print "<!--\n\n";
                            var_dump($data);
                            print " -->\n\n";
                            // GENERATION TABLEAU ANIM - GM 07/06 //
                        }
                    ?>    
                </div>
                <style>
                    #diapo-titre-<?= $index ?>b {
                        color: <?= $color ?>;
                    }
                </style>
            <?php break;
            case "objectset":
                $set = new ca_sets($data["setId"]);
                $ids = $set->getItemIDs();
                foreach ($ids as $index => $id) {
                    $item = new ca_set_items($index);
                    $object = $item->getItemInstance();
                    $object_id = $object->get("ca_objects.object_id");
                    $object = new ca_objects($object_id);
                    $representation_id = $object->get("ca_object_representations.representation_id");
                    print $object->getWithTemplate('
                                <div id="diapo-' . $count . '" class="diapo container">
                                <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                        <a href="#" class="zoomButton" onclick="caMediaPanel.showPanel(\'/index.php/Detail/GetMediaOverlay/context/objects/id/' . $object_id . '/representation_id/' . $representation_id . '/overlay/1\'); return false;">
                                            <img src="^ca_object_representations.media.page.url" />
                                        </a>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1 objecttext">
                                        <p>(' . $count . '/<span class="total"> </span>)</p>
                                        <h3>^ca_objects.preferred_labels</h3>
                                        <p>^ca_objects.inrap_musee_chrono</p>
                                        <p>^ca_objects.description</p>
                                        <ifdef code="ca_objects.inrap_type_struct_archeo">
                                            <h4>Contexte archéologique</h4>
                                            <div class="inrap_type_struct_archeo">^ca_objects.inrap_type_struct_archeo</div>
                                        </ifdef>
                                        <p><a href="/index.php/Detail/objects/' . $object_id . '">Où voir cet objet ?</a></p>
                                    </div>
                                </div>
                                </div>
                                ');
                    $count++;
                }
                // Debug : we have 1 too much, shame...
                $count--;
            ?>
            <?php break;
            case "diapo-objet":
                //die("here");
            ?>
                <div id="diapo-<?php print $count; ?>" class="diapo container unique">
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-md-12">
                            <?php
                            $object = new ca_objects($data["objectid"]);
                            $representation_id = $object->get("ca_object_representations.representation_id");
                            print $object->getWithTemplate('
		                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1">
		                                        <a href="#" class="zoomButton" onclick="caMediaPanel.showPanel(\'/index.php/Detail/GetMediaOverlay/context/objects/id/' . $object_id . '/representation_id/' . $representation_id . '/overlay/1\'); return false;">
		                                            <img src="^ca_object_representations.media.page.url" />
		                                        </a>
		                                    </div>
		                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1 objecttext">
		                                        <p>(' . $count . '/<span class="total"> </span>)</p>
		                                        <h3>^ca_objects.preferred_labels</h3>
		                                        <p>^ca_objects.inrap_musee_chrono</p>
		                                        <p>^ca_objects.description</p>
		                                        <ifdef code="ca_objects.inrap_type_struct_archeo">
		                                            <h4>Contexte archéologique</h4>
		                                            <div class="inrap_type_struct_archeo">^ca_objects.inrap_type_struct_archeo</div>
		                                        </ifdef>
		                                        <p><a href="/index.php/Detail/objects/' . $object_id . '">Où voir cet objet ?</a></p>
		                                </div>
		                                ');
                            ?>
                        </div>
                    </div>
                </div>
            <?php break;
            case "objectbam": ?>
            
                <div id="diapo-<?php print $count; ?>" class="diapo container unique">
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-md-12">
                            <?php
                            $object = new ca_objects($data["objectId"]);
                            $representation_id = $object->get("ca_object_representations.representation_id");
                            print $object->getWithTemplate('
		                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1">
		                                        <a href="#" class="zoomButton" onclick="caMediaPanel.showPanel(\'/index.php/Detail/GetMediaOverlay/context/objects/id/' . $object_id . '/representation_id/' . $representation_id . '/overlay/1\'); return false;">
		                                            <img src="^ca_object_representations.media.page.url" />
		                                        </a>
		                                    </div>
		                                    <div class="col-md-5 col-md-offset-1 col-sm-10 col-sm-offset-1 objecttext">
		                                        <p>(' . $count . '/<span class="total"> </span>)</p>
		                                        <h3>^ca_objects.type_mobilier</h3>
		                                        <p>^ca_objects.inrap_musee_chrono</p>
		                                        <p>^ca_objects.description</p>

			<ifdef code="ca_places"><h4>Commune de découverte</h4></ifdef>
			<unit relativeTo="ca_objects_x_places" delimiter="<br/>"><unit relativeTo="ca_places"><l>^ca_places.preferred_labels</l></unit></unit>
			<ifdef code="ca_objects.lieudit"><h4>Lieu-dit</h4><span class="trimText">^ca_objects.lieudit</span></ifdef>


			<ifdef code="ca_objects.inrap_type_inter"><h4>Type d\'intervention</h4></ifdef>
			<ifdef code="ca_objects.inrap_type_inter"><span class="trimText">^ca_objects.inrap_type_inter</span></ifdef>          		

			<ifdef code="ca_objects.date_fouille"><h4>Année de fouille</h4></ifdef>
			<ifdef code="ca_objects.date_fouille"><span class="trimText">^ca_objects.date_fouille</span></ifdef>          		

			<ifdef code="ca_entities" restrictToRelationshipTypes="responsable"><h4>Responsable scientifique</h4></ifdef>
			<unit relativeTo="ca_entities" restrictToRelationshipTypes="responsable" delimiter=" ; " ><span class="trimText">^ca_entities.preferred_labels</span></unit>          

			<ifdef code="ca_objects.idno"><h4>Numéro d"inventaire</h4></ifdef>
			<ifdef code="ca_objects.idno">
			^ca_objects.idno
			</ifdef>
			
			<ifdef code="ca_objects.inrap_domaine"><h4>Domaine</h4></ifdef>
			<unit relativeTo="ca_objects.inrap_domaine" delimiter="<br />">^ca_objects.inrap_domaine%delimiter=_➜_</unit>

			<ifdef code="ca_objects.inrap_musee_materiaux"><h4>Matériaux</h4></ifdef> 
			<ifdef code="ca_objects.hierarchy.inrap_musee_materiaux" delimiter="<br/>"><span class="trimText">^ca_objects.inrap_musee_materiaux </span></ifdef>

			<unit relativeTo="ca_list_items" restrictToRelationshipTypes="described"><h4>Datation de l"objet</h4></unit>
			<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="➔"><unit relativeTo="ca_list_items" restrictToRelationshipTypes="described"><span>^ca_list_items.hierarchy.preferred_labels.name_plural</span></unit></unit>

			<unit relativeTo="ca_list_items" restrictToRelationshipTypes="domaines_objets"><h4>Domaine</h4></unit>
			<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="➔"><unit relativeTo="ca_list_items" restrictToRelationshipTypes="domaines_objets" delimiter=" "><span>^ca_list_items.hierarchy.preferred_labels.name_plural</span></unit></unit>

			<unit relativeTo="ca_list_items" restrictToRelationshipTypes="depicts"><h4>Matériaux</h4></unit>
			<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="➔"><unit relativeTo="ca_list_items" restrictToRelationshipTypes="depicts"><span>^ca_list_items.hierarchy.preferred_labels.name_plural</span></unit></unit>


			<ifdef code="ca_objects.dimensions"><h4>Dimensions</h4></ifdef>
			<ifdef code="ca_objects.dimensions.dimensions_height">H. ^ca_objects.dimensions.dimensions_height, </ifdef><ifdef code="ca_objects.dimensions.dimensions_depth">L. ^ca_objects.dimensions.dimensions_depth, </ifdef><ifdef code="ca_objects.dimensions.dimensions_width">l. ^ca_objects.dimensions.dimensions_width, </ifdef><ifdef code="ca_objects.dimensions.dimension_epaisseur">P. ^ca_objects.dimensions.dimension_epaisseur</ifdef><ifdef code="ca_objects.dimensions.circumference">, d. ^ca_objects.dimensions.circumference </ifdef>


			<ifdef code="ca_objects.bibliographie"><h4>Bibliographie</h4></ifdef> 
			<unit relativeTo="ca_objects.bibliographie">
			<span class="">^ca_objects.bibliographie</span>
			</unit> 
		                                        
		                                    </div>
		                                ');
                                        ?>
                        </div>
                    </div>
                </div>
    <?php break;

            default:
                //print "<div style='border:1px solid black; padding:50px;margin:20px 0;>Type JSON inconnu : {$data["type"]}</div>";

                break;
        endswitch;

        $count++;

    endforeach;
    ?>
</div>
<div class="scroll container" style="background-color: white;">
    <?php
    $count = 0;
    foreach ($blocs as $index => $bloc) :
        $bloc["content"] = str_replace("\\n", "", $bloc["content"]);
        $data = $bloc["data"];
        $color = (strpos($data["color"], "#") === false) ? "#".$data["color"] : $data["color"];
        switch ($bloc["type"]):
            case "diapoTitre": ?>
                <span style="width: 100px;height:100px;display: inline-block;
                        background-image:url('<?php _p($data["url"]); ?>');
                        background-color: <?= $color ?>;
                        background-position:center center;
                        background-size:cover;" onClick="reveal(<?= $count ?>);">&nbsp;
                </span>

            <?php
                $count++;
                break;
            case "diapoInter    ": ?>
                <span style="width: 100px;height:100px;display: inline-block;
                    background-image:url('<?php _p($data["url"]); ?>');
                    background-color:  <?= $color ?>;
                    background-position:center center;
                    background-size:cover;" onClick="reveal(<?= $count ?>);">&nbsp;
                </span>
            <?php
                $count++;
                break;
            case "objectset":
                $set = new ca_sets($data["setId"]);
                $ids = $set->getItemIDs();
                foreach ($ids as $index => $id) {
                    $item = new ca_set_items($index);
                    $object = $item->getItemInstance();
                    $object_id = $object->get("ca_objects.object_id");
                    $object = new ca_objects($object_id);
                    $url = $object->getWithTemplate("^ca_object_representations.media.page.url");
                    print '
                    <span style="width: 100px;height:100px;display: inline-block;
                        background-image:url(' . $url . ');
                        background-position:center center;
                        background-size:cover;"
                    onClick="reveal(' . $count . ');" 
                    >&nbsp;
                    </span>
                    ';
                    $count++;
                }
            ?>
            <?php break;
            case "diapo-objet":
                if (!$color) $color = "#fff4d5";
                $object_id = $data["objectid"];
                $object = new ca_objects($object_id);
                $url = $object->getWithTemplate("^ca_object_representations.media.page.url");
            ?>
                <span style="width: 100px;height:100px;display: inline-block;
                    background-image:url('<?php _p($url); ?>');
                    background-color:  <?= $color ?>;
                    background-position:center center;
                    background-size:cover;" onClick="reveal(<?= $count ?>);">&nbsp;
                </span>

            <?php
                $count++;
                break;
            case "objectbam":
                if (!$color) $color = "#fff4d5";
                $object_id = $bloc["objectId"];
                $object = new ca_objects($object_id);
                $url = $object->getWithTemplate("^ca_object_representations.media.page.url");
            ?>
                <span style="width: 100px;height:100px;display: inline-block;
                    background-image:url('<?php _p($url); ?>');
                    background-color:  <?= $color ?>;
                    background-position:center center;
                    background-size:cover;" onClick="reveal(<?= $count ?>);">&nbsp;
                </span>
    <?php
                $count++;
                break;
            default:
                //print "<div style='border:1px solid black; padding:50px;margin:20px 0;>Type JSON inconnu : {$bloc["type"]}</div>";
                $count++;

                break;
        endswitch;
    endforeach;
    $count--;
    ?>
</div>
<script>
    $(".total").text(<?= $count ?>);
</script>
<div class="expo-arrow-left" style="position:absolute;top:340px;left:25px;">
    <img src="/arrow-right.svg" style="width:25px;height:28px;" />
</div>
<div class="expo-arrow-right" style="position:absolute;top:340px;right:0;">
    <img src="/arrow-right.svg" style="width:25px;height:28px;" />
</div>
<div class="container">
    <div style="margin-bottom: 40px;background-color: white;"></div>
</div>
</div>
<link href="https://fonts.googleapis.com/css2?family=Gidugu&display=swap" rel="stylesheet">
<style>
    figcaption {
        color: #999;
        font-style: italic;
    }

    .article {}

    .article div {
        white-space: normal;
    }

    .diapo {
        background-color: #fff4d5;
        display: none;
        padding-left: 0;
        padding-right: 0;
    }

    #diapo-1 {
        display: block;
    }

    .article .row {
        margin-top: 14px;
        margin-bottom: 34px;
    }

    .article .rightcol h3 {
        color: white;
        text-transform: none;
        font-family: 'Gidugu', sans-serif;
        line-height: 0.75em;
        letter-spacing: normal;
        font-weight: normal;
        font-style: italic;
        font-size: 26px;
    }

    .article .rightcol {
        text-align: right;
    }

    .article .rightcol h2 {
        margin-top: 140px;
        color: white;
        text-transform: none;
        font-family: 'Gidugu', sans-serif;
        font-size: 60px;
        line-height: 0.75em;
        letter-spacing: normal;
        font-weight: normal;
    }

    .columns2 {
        columns: 2;
        column-gap: 40px;
    }

    @media screen and (max-width: 992px) {
        .article .rightcol {
            text-align: left;
        }

        .article .rightcol h2 {
            margin-top: 20px;
        }

        .article .rightcol br {
            display: none;

        }

        .article .leftcol {
            text-align: center;
        }

        .columns2 {
            columns: auto;
        }
    }

    .article .objecttext h4 {
        text-transform: uppercase;
    }

    .article .content h3 {
        text-transform: none;
    }

    .article .content .inrap_type_struct_archeo {
        font-family: 'Calibri Light', sans-serif;
    }

    p>a {
        text-decoration: underline;
    }

    #nouveaute_actualites_link_id {
        color: rgba(255, 255, 255, 1);
    }

    .article {
        background-color: white;
    }

    .expo-arrow-right img {
        width: 25px;
        margin-right: 25px;
        background-color: #efefef;
        padding: 4px 2px 3px 2px;
        border-radius: 4px;
    }

    .expo-arrow-left img {
        transform: rotate(180deg);
        width: 25px;
        background-color: #efefef;
        padding: 4px 2px 3px 2px;
        border-radius: 4px;
    }

    .scroll {
        position: relative;
        white-space: nowrap;
        overflow-x: scroll;
        padding: 10px 20px;
    }

    .article .objecttext h4 {
        padding-bottom: 0;
        padding-top: 10px;
    }
    .visiter {
        background-color:white;
        padding:2px 6px;
        border-radius:6px;
        color:#C0392B;
        font-size:14px;
        height:22px;
        line-height: 16px;
        display: inline-block;
        margin-left:12px;
    }
    .visiter .button {
        font-size:12px;
    }
    body.fullscreen {
        background-color:#C0392B;;
    }
    .container.article-title {
        margin-top:80px !important;
        background:#C0392B;
        color:white;
    }
    .fullscreen.container.article-title {
        margin-top:0 !important;
    }
    body.fullscreen {
        background:#C0392B;
    }
    body.fullscreen .diapo {
        height:calc(100vh - 66px);
        background:#fff4d5;
    }
    body.fullscreen .diapo .first {
        height:calc(50vh - 66px);
    }
    .article.fullscreen .row {
        max-width: none;
    }
    body.fullscreen footer {
        display:none;
    }
    body.fullscreen .scroll {
        display:none;
    }

</style>
<script>
    var current = 1;
    var max = <?= $count ?>;
    $(document).ready(function() {
        $("#diapo-1").hide();
        $("#diapo-0").show();
        $(".expo-arrow-left").on("click", function() {
            if (current > 1) {
                $('.diapo').hide();
                current--;
                $('#diapo-' + current).show();
                console.log("right");
            }
        });
        $(".expo-arrow-right").on("click", function() {
            if (current < max) {
                $('.diapo').hide();
                current++;
                $('#diapo-' + current).show();
                console.log("left");
            }

        });
    });

    function reveal(id) {
        $('.diapo').hide();
        current = id;
        $('#diapo-' + current).show();
    }

    function visiter() {
        $('.article-title').addClass("fullscreen");
        $('.article').addClass("fullscreen");
        $('body').addClass("fullscreen");
        $('.visiter').hide();
        $('header').hide();
        setTimeout(function() {
            $('#diapo-0').show();
        }, 50);
    }
</script>