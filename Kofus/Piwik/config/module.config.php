<?php

namespace Kofus\Piwik;

return array (
		'service_manager' => array (
				'invokables' => array (
						'KofusPiwik' => 'Kofus\Piwik\Service\PiwikService',
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