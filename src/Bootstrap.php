<?php

namespace phuongdev89\migration;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\gii\Module;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        /**@var Module $gii */
        if ($app->hasModule('gii') && $gii = $app->getModule('gii')) {
            if (!isset($gii->generators['migration'])) {
                $gii->generators['migration'] = 'phuongdev89\migration\gii\Generator';
            }
        }
    }
}
