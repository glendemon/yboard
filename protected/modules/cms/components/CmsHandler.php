<?php

class CmsHandler extends Controller
{   
    public $errorAction;
    public $breadcrumbs=array();
    private $error;
    public $layout='//main-template';

	function __construct()
	{
		parent::__construct($id);
        //check if is set default layout for module
        $defaultLayout = Yii::app()->getModule('cms')->defaultLayout;
        if ($defaultLayout)
            $this->layout = $defaultLayout;
        
	}
    
    function handle($error)
    {
        if ($error && isset($error->exception) && $error->exception->statusCode==404)
        {
            $this->error = $error;
            $this->initCms();
        }
        elseif ($error && isset($error->exception)){
            throw $error->exception;
        } 
        else{
            $this->showError();
        }   
    }
    
    function initCms($root=false)
    {
        Yii::import('application.modules.cms.models.*');
        $request = Yii::app()->getRequest();
        $url = $request->getPathInfo();
        if ( empty($url) && !Yii::app()->urlManager->urlFormat!='path' )
            $url = @$_GET['r'];
        
        $url = trim($url,'/');
        if (empty($url))
            $this->showError();
        if (!$root)
            $page = Cms::model()->find('url=:url',array(':url'=>$url));
        else
            $page = Cms::model()->findByPk(1);
         
        if ($page)
            $this->processCms($page);
		else
		    $this->showError();
    }
    
    function processCms($page)
    {

        $user = Yii::app()->user;
        
        if ($page->access_level==Cms::AUTH_ONLY && $user->getIsGuest()){
            $this->redirect($user->loginUrl);
        }
        
        if ($page->layout)
            $this->layout = $page->layout;
            
        if ($keywords = trim($page->keywords))
            Yii::app()->clientScript->registerMetaTag($keywords, 'keywords');
            
        if ($description = trim($page->description))
            Yii::app()->clientScript->registerMetaTag($description, 'description');
            
        if ($title = trim($page->title))
            $this->pageTitle = $title;
        
        switch ($page->type)
        {
            case Cms::PAGESET:
                if ($page->overview_page || $page->id==1){
                    $content = $this->renderPageContent($page);
                }
                else{
                    $firstChild = Cms::model()->find('parent_id=:parent_id',array(':parent_id'=>$page->id));
                    if (!$firstChild){
                        $this->showError();
                    }
                    $this->redirect($firstChild->url);
                }
                break;
            case Cms::PAGE:
                $content = $this->renderPageContent($page);
                break;
            case Cms::LINK:
                $this->redirect($page->url);
                break;
		}
        
            $section = $page->section ? '//'.$page->section : '//cms/default';
        
            $this->render($section, array('page'=>$page,'content'=>$content));
        
	}
    
    function renderPageContent($page)
    {
        if ($page->subsection)
        {
            $content = $this->renderPartial($page->subsection,array('page'=>$page,'content'=>$page->content),true);
        }
        return $content;
    }
    
    function showError()
    {   
        header("HTTP/1.0 404 Not Found");
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error->exception['message'];
            else
                $this->render('//cms/error', array('error'=>$error));
        }
    }
    
    public static function renderHomePage()
    {
        $cmsHandler = new CmsHandler;
        $page = Cms::model()->findByPk(1);
        $cmsHandler->processCms($page);
    }
}

?>
