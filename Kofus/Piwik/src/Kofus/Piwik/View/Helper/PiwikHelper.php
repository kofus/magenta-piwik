<?php

namespace Kofus\Piwik\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PiwikHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    public function __invoke()
    {
    	return $this;
    }
    
    public function optOut()
    {
        $config = $this->getServiceLocator()->get('KofusConfig');
        if (! $config->get('piwik.site_id'))
            return;
        
        $url = trim($config->get('piwik.url'), '/');
        $html = '<iframe class="piwik-opt-out" frameborder="no"  src="'.$url.'/index.php?module=CoreAdminHome&action=optOut&language=de"></iframe>';
        return $html;        
    }
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }
    
    public function getServiceLocator()
    {
        return $this->sm->getServiceLocator();
    }
    
    
}