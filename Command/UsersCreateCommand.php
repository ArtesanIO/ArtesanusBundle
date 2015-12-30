<?php

namespace ArtesanIO\ArtesanusBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UsersCreateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('artesanus:users:create')
            ->setDescription('Greet someone')
            // ->addArgument(
            //     'name',
            //     InputArgument::OPTIONAL,
            //     'Who do you want to greet?'
            // )
            // ->addOption(
            //     'yell',
            //     null,
            //     InputOption::VALUE_NONE,
            //     'If set, the task will yell in uppercase letters'
            // )
            ->setDefinition(array(
                new InputArgument('user', InputArgument::REQUIRED, 'The name'),
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password')
            ))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userManager = $this->getContainer()->get('artesanus.users_manager');
        $user = $userManager->create();

        $user->setUser($input->getArgument('user'));
        $user->setUsername($input->getArgument('username'));
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($input->getArgument('password'));

        $userManager->save($user);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $input->getArgument('username')));
    }

}
