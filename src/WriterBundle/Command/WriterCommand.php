<?php

namespace WriterBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WriterBundle\Classes\FactoryType\FactoryType;
use WriterBundle\Classes\FactoryWriter\FactoryWriter;

class WriterCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('writer:writer_command')
            ->setDescription('Hello PhpStorm')
            ->addArgument('type', InputArgument::REQUIRED, 'type of host?')
            ->addArgument('extension', InputArgument::REQUIRED, 'type of extension ?')
            ->addOption(
                'verbosee',
                've',
                InputOption::VALUE_REQUIRED,
                'u wanna print output?',
                true
            );
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $factoryInstance = FactoryType::getInstance(
            $input->getArgument('type'),
            $this->getContainer()->getParameter('Writer'),
            FactoryWriter::getInstance(
                $input->getArgument('extension')
            ));
        if( $input->getOption('verbosee') === 'true'){
            $output->writeln($factoryInstance->writeSimple());

        }else{
            $factoryInstance->writeFile();
        }

    }
}
