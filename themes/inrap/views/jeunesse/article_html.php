<?php
$article = $this->getVar("article");
$article["blocs"] = str_replace("\\\\", "\\", $article["blocs"]);
$vb_multi = false;
$locale = "fr_FR";
$blocs = json_decode($article["blocs"], true);

// Variable pour stocker le tableau des animations avec les entêtes
$data_anim_cleaned = [];

function computeAnimTable($blocs, $ind)
{
    // GENERATION TABLEAU ANIM - GM 07/06 //
    //var_dump($blocs[$ind + 1]);die();
    if ($blocs[$ind + 1]["type"] == "animationDiapo") {

        $data_anim[$ind] = $blocs[$ind + 1]["data"]["content"];
        $data_anim_temp_headers = [];
        $data_anim_temp = [];

        // Parcours des valeurs et des entêtes
        $i = 0;
        foreach ($data_anim[$ind] as $row) {

            if (!$i) {
                foreach ($row as $row_index => $col) {
                    $data_anim_temp_headers[$row_index] = $col;
                }
            } else {
                // $i - 1 => on doit retirer la ligne des headers pour démarrer à 0.
                $$data_anim_temp[$i - 1] = [];
                foreach ($row as $row_index => $col) {
                    $data_anim_temp[$i - 1][$data_anim_temp_headers[$row_index]] = $col;
                }
            }
            $i++;
        }
        return $data_anim_temp;
    } else {
        return false;
    }
}

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
            <h1 class="text-left mb-3 ml-3 titre_template_page" style="color:white;cursor:pointer;font-size: 22px;">EXPOSITION : <?php _p($article["title"]); ?> <span class="visiter" onClick="visiter()">VISITER <span class="button">▶</span></span><span class="retour" id="retour" onClick="retour()">RETOUR <span class="button">▶</span></span></h1>
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
        $color = (strpos($data["color"], "#") === false) ? "#" . $data["color"] : $data["color"];
        //var_dump($blocs);die();
        switch ($bloc["type"]):
            case "diapoTitre": ?>

                <div id="diapo-<?= $count ?>" class="diapo container diapoTitre">
                    <div class="row first" style="background-color:<?= $color ?>;color:white;margin:0 auto;position:relative;overflow:hidden; height:430px">
                        <div style="max-width:1200px; height:100%;margin:auto; position: relative" class="firstBis">
                            <div class="col-md-6 col-sm-12 col-lg-6 leftcol" style="padding-left:60px; text-align:center">
                                <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                            </div>
                        </div>
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
                        <div class="col-sm-12" style="margin-top: 1rem; font-size: 12px; font-style:italic">
                            <hr style="border:0.5px solid #999" />
                            <?php if (!$vb_multi && !is_array($data["illustration"])) {
                                if (!empty($data["illustration"])) (strpos($data["illustration"], "Illustration") === false) ? print "Illustration : " . $data["illustration"] : _p($data["illustration"]);
                            } else {
                                _p($data["illustration"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style=" font-size: 12px; font-style:italic">
                            <?php if (!$vb_multi && !is_array($data["legend"])) {
                                if (!empty($data["legend"])) (strpos($data["legend"], "©") === false) ? print "© " . $data["legend"] : _p($data["legend"]);
                            } else {
                                _p($data["legend"][$locale]);
                            } ?>
                        </div>
                    </div>
                    <?php
                    // GENERATION TABLEAU ANIM - GM 07/06 //
                    $result = computeAnimTable($blocs, $index);
                    if ($result) {
                        //var_dump($result);die();
                        $data_anim_cleaned[$count] = $result;
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
                <div id="diapo-<?= $count ?>" class="diapo container diapoInter">
                    <div class="row first" style="background-color:<?= $color ?>;color:white;margin:0 auto;position:relative;overflow:hidden;">
                        <div style="max-width:1200px; height:100%;margin:auto; position: relative" class="firstBis">
                        <div class="col-sm-6 leftcol" style="padding-left:60px; text-align:center">
                            <?php if ($data["url"]) : ?>
                                <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                            <?php else : ?>
                                <div style="height:200px;"></div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-sm-6">
                            <h3 style="padding:0;margin:0;color:<?= $color ?>"><?php _p($data["title"]); ?></h3>
                            <h4 style="padding:0;margin:0;color:gray"><?php _p($data["subtitle"]); ?></h4>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:0 30px 40px 30px;background-color:#fff4d5">
                        <div class="col-sm-12 columns2">
                            <?php if (!$vb_multi || !is_array($data["text"])) {
                                _p($data["text"]);
                            } else {
                                _p($data["text"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1rem; font-size: 12px; font-style:italic">
                            <hr style="border:0.5px solid #999" />
                            <?php if (!$vb_multi && !is_array($data["illustration"])) {
                                if (!empty($data["illustration"])) (strpos($data["illustration"], "Illustration") === false) ? print "Illustration : " . $data["illustration"] : _p($data["illustration"]);
                            } else {
                                _p($data["illustration"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style=" font-size: 12px; font-style:italic">
                            <?php if (!$vb_multi && !is_array($data["legend"])) {
                                if (!empty($data["legend"])) (strpos($data["legend"], "©") === false) ? print "© " . $data["legend"] : _p($data["legend"]);
                            } else {
                                _p($data["legend"][$locale]);
                            } ?>
                        </div>
                    </div>
                    <?php
                    // GENERATION TABLEAU ANIM - GM 07/06 //
                    $result = computeAnimTable($blocs, $index);
                    if ($result) {
                        $data_anim_cleaned[$count] = $result;
                    }
                    ?>
                </div>
                <style>
                    #diapo-titre-<?= $index ?>b {
                        color: <?= $color ?>;
                    }
                </style>
            <?php break;
            case "diapoInter2": ?>
                <div id="diapo-<?= $count ?>" class="diapo container diapoInter2">
                    <div class="row first" style="background-color:<?= $color ?>;color:white;margin:0 auto; padding-bottom: 15px;position:relative;overflow:hidden;">
                        <div style="max-width:1200px; height:100%;margin:auto; position: relative" class="firstBis">

                            <div class="col-sm-6 leftcol" style="text-align:center" ;>
                                <?php if ($data["url"]) : ?>
                                    <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                                <?php else : ?>
                                    <div style="height:200px;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 rightcol" style="text-align: center;">
                                <?php if ($data["url2"]) : ?>
                                    <img src="<?php _p($data["url2"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                                <?php else : ?>
                                    <div style="height:200px;"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-sm-6">
                            <h3 style="padding:0;margin:0;color:<?= $color ?>"><?php _p($data["title"]); ?></h3>
                            <h4 style="padding:0;margin:0;color:gray"><?php _p($data["subtitle"]); ?></h4>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:0 30px 40px 30px;background-color:#fff4d5">
                        <div class="col-sm-12 columns2">
                            <?php if (!$vb_multi || !is_array($data["text"])) {
                                _p($data["text"]);
                            } else {
                                _p($data["text"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1rem;font-size: 12px; font-style:italic">
                            <hr style="border:0.5px solid #999" />
                            <?php if (!$vb_multi && !is_array($data["illustration"])) {
                                if (!empty($data["illustration"])) (strpos($data["illustration"], "Illustration") === false) ? print "Illustration : " . $data["illustration"] : _p($data["illustration"]);
                            } else {
                                _p($data["illustration"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style=" font-size: 12px; font-style:italic">
                            <?php if (!$vb_multi && !is_array($data["legend"])) {
                                if (!empty($data["legend"])) (strpos($data["legend"], "©") === false) ? print "© " . $data["legend"] : _p($data["legend"]);
                            } else {
                                _p($data["legend"][$locale]);
                            } ?>
                        </div>
                    </div>
                    <?php
                    // GENERATION TABLEAU ANIM - GM 07/06 //
                    $result = computeAnimTable($blocs, $index);
                    if ($result) {
                        $data_anim_cleaned[$count] = $result;
                    }

                    ?>

                </div>
                <style>
                    #diapo-titre-<?= $index ?>b {
                        color: <?= $color ?>;
                    }
                </style>
            <?php break;

            case "diapofin": ?>
                <div id="diapo-<?= $count ?>" class="diapo container diapofin">
                    <div class="row first" style="background-color:<?= $color ?>;color:white;margin:0 auto; padding-bottom: 15px;position:relative;overflow:hidden;">
                        <div class="col-sm-6 leftcol" style="text-align:center" ;>
                            <?php if ($data["url"]) : ?>
                                <img src="<?php _p($data["url"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                            <?php else : ?>
                                <div style="height:200px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 rightcol" style="text-align: right;">
                            <?php if ($data["url2"]) : ?>
                                <img src="<?php _p($data["url2"]); ?>" style="height:400px;min-height:400px;width:auto;min-width: auto;max-width: none;" />
                            <?php else : ?>
                                <div style="height:200px;"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5">
                        <div class="col-sm-6">
                            <h3 style="padding:0;margin:0;color:<?= $color ?>"><?php _p($data["title"]); ?></h3>
                            <h4 style="padding:0;margin:0;color:gray"><?php _p($data["subtitle"]); ?></h4>
                        </div>
                    </div>
                    <div class="row content" style="margin:0 auto;padding:0 30px 40px 30px;background-color:#fff4d5">
                        <div class="col-sm-12 columns2">
                            <?php if (!$vb_multi || !is_array($data["text"])) {
                                _p($data["text"]);
                            } else {
                                _p($data["text"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style="margin-top: 1rem;font-size: 12px; font-style:italic">
                            <hr style="border:0.5px solid #999" />
                            <?php if (!$vb_multi && !is_array($data["illustration"])) {
                                if (!empty($data["illustration"])) (strpos($data["illustration"], "Illustration") === false) ? print "Illustration : " . $data["illustration"] : _p($data["illustration"]);
                            } else {
                                _p($data["illustration"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12" style=" font-size: 12px; font-style:italic">
                            <?php if (!$vb_multi && !is_array($data["legend"])) {
                                if (!empty($data["legend"])) (strpos($data["legend"], "©") === false) ? print "© " . $data["legend"] : _p($data["legend"]);
                            } else {
                                _p($data["legend"][$locale]);
                            } ?>
                        </div>
                        <div class="col-sm-12 containerLogo" style="margin-top: 1rem">
                            <?php if ($data["subUrl1"]) : ?>
                                <div>
                                    <img src="<?php _p($data["subUrl1"]); ?>" style="margin-left:10px" />
                                </div>
                            <?php endif; ?>
                            <?php if ($data["subUrl2"]) : ?>
                                <div>
                                    <img src="<?php _p($data["subUrl2"]); ?>" style="margin-left:10px" />
                                </div>
                            <?php endif; ?>
                            <?php if ($data["subUrl3"]) : ?>
                                <div>
                                    <img src="<?php _p($data["subUrl3"]); ?>" style="margin-left:10px" />
                                </div>
                            <?php endif; ?>
                            <?php if ($data["subUrl4"]) : ?>
                                <div>
                                    <img src="<?php _p($data["subUrl4"]); ?>" style="margin-left:10px" />
                                </div>
                            <?php endif; ?>

                            <?php if ($data["subUrl5"]) : ?>
                                <div>
                                    <img src="<?php _p($data["subUrl5"]); ?>" style="margin-left:10px" />
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

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
            case "object":
                //die("here");
            ?>
                <div id="diapo-<?php print $count; ?>" class="diapo container unique object">
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5;position:relative;overflow:hidden;">
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

                <div id="diapo-<?php print $count; ?>" class="diapo container unique objectbam">
                    <div class="row content" style="margin:0 auto;padding:20px 30px;background-color:#fff4d5;position:relative;overflow:hidden;">
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
        if ($bloc["type"] != "animationDiapo")        {
            if ( $bloc["type"] != "paragraph"){$count++;}}


    endforeach;
    ?>
</div>
<div class="scroll container" style="background-color: white;">
    <?php

    $count = 0;
    foreach ($blocs as $index => $bloc) :
        $bloc["content"] = str_replace("\\n", "", $bloc["content"]);
        $data = $bloc["data"];
        $color = (strpos($data["color"], "#") === false) ? "#" . $data["color"] : $data["color"];
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
            case "diapoInter":
            case "diapoInter2":
            case "diapofin": ?>
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
            case "object":
                if (!$color) $color = "#fff4d5";
                $object_id = $data["objectId"];
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
    @font-face {
        font-family: 'CCCodeMonkeyVariable';
        src: url('/app/plugins/Expositions/CCCodeMonkeyVariable-Regular.woff2') format('woff2'),
            url('/app/plugins/Expositions/CCCodeMonkeyVariable-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'CCCodeMonkeyVariable';
        src: url('/app/plugins/Expositions/CCCodeMonkeyVariable-Bold.woff2') format('woff2'),
            url('/app/plugins/Expositions/CCCodeMonkeyVariable-Bold.woff') format('woff');
        font-weight: bold;
        font-style: normal;
        font-display: swap;
    }

    figcaption {
        color: #999;
        font-style: italic;
    }

    .article {}

    .article div {
        white-space: normal;
    }

    .diapo {
        background-color: #fff4d5 !important;
        display: none;
        padding-left: 0;
        padding-right: 0;
        min-height:100vh;

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

    .row.first {
        height: 430px;
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

    .visiter,
    .retour {
        background-color: white;
        padding: 2px 6px;
        border-radius: 6px;
        color: #C0392B;
        font-size: 14px;
        height: 22px;
        line-height: 20px;
        display: inline-block;
        margin-left: 12px;
    }

    .visiter .button,
    .retour .button {
        font-size: 12px;
    }

    #retour {
        display: none;
    }

    body.fullscreen {
        background-color: #C0392B;
        ;
    }

    .container.article-title {
        margin-top: 80px !important;
        background: #C0392B;
        color: white;
    }

    .fullscreen.container.article-title {
        margin-top: 0 !important;
    }

    body.fullscreen {
        background: #C0392B;
    }

    body.fullscreen .diapo {
        min-width: calc(100vh - 66px);
        background: #fff4d5;
    }

    body.fullscreen .diapo .first {
        height: calc(50vh - 66px);
        min-height: 430px;
    }

    .article.fullscreen .row {
        max-width: none;
    }

    body.fullscreen footer {
        display: none;
    }

    body.fullscreen .scroll {
        display: none;
    }

    .bubble {
        position: absolute;
        padding: 28px 30px;
        color: black;
        text-align: center;
        border-radius: 150px;
        text-transform: uppercase;
        line-height: 1.2em;
        display: flex;
        align-items: center;
        font-family: CCCodeMonkeyVariable;
    }

    h1.titre_template_page {
        font-family: CCCodeMonkeyVariable;
    }

    .bubble.bubble-right .inner {
        margin-top: 16px;
        margin-left: -8px;
    }

    .bubble.bubble-left .inner {
        margin-top: 3px;
        margin-left: 20px;
    }

    .containerLogo {
        text-align: right;
    }

    .containerLogo>div {
        width: 100px;
        height: 100px;
        display: inline-block;
        margin-left: 10px;
    }

    .containerLogo>div>img {
        object-fit: contain;
        width: 100%;
        height: 100%;
        margin-left: inherit;
    }

    .scroll {
        display:none !important;
    }
</style>
<script>
    var current = 0;
    var max = <?= $count ?>;
    var startDelay = 1000;
    window._dataAnim = <?= json_encode($data_anim_cleaned); ?>;
    var clickleftright = 0;

    $(document).ready(function() {

        $("#diapo-1").hide();
        $("#diapo-0").show();

        console.log("window._dataAnim", window._dataAnim);
        console.log("current", current);
        //console.log("window._dataAnim[current]", window._dataAnim[current]["content"]);

        $(".expo-arrow-left").on("click", function() {
            if (current > 0) {
                $('.diapo').hide();
                removeAnimations();
                current--;
                $('#diapo-' + current).show();
                // console.log(current);
                runAnimation(current);
                //console.log("left");
                clickleftright++;
            }
        });
        $(".expo-arrow-right").on("click", function() {
            if (current < max) {
                $('.diapo').hide();
                removeAnimations();
                current++;
                $('#diapo-' + current).show();
                runAnimation(current);
                //  console.log(current);
                //console.log("right");
                clickleftright++;
            }
        });

        $(".lien_biblio").find("a").each(function() {
            $(this).attr("target", "_blank")
        })

        $('.materiaux').each(function() {
            $(this).html($(this).html().split("➔").slice(1).join("➔"));
        })
    });

    function removeAnimations() {
        $(".animation").remove();
    }

    function runAnimation(index) {
        // console.log(index);
        let current = index;
        let posx, posy;
        //console.log(current);

        //si on a une animation...
        if (window._dataAnim[current]) {
            // stockage des contenus
            let animationContent = window._dataAnim[current];
            console.log("animationContent", animationContent);

            animationContent.forEach(function(animpart, animpartindex) {
                // pour chaque anim
                // [{"perso":"gabriel","time":"1","end":"2.5","type":"coming-from-left-to-right","zoom":1,"x":"-30","y":"26","x2":"60","y2":"26","text":""}
                console.log("animpart", animpart);
                const containerHeight = $("#diapo-" + current + " .row.first .firstBis").height();
                const containerWidth = $("#diapo-" + current + " .row.first .firstBis").width();
                switch (animpart["type"]) {
                    case "bubble-right":
                    case "bubble-left":
                    case "bubble-top-left":
                    case "bubble-top-right":

                        let bubbleBlock = document.createElement("img");
                        bubbleBlock.src = "/app/plugins/Expositions/characters/"+animpart["type"] + ".png";
                        bubbleBlock.id = "bubbleBlock" + animpartindex;
                        bubbleBlock.dataset.current = current;
                        bubbleBlock.style.height = (162 * animpart["zoom"]) + "px";
                        bubbleBlock.style.position = "absolute";
                        bubbleBlock.classList.add("animation");
                        posx = containerWidth * animpart["x"] / 100;
                        posy = (containerHeight * animpart["y"]) / 100;
                        bubbleBlock.style.top = posy + "px";
                        bubbleBlock.style.left = posx + "px";
                        let bubbleBlockContent = document.createElement("div");
                        let bubbleBlockContentInner = document.createElement("div");
                        bubbleBlockContentInner.innerHTML = animpart["text"];
                        bubbleBlockContentInner.classList.add("inner");
                        bubbleBlockContentInner.classList.add("animation");
                        //bubbleBlockContent.ht
                        bubbleBlockContent.classList.add("bubble");
                        bubbleBlockContent.classList.add("animation");
                        bubbleBlockContent.classList.add(animpart["type"]);
                        bubbleBlockContent.style.top = (posy + (10 * animpart["zoom"])) + "px";
                        bubbleBlockContent.style.left = (posx + (15 * animpart["zoom"])) + "px";
                        bubbleBlockContent.style.width = (220 * animpart["zoom"]) + "px";
                        bubbleBlockContent.style.height = (130 * animpart["zoom"]) + "px";;

                        bubbleBlockContent.append(bubbleBlockContentInner);
                        // affiche le bloc à time (ms) depuis le début
                        //let currentAnimAppend = current;
                        window.setTimeout(function() {
                            $("#diapo-" + bubbleBlock.dataset.current + " .row.first .firstBis").append(bubbleBlock);
                            $("#diapo-" + bubbleBlock.dataset.current + " .row.first .firstBis").append(bubbleBlockContent);
                        }, startDelay + (animpart["time"] * 1000));
                        // retire le bloc à time (ms) depuis le début
                        if (animpart["end"] !== "") {
                            window.setTimeout(function() {
                                //$("#"+"bubbleBlock"+animpartindex).remove();
                            }, startDelay + (animpart["end"] * 1000));
                        }
                        break;
                    default:
                        let animBlock = document.createElement("video");
                        animBlock.muted = true;
                        animBlock.playsinline = true;
                        animBlock.backgroundColor = "white";
                        animBlock.id = "animBlock" + animpartindex;

                        //MP4 pour Safari
                        animBlockSrc1 = document.createElement("source");
                        animBlockSrc1.src = "/app/plugins/Expositions/characters/" + animpart["perso"] + "/" + animpart["perso"] + "-" + animpart["type"] + ".mp4";
                        animBlockSrc1.type = 'video/mp4;codecs=hvc1';
                        animBlock.append(animBlockSrc1);
                        animBlock.dataset.current = current;
                        animBlock.dataset.clickleftright = clickleftright;
                        // WebM pour Chrome et Firefox
                        animBlockSrc2 = document.createElement("source");
                        animBlockSrc2.src = "/app/plugins/Expositions/characters/" + animpart["perso"] + "/" + animpart["perso"] + "-" + animpart["type"] + ".webm";
                        // animBlockSrc2.src = "/app/plugins/Expositions/characters/mia/mia-"+animpart["type"]+".webm";
                        animBlockSrc2.type = 'video/webm';
                        animBlock.append(animBlockSrc2);

                        animBlock.style.height = (420 * animpart["zoom"]) + "px";;
                        animBlock.style.position = "absolute";
                        posx = (containerWidth * animpart["x"]) / 100;
                        posy = (containerHeight * animpart["y"]) / 100;
                        animBlock.style.top = posy + "px";
                        animBlock.style.left = posx + "px";
                        animBlock.classList.add("animation");
                        // affiche le bloc à time (ms) depuis le début
                        window.setTimeout(function() {
                            //if(animBlock.dataset.clickleftright == clickleftright) {
                                $("#diapo-" + animBlock.dataset.current + " .row.first .firstBis").append(animBlock);
                                animBlock.play();
                                //si x2 et y2 différents
                                if ((animpart["x"] != animpart["x2"]) || (animpart["x"] != animpart["x2"])) {
                                    $("#" + "animBlock" + animpartindex).animate({
                                        top: (containerHeight * animpart["y2"]) / 100,
                                        left: (containerWidth * animpart["x2"]) / 100
                                    }, ((animpart["end"] * 1000)));
                                }
                            //}
                        }, startDelay + (animpart["time"] * 1000));
                        // retire le bloc à time (ms) depuis le début
                        if (animpart["end"]) {
                            window.setTimeout(function() {
                                $("#" + "animBlock" + animpartindex).remove();
                            }, startDelay + (animpart["end"] * 1000) + 50);
                        }
                        break;
                }

            })
            console.log(animationContent);
        }else{
            const img = document.createElement("img");
            img.src = "/app/plugins/Expositions/empreintes.png";
            img.style.position = "absolute";
            img.style.bottom = "10px";
            img.style.right = "10px";
            img.style.height = "30vh";
            $("#diapo-" + current + " .row.first .firstBis").append(img);
        }
    
    }

    function reveal(id) {
        $('.diapo').hide();
        current = id;
        console.log(current);

        if (window._dataAnim[current]) {
            removeAnimations();

            runAnimation(current);
        }

        $('#diapo-' + current).show();
    }

    function visiter() {
        $('.article-title').addClass("fullscreen");
        $('.article').addClass("fullscreen");
        $('body').addClass("fullscreen");
        $('.visiter').hide();
        $('header').hide();
        $('.retour').show();
        /*setTimeout(function() {
            $('#diapo-0').show();
        }, 50);*/
        window.setTimeout(function() {
            runAnimation(0)
        }, 500);
    }

    function retour() {
        $('.article-title').removeClass("fullscreen");
        $('.article').removeClass("fullscreen");
        $('body').removeClass("fullscreen");

        $('.visiter').show();
        $('header').show();
        $(".retour").hide();
    }
</script>