<?php
namespace Kofus\Piwik\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\Mvc\MvcEvent;


class PiwikListener extends AbstractListenerAggregate implements ListenerAggregateInterface
{
	public function attach(EventManagerInterface $events)
	{
		$sharedEvents = $events->getSharedManager();
		$this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'trackPageView'));
	}
	
	public function trackPageView(MvcEvent $e)
	{
	    $vm = $e->getApplication()->getServiceManager()->get('viewHelperManager');
	    
	    // View Helpers
	    $headScript = $vm->get('headScript');
	    $bodyTag = $vm->get('bodyTag');
	    
	    // Config values
	    $config = $e->getApplication()->getServiceManager()->get('KofusConfig');
	    $siteId = $config->get('piwik.site_id');
	    $url = $config->get('piwik.url');
	    
	    if ($siteId && $url) {
	        
	        $url = trim($url, '/');

	        // Integrate noscript html tag
	        $bodyTag->appendHtml('<noscript><img src="'.$url.'/piwik.php?idsite='. (int) $siteId . '&rec=1" style="border:0;" alt="" /></noscript>');
	        
	        $url = preg_replace('/^https?\:/', '', $url);
	        
	        // Integrate js code
    	    $headScript->appendScript("
                  var _paq = _paq || [];
                  _paq.push(['trackPageView']);
                  _paq.push(['enableLinkTracking']);
                  (function() {
                    var u='".$url."/';
                    _paq.push(['setTrackerUrl', u+'piwik.php']);
                    _paq.push(['setSiteId', '". (int) $siteId."']);
                    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                  })();
            ");
	    }	        
	}

}
