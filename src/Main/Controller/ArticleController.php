<?php
namespace Main\Controller;

use CoraPHP\Mvc\View;
use CoraPHP\Container\Registry;

use Common\Controller\TemplateController;

/**
 * Description of ArticleController
 *
 * @author Pirulo
 */
class ArticleController extends TemplateController{
    //put your code here
    
    public function indexAction()
    {
        $msgs = Registry::channel("Library")->get("Main:Service:MessageService");
        
        $page['page_title'] = "Lorem Ipsum! ".rand();
        $page['page_content'] = $msgs->lorem();

        $this->request->flash->set("msg", $msgs->sayRandom());

        $loop = View::loop("Common:Shared:page", array($page,$page,$page));
        
        $title = "Articles";
        
        $view = View::make("Common:Shared:page");
        $view->add("page_title", $title);
        $view->add("page_content", $loop);
        
        $this->template->append("web_title", "{$title} - ");
        
        $this->template->add("web_content", $view);
    }  
}
