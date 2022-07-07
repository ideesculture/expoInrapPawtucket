<?php

require __CA_MODELS_DIR__."/ca_storage_locations.php";
$numberOfRow = $this->getVar("numberOfRow");
$rows = $this->getVar("content");

$o_data = new Db();
$query = "select csll.name, csl.location_id
from `ca_storage_locations` csl
left join ca_storage_location_labels csll on csl.location_id = csll.location_id
where deleted = 0
and csl.type_id = 2773
and access = 1
ORDER BY csl.location_id DESC
LIMIT 2;";
$result = $o_data->query($query);
$result = $result->getAllRows();
$chrono_json = "[{
    \"title\": \"Paléolithique inférieur\",
    \"color\": \"#b7a23d\",
    \"color_light\": \"#c6b467\",
    \"color_dark\": \"#9c8c3d\",
    \"left_chrono_date\": \"-800 000\",
    \"periods\": [{
        \"title\": \"Acheuléen\",
        \"left\": \"0\",
        \"width\": \"100%\",
        \"debut\": \"-800 000\",
        \"fin\": \"-100 000\"
    }],
    \"dates\": [],
    \"intro\": \"<p>Cette période voit l'apparition et la diffusion de l'Homme à travers le monde depuis son berceau africain. En Europe de l'Ouest, le Paléolithique inférieur concerne une phase de plus de 500000 ans (environ de 800000 à 300000 avant notre ère) inscrite dans la première partie du Pléistocène moyen et caractérisée par l'établissement progressif des hominidés dans le nord à partir du Bassin méditerranéen.</p>\",
    \"illustration\": {
        \"image\": \"/periode01.png\",
        \"height\": \"290px\"
    },
    \"period_id\": \"39735\"
}, {
    \"title\": \"Paléolithique moyen\",
    \"color\": \"#b39a7d\",
    \"color_light\": \"#c2af97\",
    \"color_dark\": \"#99866e\",
    \"left_chrono_date\": \"-300 000\",
    \"periods\": [{
            \"title\": \"Acheuléen\",
            \"left\": \"0\",
            \"width\": \"75%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Moustérien\",
            \"left\": \"0\",
            \"width\": \"100%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
        \"title\": \"≈ –400 000 : usage du feu\",
        \"left\": \"60%\"
    }],
    \"intro\": \"<p>Cette période qui couvre plus de 250 000 ans (environ de 300000 à 40000 avant notre ère) à la charnière du Pléistocène moyen et supérieur voit le développement, l'apogée et l'extinction de l'Homme de Néandertal en Europe.</p>\",
    \"illustration\": {
        \"image\": \"/periode02.png\",
        \"height\": \"245px\"
    },
    \"period_id\": \"39611\"
}, {
    \"title\": \"Paléolithique supérieur\",
    \"color\": \"#9db281\",
    \"color_light\": \"#b1c29a\",
    \"color_dark\": \"#879a71\",
    \"left_chrono_date\": \"-40 000\",
    \"periods\": [{
            \"title\": \"Châtelperronien\",
            \"left\": \"7.5%\",
            \"width\": \"17.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Aurignacien\",
            \"left\": \"10%\",
            \"width\": \"35%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Gravettien\",
            \"left\": \"52.5%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Solutréen\",
            \"left\": \"72.5%\",
            \"width\": \"10%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Magdalénien\",
            \"left\": \"80%\",
            \"width\": \"20%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
        \"title\": \"≈ –30 000 : art pariétal\",
        \"left\": \"35%\"
    }],
    \"intro\": \"<p>Le Paléolithique supérieur débute sur tous les continents, hormis l'Amérique, aux alentours de -40000 et perdure jusque vers -12500. Il est caractérisé par l'expansion de l'Homme moderne à travers le monde.</p>\",
    \"illustration\": {
        \"image\": \"/periode03.png\",
        \"height\": \"360px\"
    },
    \"period_id\": \"39612\"
}, {
    \"title\": \"Mésolithique\",
    \"color\": \"#8cb79a\",
    \"color_light\": \"#a3c5ae\",
    \"color_dark\": \"#7a9c85\",
    \"left_chrono_date\": \"-12 500\",
    \"periods\": [{
            \"title\": \"Épipaléolithique\",
            \"left\": \"0%\",
            \"width\": \"45%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Mésolithique ancien\",
            \"left\": \"45%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Mésolithique moyen\",
            \"left\": \"70%\",
            \"width\": \"15%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Mésolithique récent\",
            \"left\": \"85%\",
            \"width\": \"15%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
        \"title\": \"≈ –9 000 : utilisation de l'arc\",
        \"left\": \"65%\"
    }],
    \"intro\": \"<p>La période comprise entre 12500 et 9600 avant notre ère voit la fin des derniers groupes de chasseurs-cueilleurs du Tardiglaciaire nommés groupes épipaléolithiques. Une première oscillation climatique tempérée, l'interstade de Bölling/Alleröd (-12500 à -11000), suivie d'un brusque refroidissement, le Dryas récent (-11000 à -9600) constituent le cadre climatique.</p>\",
    \"illustration\": {
        \"image\": \"/periode04.png\",
        \"height\": \"300px\"
    },
    \"period_id\": \"39737\"

}, {
    \"title\": \"Néolithique\",
    \"color\": \"#8ba9c9\",
    \"color_light\": \"#a3bad3\",
    \"color_dark\": \"#7a91aa\",
    \"left_chrono_date\": \"-6 000\",
    \"periods\": [],
    \"dates\": [{
            \"title\": \"≈ –6 000 : hache polie, céramique\",
            \"left\": \"0\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –5 300 : premiers villages sédentaires\",
            \"left\": \"17.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –4 500 : premières sépultures mégalithiques\",
            \"left\": \"37.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –4 500 : fossés et palissades autour des villages\",
            \"left\": \"37.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –4 500 : métallurgie du cuivre\",
            \"left\": \"80%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"intro\": \"<p>Les changements fondamentaux qui caractérisent le Néolithique (-6000 à -2100)  sont l'invention de l'agriculture (production de blé et d'orge à l'origine) et la domestication des animaux (la chèvre et le mouton, puis le boeuf et le porc). L'origine de ces transformations se situe au Proche-Orient.</p><p>L'expansion démographique qui s'en est suivie a amené ces nouveaux agriculteurs-éleveurs à coloniser progressivement le Moyen-Orient puis l'Europe. Deux courants de colonisation indépendants affectent l'Europe : le courant danubien qui concerne l'Europe centrale et arrive en Alsace vers 5500 avant notre ère, et le courant méditerranéen qui arrive dans le sud de la France entre 5900 et 5600 avant notre ère. Ces installations pionnières restent cependant très limitées et mal définies.</p>\",
    \"illustration\": {
        \"image\": \"/periode05.png\",
        \"height\": \"290px\"
    },
    \"period_id\": \"39594\"
}, {
    \"title\": \"Âge du bronze et âge du fer\",
    \"color\": \"#6f84a8\",
    \"color_light\": \"#8c9cba\",
    \"color_dark\": \"#637391\",
    \"left_chrono_date\": \"-2 200\",
    \"periods\": [{
            \"title\": \"Âge du bronze\",
            \"left\": \"0%\",
            \"width\": \"70%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Âge du fer\",
            \"left\": \"70%\",
            \"width\": \"30%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
            \"title\": \"≈ –2 200 : métallurgie du bronze\",
            \"left\": \"0\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –800 : riches tombes à char\",
            \"left\": \"70%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –600 : fondation de Marseille par les phocéens\",
            \"left\": \"80%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Ier siècle avant et après notre ère : urbanisme\",
            \"left\": \"91%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"≈ –200 : villes fortifiées sur les hauteurs\",
            \"left\": \"92.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"intro\": \"<p>Les âges des Métaux couvrent les vingt-deux siècles qui séparent la diffusion de la métallurgie du bronze, vers -2200 en France, de la conquête romaine de la Gaule en -52. Durant l'âge du Bronze (de -2200 à -800) puis l'âge du Fer (de -800 à -52), de profondes évolutions touchent tous les aspects de la société : innovations technologiques, refonte des réseaux commerciaux et intensification des échanges, apports démographiques, accroissement de la hiérarchisation sociale, basculement, à partir du VIe siècle dans l'orbite culturelle et économique du monde méditerranéen, émergence de la ville et d'une économie monétaire, mise en place de pouvoirs politiques centralisés…</p>\",
    \"illustration\": {
        \"image\": \"/periode06.png\",
        \"height\": \"240px\"
    },
    \"period_id\": \"39602\"
}, {
    \"title\": \"Antiquité gallo-romaine\",
    \"color\": \"#977c87\",
    \"color_light\": \"#ad969f\",
    \"color_dark\": \"#846d76\",
    \"left_chrono_date\": \"-50\",
    \"periods\": [{
            \"title\": \"Conquête romaine\",
            \"left\": \"0\",
            \"width\": \"12.5%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Haut empire\",
            \"left\": \"5%\",
            \"width\": \"55%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Antiquité tardive\",
            \"left\": \"60%\",
            \"width\": \"40%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
            \"title\": \"-52 : prise d'Alésia par Jules César\",
            \"left\": \"0\"
        },
        {
            \"title\": \"IVe-Ve siècles : évangélisation des campagnes, premières églises\",
            \"left\": \"62%\"
        },
        {
            \"title\": \"476 : ...\",
            \"left\": \"98%\"
        }
    ],
    \"intro\": \"<p>La civilisation romaine couvre douze siècles (VIIe s. avant notre ère-Ve s. de notre ère) et s'est constamment nourrie d'influences et d'emprunts. Elle s'étend hors d'Italie dès le IIIe-IIe siècles avant notre ère.</p><p>L'Antiquité gallo-romaine est divisée en deux grandes périodes : le Haut Empire : du début du Ier à la fin du IIIe siècle ; l'Antiquité tardive, dénommée encore récemment Bas Empire : du début du IVe à la fin du Ve siècle.</p>\",
    \"illustration\": {
        \"image\": \"/periode07.png\",
        \"height\": \"240px\"
    },
    \"period_id\": \"39580\"
}, {
    \"title\": \"Moyen Âge\",
    \"color\": \"#a77962\",
    \"color_light\": \"#b99482\",
    \"color_dark\": \"#8f6c59\",
    \"left_chrono_date\": \"500\",
    \"periods\": [{
            \"title\": \"Haut Moyen Âge\",
            \"left\": \"0\",
            \"width\": \"50%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Moyen Âge classique\",
            \"left\": \"50%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Bas Moyen Âge\",
            \"left\": \"75%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
            \"title\": \"594 : mort de Grégoire de Tours, auteur de L'histoire des Francs\",
            \"left\": \"8%\"
        },
        {
            \"title\": \"Xe-XIIe siècles : princes et seigneurs construisent des châteaux pour asseoir leur pouvoir\",
            \"left\": \"40%\"
        },
        {
            \"title\": \"911 : le chef viking Rollon obtient la Normandie\",
            \"left\": \"42%\"
        },
        {
            \"title\": \"1144 : consécration de la basilique de Saint-Denis\",
            \"left\": \"55%\"
        },
        {
            \"title\": \"1309-1376 : siège de la papauté en Avignon\",
            \"left\": \"62%\"
        },
        {
            \"title\": \"1137-1453 : Guerre de Cent Ans. Premiers usages de la poudre et du canon\",
            \"left\": \"65%\"
        }
    ],
    \"intro\": \"<p>Le Moyen Âge s'étend sur environ mille ans. Selon les auteurs, il commence en 476, à la fin du règne de Romulus Augustule, dernier empereur romain d'Occident, ou en 496, date du baptême de Clovis.</p><p>Il finit, selon les historiens, soit en 1453, prise de Constantinople par les Turcs et fin de l'Empire romain d'Orient, soit en 1492, date de l'accostage de Christophe Colomb sur le continent américain.</p>\",
    \"illustration\": {
        \"image\": \"/periode08.png\",
        \"height\": \"220px\"
    },
    \"period_id\": \"39597\"
}, {
    \"title\": \"Moderne/contemporain\",
    \"color\": \"#db683a\",
    \"color_light\": \"#e38864\",
    \"color_dark\": \"#b95f3a\",
    \"left_chrono_date\": \"1 500\",
    \"periods\": [{
            \"title\": \"Renaissance\",
            \"left\": \"0%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Grands rois et siècle des lumières\",
            \"left\": \"12.5%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        },
        {
            \"title\": \"Siècles de l'industrie\",
            \"left\": \"37.5%\",
            \"width\": \"25%\",
            \"debut\": \"-800 000\",
            \"fin\": \"-100 000\"
        }
    ],
    \"dates\": [{
            \"title\": \"1492 : Christophe Colomb découvre l'Amérique - Expulsion des Juifs d'Espagne, fin de la Reconquista et prise de Grenade\",
            \"left\": \"0\"
        },
        {
            \"title\": \"XVIIe siècle : fortifications modernes à la Vauban\",
            \"left\": \"20%\"
        },
        {
            \"title\": \"1661 : début du règne de Louis XIV\",
            \"left\": \"32.5%\"
        },
        {
            \"title\": \"1789 : Révolution française\",
            \"left\": \"52.5%\"
        },
        {
            \"title\": \"1860 : annexion de Nice et de la Savoie\",
            \"left\": \"72.5%\"
        },
        {
            \"title\": \"1879 : développement de l'éclairage électrique\",
            \"left\": \"77%\"
        },
        {
            \"title\": \"1914-1918 : première Guerre mondiale\",
            \"left\": \"82.5%\"
        }
    ],
    \"intro\": \"<p>La période moderne couvre les trois cents ans qui s'écoulent de la fin du Moyen Âge à la Révolution française. L'époque contemporaine correspond aux deux siècles suivants : XIXe et XXe siècles.</p><p>L'archéologie permet de renouveler la connaissance de ces périodes qui semblent si proches et dont on croyait a priori tout connaître par les archives. Elle révèle d'autres ruptures et d'autres continuités que celles de l'histoire traditionnelle. Ses principaux domaines de recherche sont les fortifications urbaines, les maisons villageoises et urbaines, les installations industrielles notamment les faïenceries, et l'archéologie des conflits depuis les campagnes napoléoniennes jusqu'à la Seconde Guerre mondiale.</p>\",
    \"illustration\": {
        \"image\": \"/periode09.png\",
        \"height\": \"320px\"
    },
    \"period_id\": \"39575\"
}]";

$chrono = json_decode($chrono_json, true);

?>
<div class="container HomePage">
    <?php
    foreach ($rows as $rowId => $row) {
        print "<div class='row'>";
        foreach ($row as $cellId => $cell) {
            print "<div ";
            if ($cell["type"] == "hidden") {
                print "style='display:none;' ";
            }
            if ($cell["colspan"]) {
                if ($cell["colspan"] == 2) {
                    print "class='col-md-8 homePageBlock' ";
                } else {
                    print "class='col-md-12 homePageBlock' ";
                }
            } else {
                print "class='col-md-4 homePageBlock' ";
            }
            print ">";
            print_content($cellId);
            print "</div>";
            //TODO : Ignore rowspan for the moment

        }
        print "</div>";
    }

    ?>

    <div class="row" id="bloc_lieu_expo">
        <div class="col-md-12">
            <h1>Les lieux d'Expositions</h1>
        </div>
        <div class="col-md-4" id="carte">
            <a href="/index.php/Inrap/Partenaires">
            <div class="homePageBlockDiv" style="background-image: url('/app/plugins/Expositions/carte_expo.png');justify-content: flex-start">
                <p class="homePageBlockTitle">Lieu d'exposition</p>
            </div>
            </a>
        </div>
        <div class="col-md-8" id="lieu_expo">
            <div class="row">
                <div class="col-md-12" style="border: 1px solid lightgray; padding: 15px;">
                    <p style="margin-top: 10px">50 musées partenaires qui hébergent des objets mis au jour par
                        les archéologues de 'INRAP sont partenaires de cette galerie
                        muséale. Découvrez ces établissements et les objets de leur
                        collection, accédez à leur site internet ensuite pour préparer votre
                        visite.</p>
                    <a href="/index.php/Inrap/Partenaires">VOIR TOUS LES LIEUX D'EXPOSITION</a>

                </div>

            </div>
            <div class="row" style="margin-top: 20px">
                <?php
                foreach ($result as $lieu){
                    $vt_place = new ca_storage_locations($lieu["location_id"]);
                    $image = $vt_place->getWithTemplate("^ca_object_representations.media.large.url");
                   // var_dump($image);

                    print "<div class='col-md-6'> ";
                    print "<div class='homePageBlockDiv' style='background-image:url(".$image.");height:200px'>";
                    print "<p class='homePageBlockTitle'>".$lieu["name"]."</p>";
                    print "</div></div>";

                }?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p style="border: 1px solid lightgray; padding: 15px;">
                <a href="/index.php/About/Expositions">VOIR TOUTES LES EXPOSITIONS</a>
            </p>
        </div>
        <div class="col-md-4" >
        <p style="border: 1px solid lightgray; padding: 15px;">
            <!-- NO LINK FOR ONLY YOUNG ?-->
        VOIR TOUTES LES EXPOSITIONS
            JEUNESSE</p>
        </div>
        <div class="col-md-4">
            <p style="border: 1px solid lightgray; padding: 15px;">
                        <!-- NO LINK YET-->

            Jeux archéo !
            </p>
        </div>
    </div>
    <div class="row">
    <div id="timeline" class="block block-block first last odd">
			<h3>Parcours permanent par période</h3>
			<div class="content" id="explorer">

				<?php
				$i = 0;
				foreach ($chrono as $period) {
					$i++;
				?>
					<a href="/index.php/Inrap/Chrono/p/<?php print $i; ?>" style="border-bottom:8px solid <?php echo $period['color_light']; ?>">
						<h4 class="visitez" style="position:relative;margin: auto;background-color: <?php echo $period['color']; ?>;border-bottom:16px solid <?php echo $period['color_dark']; ?>"><?php echo $period['title']; ?>
							<img src="<?php echo $period['illustration']['image']; ?>" style="position:absolute;right:6px;bottom:-6px;height:40px !important;top:4px;" />
						</h4>
					</a>
				<?php
				} ?>
				<a href="/index.php/Browse/objects" style="border-bottom:8px solid #00B3DA">
					<h4 class="visitez" style="position:relative;margin: auto;background-color: #00A3DA;border-bottom:16px solid #0093CA">Toutes périodes
					</h4>
				</a>
			</div>
		</div>
    </div>
</div>
<script>

$(document).ready(function(){
    $("#carte").height($("#lieu_expo").height());
})

</script>
<style>
    .container.HomePage {
        max-width: 1170px !important;
        margin-top: 100px !important;
    }

    .homePageBlock {
        height: 200px;
    }
    
    .homePageBlockDiv{
    }

    .homePageBlock div p {
        margin: 0;
    }

    #bloc_lieu_expo .homePageBlockDiv p{
        margin: 0;
    }
 

    .HomePage a{
        color: inherit;
    }

    .HomePage a:hover{
        text-decoration: none;
    }

    .container.HomePage div.row {

        margin-top: 20px;

    }
    .container.HomePage #bloc_lieu_expo div.row {
        margin:0;
    }
    .homePageBlockTitle {
        text-align: left;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 2px;
        padding-left: 10px;
        text-transform: uppercase
    }

    .homePageBlockDiv {
        background-size: cover;
        background-color: #fafafa;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        justify-content: flex-end;
    }
    #timeline h4 {
		color:white;
	}
</style>

<?php
function print_content($i)
{

    $o_data = new Db();
    $query = "SELECT *
    from plugin_cms_home
    where cell_id = " . $i . ";";
    $qr_result = $o_data->query($query);

    $result = $qr_result->getAllRows()[0];
    switch ($result["type"]):
        case 1:
        case 2:
        case 3:
            if ($result["type"] == 1){
                $url = "/index.php/Expositions/ShowJeunesse/Details/id/";
            }else{
                $url = "/index.php/Expositions/Show/Details/id/";
            }

            $vt_page = new ca_site_pages($result["value_id"]);

            $title = $vt_page->get("title");

            if ($result["image"]) {
                $image = $result["image"];
            } else {
                $content = $vt_page->get("content");
                $image = json_decode($content["blocs"], true)["blocks"][0]["data"]["url"];
            }

            print '<a href="'.$url.$result["value_id"].'"><div style="background-image: url(' . $image . '); " class="homePageBlockDiv"><p class="homePageBlockTitle">' . $title . '</p></div></a>';

            break;
        case 4:
            if ($result["image"]) {
                $image = $result["image"];
            }
            $content = base64_decode($result["text_content"]);
            print '<div style="background-image: url(' . $image . '); background-color:#f3f3f3; padding:10px" class="homePageBlockDiv">' . $content . '</div>';
            break;

        case 5:
            print '<div style="background-color: #571514;" class="homePageBlockDiv"><p class="homePageBlockTitle;">Bloc statisitque</p></div>';
            break;


    endswitch;
}

