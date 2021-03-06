<?php
namespace Theapi\CctvBundle\Command;

use Theapi\CctvBundle\MailParser;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface;

class InboxCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('cctv:inbox')
            ->setDescription('Mail inbox for handling incoming mail')
            ->setHelp('
The <info>%command.name%</info> command process incoming mail from an MTA (Postfix).
In ~/.redirect for the mail box to be processed, put:
  <info>"| php %kernel.root_dir% %command.name%"</info>
            ')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $container = $this->getContainer();

      $mailParser = $container->get('theapi_cctv.mail_parser');
      $mailParser->processIncomingMail();
    }

}
