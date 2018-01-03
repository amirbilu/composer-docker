<?php
namespace AmirBilu\Composer\Docker;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use RuntimeException;
use Composer\Script\ScriptEvents;
use Symfony\Component\Filesystem\Filesystem;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Plugin\Capable;

class Plugin implements PluginInterface, EventSubscriberInterface, Capable{

    public function activate(Composer $composer, IOInterface $io){
    }

    public static function getSubscribedEvents(){
        return array(
        );
    }


    public function getCapabilities(){
        return array(
            'Composer\Plugin\Capability\CommandProvider' => 'AmirBilu\Composer\Docker\CommandProvider',
       );
    }
}
