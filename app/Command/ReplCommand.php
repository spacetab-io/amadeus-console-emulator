<?php namespace App\Command;

use App\Classes\Cryptic;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ReplCommand extends Command
{

    protected function configure()
    {
        $this->setName('cryptic')->setDescription('Command Cryptic console emulator');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to Amadeus Command Cryptic Console emulator!</info>');
        $helper   = $this->getHelper('question');
        $question = new Question('> ');
        $cryptic  = new Cryptic();
        while (true) {
            $command = $helper->ask($input, $output, $question);

            if ($command) {
                if (in_array($command, ['jo', 'JO', 'exit', 'EXIT', 'quit', 'QUIT'])) {
                    $output->writeln('<info>Goodbye my friend!</info>');

                    return;
                }

                try {
                    ob_start();
                    echo $cryptic->passEntry($command)->response->longTextString->textStringDetails;
                    $out = ob_get_clean();
                    if ( ! $out) {
                        $out = 'No command!';
                    }
                    $output->writeln($out);
                } catch (\ParseError $e) {
                    $output->writeln(sprintf('<error>Could not parse: %s</error>', $command));
                    $output->writeln($e->getMessage());
                }
            }
        }
    }
}