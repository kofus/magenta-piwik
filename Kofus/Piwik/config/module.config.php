<?php

namespace Kofus\Piwik;

return array (
        'listeners' => array(
            'KofusPiwikListener'
        ),
    
		'service_manager' => array (
				'invokables' => array (
						'KofusPiwikListener' => 'Kofus\Piwik\Listener\PiwikListener',
				)
				,
		),
		
		'view_manager' => array (
				'template_path_stack' => array (
						'Piwik' => __DIR__ . '/../view' 
				),
				'controller_map' => array (
						'Kofus\Piwik' => true 
				),
				'module_layouts' => array (
						'Kofus\\Piwik' => 'kofus/layout/admin' 
				) 
		),
		
		'view_helpers' => array (
				'invokables' => array (
						'piwik' => 'Kofus\Piwik\View\Helper\PiwikHelper', 
				) 
		),
		
		'controller_plugins' => array (
				'invokables' => array (
						'piwik' => 'Kofus\Piwik\Controller\Plugin\PiwikPlugin' 
				) 
		),
		

);