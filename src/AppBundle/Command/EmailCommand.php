<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:email_command')
            ->setDescription('Hello PhpStorm')
            ->setHelp('This command let u send emails ....')
             ->addArgument('email', InputArgument::REQUIRED, 'The email of the receiver.')
            // ...
        ;;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if($this->sendEmail($input->getArgument('email'), 'test email')) {
            $output->writeln('success, the email was send');
        }else{
            $output->writeln('fail, the email did not send');
        }

    }


}
