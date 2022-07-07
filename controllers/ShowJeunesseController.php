<?php

ini_set("display_errors", 1);
error_reporting(E_ERROR);
require_once(__CA_MODELS_DIR__.'/ca_site_pages.php');

class ShowJeunesseController extends ActionController
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
        $this->opa_view_paths[] = $this->plugin_path."/themes/".$vs_theme."/views/jeunesse";
    }

    # -------------------------------------------------------
    # Functions to render views
    # -------------------------------------------------------
    public function Index($type = "")
    {
	    $all_articles = ca_site_pages::getPageList();
	    $all_articles = array_reverse($all_articles);
	    $articles = [];
	    foreach ($all_articles as $testarticle) {
	        if ($testarticle["template_title"]=="article") {
//	            $articles = $testarticle;
//	            array_push($articles, $testarticle);
                $articles[] = $testarticle;
            }
        }
	    $articles = array_splice($articles,0, 6);
        $blocks = [];
        $i=0;
        foreach ($articles as $art) {
	        $i++;
	        if($i>4) break;
//            var_dump($art);die();
            $page = new ca_site_pages($art["page_id"]);
            $article = $page->get("content");
            $this->view->setVar("article", $article);
            $this->view->setVar("id", $art["page_id"]);
            $blocks[$article["datesort"]] = $this->render("home_block_html.php", true);
        }
        // Ordering by datesort
	    ksort($blocks);
	    // Inversing (last goes first)
	    $blocks = array_reverse($blocks);
	    //Making string from array
		$blocks = implode(" ", $blocks);      
		
        //$page = new ca_site_pages(1);
        $this->view->setVar("blocks", $blocks);
        $this->render('index_html.php');
    }

    public function All($type = "")
    {
        $all_articles = ca_site_pages::getPageList();
        $all_articles = array_reverse($all_articles);
        $articles = [];
        foreach ($all_articles as $testarticle) {
            if ($testarticle["template_title"]=="article") {
//	            $articles = $testarticle;
//	            array_push($articles, $testarticle);
                $articles[] = $testarticle;
            }
        }
        $blocks = "";
		$categories = [];
        foreach ($articles as $art) {
//            var_dump($art);die();
            $page = new ca_site_pages($art["page_id"]);
            $article = $page->get("content");
            $this->view->setVar("article", $article);
            $this->view->setVar("id", $art["page_id"]);
            $blocks .= $this->render("all_block_html.php", true);
			$categories[] = $article["categorie"];
			$categories = array_unique($categories);
        }
        //$page = new ca_site_pages(1);
        $this->view->setVar("blocks", $blocks);
        $this->view->setVar("categories", $categories);
        $this->render('all_articles_html.php');
    }

    public function Wall() {
        $this->render('index_html.php');
    }

    public function Details() {
        $id= $this->request->getParameter("id", pInteger);
        // TODO Redirect if no ID
        $page = new ca_site_pages($id);
        //$page = new ca_site_pages(1);
        $article = $page->get("content");
        print "<!-- ".$page->get("template_id")."-->";
        if($page->get("template_id") == "3") {
            $this->redirect("/index.php/Expositions/Show/Details/id/".$id);
        } else {
            $this->view->setVar("article", $article);
            $this->view->setVar("id", $id);
            $this->render('article_html.php');
        }

    }

    public function List() {
        $all_articles = ca_site_pages::getPageList();
        $all_articles = array_reverse($all_articles);
        $articles = [];
        foreach ($all_articles as $testarticle) {
            if ($testarticle["template_title"]=="article") {
//	            $articles = $testarticle;
//	            array_push($articles, $testarticle);
                $articles[] = $testarticle;
            }
        }
        $result=[];
        foreach($articles as $key=>$article_info) {
            $article = new ca_site_pages($article_info["page_id"]);
            $content = $article->get("ca_site_pages.content");
            $result[$key] = ["page_id"=>$article_info["page_id"], "title"=>$article_info["title"], "content"=>$content];
        }
        $this->view->setVar("articles", $result);
        $this->render('list_html.php');
    }
}
?>
