<?php

namespace AppBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

//        $container->addCompilerPass(
//            DoctrineOrmMappingsPass::createYamlMappingDriver([
//                __DIR__.'/Resources/config/doctrine/' => 'Manuel\LocalBank\Account',
//            ],
//                [],
//                false,
//                ['AppBundle' => 'Manuel\LocalBank\Account']
//            )
//        );
    }

}
