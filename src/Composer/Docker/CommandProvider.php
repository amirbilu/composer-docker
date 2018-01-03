<?php
namespace AmirBilu\Composer\Docker;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Command\BaseCommand;

class CommandProvider implements CommandProviderCapability
{
    public function getCommands(){
        return array(new DockerCommand);
    }
}

class DockerCommand extends BaseCommand{
    protected function configure(){
        $this->setName('docker');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $composerDocker = new ComposerDocker($this->getComposer(), $output);
        $composerDocker->run(); 
    }
}
