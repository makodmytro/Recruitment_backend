<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateRandomPostCommand extends Command
{
    protected static $defaultName = 'app:generate-random-post';
    protected static $defaultDescription = 'Run app:generate-random-post';

    private EntityManagerInterface $em;
    private LoremIpsum $loremIpsum;

    public function __construct(EntityManagerInterface $em, LoremIpsum $loremIpsum, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->loremIpsum = $loremIpsum;
    }

    protected function configure(): void
    {
        $this
        ->setDescription('Generate 3 random posts and 1 special summary post')
        ->addArgument('hour', InputArgument::OPTIONAL, 'The hour of the summary post generation');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $now = new \DateTime();
        $hour = $input->getArgument('hour');

        // Generate 3 random posts
        for ($i = 0; $i < 3; $i++) {
            $title = $this->loremIpsum->words(mt_rand(4, 6));
            $content = $this->loremIpsum->paragraphs(2);

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setCreatedAt($now);
            $this->em->persist($post);
        }

        // Generate 1 summary post at the specified hour (default at 12pm)
        if (!$hour) {
            $hour = 12; // Default to 12pm
        }
        if ($now->format('H') == $hour) {
            $title = sprintf('Summary %s', $now->format('Y-m-d'));
            $content = $this->loremIpsum->paragraphs(1);

            $post = new Post();
            $post->setTitle($title);
            $post->setContent($content);
            $post->setCreatedAt($now);
            $this->em->persist($post);
        }

        $this->em->flush();

        $output->writeln('Random posts have been generated.');

        return Command::SUCCESS;
    }
}
