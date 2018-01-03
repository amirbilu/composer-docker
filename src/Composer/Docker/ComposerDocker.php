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

class ComposerDocker{

    private $composer;
    private $io;

    public function __construct($composer, $io){
        $this->composer = $composer;
        $this->io = $io;
    }

    private function execute($cmd, &$output=null, &$code=null){
        if($this->io->isDebug())
            $this->log(sprintf("executing command:  '%s'",  $cmd));


        $result = exec($cmd, $output, $code);

        if($this->io->isDebug())
            foreach($output as $line)
                $this->log($line);

        return $result;
    }

    private function log($message){
        return $this->io->writeln(sprintf("<info>composer-docker: %s</info>", $message ));
    }

    private function logError($message){
        return $this->io->writeln(sprintf("<error>composer-docker: %s</error>", $message ));
    }

    public function run(){
        $extra = $this->composer->getPackage()->getExtra();
        $tagsCmd = "";
        $pathCmd= ".";

        if(isset($extra['composer-docker'])){

            $options = $extra['composer-docker'];
            if(isset($options['tags'])){
                $tagsCmd = '-t ' . implode(' -t ', $options['tags']);
            }

            if(isset($options['path'])){
                $pathCmd = $options['path'];
            }

        }

        $output = [];
        $code = 0;
        $cmd = sprintf("docker build %s %s", $tagsCmd, $pathCmd);
        $this->execute($cmd, $output, $code);

        if($code > 0)
            $this->logError("fail to build image");
        else
            $this->log("image built sucessfully.");

    }
}

