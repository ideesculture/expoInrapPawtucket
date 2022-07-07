<?php
$numberOfRow = $this->getVar("numberOfRow");
$rows = $this->getVar("content");
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

    <div class="row">
        <h1>Les lieux d'Expositions</h1>
        <div class="col-md-4">
            CARTE ICI
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <p>50 musées partenaires qui hébergent des objets mis au jour par
                        les archéologues de 'INRAP sont partenaires de cette galerie
                        muséale. Découvrez ces établissements et les objets de leur
                        collection, accédez à leur site internet ensuite pour préparer votre
                        visite.</p>
                    <a href="">VOIR TOUS LES LIEUX D'EXPOSITION</a>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6"> LIEU DEXPO 1</div>
                <div class="col-md-6"> Lieu d'expo 2</div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            VOIR TOUTES LES EXPOSITIONS
        </div>
        <div class="col-md-4">
            VOIR TOUTES LES EXPOSITIONS
            JEUNESSE
        </div>
        <div class="col-md-4">
            Jeux archéo !
        </div>
    </div>
</div>

<style>
    .container.HomePage {
        max-width: 1170px !important;
        margin-top: 100px !important;
    }

    .homePageBlock {
        height: 200px;
    }

    .homePageBlock div p {
        margin: 0;
    }

    .container.HomePage div.row {

        margin-top: 20px;

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
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        justify-content: flex-end;
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

            $vt_page = new ca_site_pages($result["value_id"]);

            $title = $vt_page->get("title");

            if ($result["image"]) {
                $image = $result["image"];
            } else {
                $content = $vt_page->get("content");
                $image = json_decode($content["blocs"], true)["blocks"][0]["data"]["url"];
            }

            print '<div style="background-image: url(' . $image . ');" class="homePageBlockDiv"><p class="homePageBlockTitle">' . $title . '</p></div>';

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
