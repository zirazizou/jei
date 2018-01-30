<?php

namespace MailerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use MailerBundle\Classes\MailFactory;
use MailerBundle\Classes\MailerSender;

class MailerCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('mailer:mailer_command')
            ->setDescription('mail sender command')
            ->setHelp('mailer bundle to send mail ')
            ->addArgument('type', InputArgument::REQUIRED, 'type of host?')
            ->addArgument('email', InputArgument::REQUIRED, 'email ?')
            ->addOption(
                'verbosee',
                've',
                InputOption::VALUE_REQUIRED,
                'u wanna print email?',
                true
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factoryInstance = MailFactory::getInstance(
            $input->getArgument('type'),
            $this->getContainer()->getParameter('Mailer'),
            $this->getContainer()->get('templating'));
            $factoryInstance->setEmail($input->getArgument('email'));
        if( $input->getOption('verbosee') === 'true'){
            $output->writeln($factoryInstance->buildBody());

        }else{
            $output->writeln($input->getOption('verbosee'));
            $mailInstance = $this->getContainer()->get('mailersender');
            $mailInstance->sendEmail('');

        }



    }
}
