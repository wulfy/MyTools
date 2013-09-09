<?php
namespace MyTools\ComposantSocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class BarreSocialeController extends Controller
{
    public function displayAction($extension="Facebook")
    {
		$social_widgets = array();
		
		if($this->container->hasParameter("social_widgets"))
			$social_data = $this->container->getParameter("social_widgets");
		else
			$social_data = $extension;
		
		//formattage en array		
		$social_data = explode(",",$social_data);
			
		//check des templates et suppression si n'existent pas
		foreach($social_data as $widget)
		{
			$filtered_widget	=	strtolower($widget);
			if ( $this->get('templating')->exists('MyToolsComposantSocialBundle:Default:'.$filtered_widget.'.html.twig') )
				$social_widgets[] = $filtered_widget;
		}
			
		return $this->render('MyToolsComposantSocialBundle:Default:barre.html.twig',array('social_widgets' => $social_widgets));
    }
	
	public function setConfig($config)
	{
		//$this->container->setParameter("MyTools_ComposantSocial.social_widgets",$config);
	}
}
