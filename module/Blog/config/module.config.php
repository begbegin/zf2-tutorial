<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'blog_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__.'/../src/Blog/Entity'),
                    
                    
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    'Blog\Entity' => 'blog_annotation_driver'
                )
            )
        )
    ),
	
	'service_manager' => array(
		'factories' => array(
			'Blog\Interfaces\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
			'Blog\Services\EnfantService' => 'Blog\Factory\EnfantServiceFactory'
		)
	),
		
	'controllers' => array(
		'factories' => array(
			'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
			'Blog\Controller\Print' => 'Blog\Factory\PrintControllerFactory',
			'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
			
		)
	),
		
	'form_elements' => array(
			'factories' => array(
					'Blog\Form\Post' => 'Blog\Factory\PostFormFactory',
			)
	),
	
	'router' => array(
		'routes' => array(
			'post' => array(
				'type' => 'literal',
				'options' => array(
					'route' => '/blog',
					'defaults' => array(
						'controller' => 'Blog\Controller\List',
						'action' => 'index',
					)
				),
				
				'may_terminate' => true,
				'child_routes' => array(
					'detail' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/:id',
							'defaults' => array(
								'action' => 'detail',
							),
							'constraints' => array(
								'id' => '[1-9]\d*',
							)
						)
					),
						
					'print' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/print/:action/:id',
							'defaults' => array(
								'controller' => 'Blog\Controller\Print' ,
								'action' => 'printToWord',
							),
							
							'constraints' => array(
								'id' => '[1-9]\d*',
							)
						)
					),
						
				'add' => array(
						'type' => 'literal',
						'options' => array(
								'route' => '/add',
								'defaults' => array(
										'controller' => 'Blog\Controller\Write',
										'action' => 'add',
								)
						)
				),
						
						'edit' => array(
								'type' => 'segment',
								'options' => array(
										'route' => '/edit/:id',
										'defaults' => array(
												'controller' => 'Blog\Controller\Write',
												'action' => 'edit',
										),
										
										'constraints' => array(
												'id' => '[1-9]\d*',
										)
								)
						),
						
						'delete' => array(
								'type' => 'segment',
								'options' => array(
										'route' => '/delete/:id',
										'defaults' => array(
												'controller' => 'Blog\Controller\Write',
												'action' => 'delete',
										),
						
										'constraints' => array(
												'id' => '[1-9]\d*',
										)
								)
						)
				)
			)
		)
	),
	
	'view_manager' => array(
			'template_path_stack' => array(
					__DIR__ . '/../view',
			),
	),
	
);