<?php

ini_set("display_errors", 1);
error_reporting(E_ERROR);
require_once(__CA_MODELS_DIR__.'/ca_site_pages.php');

class HomeController extends ActionController
{
    # -------------------------------------------------------
    protected $opo_config;        // plugin configuration file
    protected $opa_list_of_lists; // list of lists
    protected $opa_listIdsFromIdno; // list of lists
    protected $opa_locale; // locale id
    private $opo_list;
    private $plugin_path;
    
    # -------------------------------------------------------
    # Constructor
    # -------------------------------------------------------

    public function __construct(&$po_request, &$po_response, $pa_view_paths = null)
    {
        parent::__construct($po_request, $po_response, $pa_view_paths);
		$this->plugin_path = __CA_APP_DIR__ . '/plugins/Expositions';
		
        $this->opo_config = Configuration::load(__CA_APP_DIR__ . '/plugins/Expositions/conf/articles.conf');
        
		// Extracting theme name to properly handle views in distinct theme dirs
        $vs_theme_dir = explode("/", $po_request->getThemeDirectoryPath());
        $vs_theme = end($vs_theme_dir);
        $this->opa_view_paths[] = $this->plugin_path."/themes/".$vs_theme."/views/home";
    }

    # -------------------------------------------------------
    # Functions to render views
    # -------------------------------------------------------
    public function Index($type = "")
    {

        $blocks = $this->GetHomeContent2();
        $this->view->setVar("numberOfRow", $blocks["numberOfRow"]);
        $this->view->setVar("content", $blocks["rows"]);	    


        $this->render('index_html.php');
    }

    public function GetHomeContent2(){

        //PATH TO THE PROVIDENCE
        // TODO : CHANGE FOR PRODUCTION
        // TODO : CHANGE WITH UR CONFIGURATION
        $blocks = file_get_contents("/Users/deruellemarine/sites/comodo.inrap.test/public/app/plugins/expoInrap/homeData/blocks.json");
        $blocks = json_decode($blocks, true);

        return $blocks;
    }

}
?>
