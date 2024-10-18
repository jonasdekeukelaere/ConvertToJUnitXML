<?php

namespace TijsVerkoyen\ConvertToJUnitXML\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TijsVerkoyen\ConvertToJUnitXML\Converters\ConverterInterface;

class ConvertStandardJsCommand extends Command
{
    /**
     * @var ConverterInterface
     */
    private $converter;

    public function __construct(ConverterInterface $converter)
    {
        $this->converter = $converter;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('convert:standardjs')
            ->setDescription(
                'Convert the output of standard to JUnit XML.'
            )
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                "The lines to convert"
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jUnitReport = $this->converter->convert(
            $input->getArgument('input')
        );

        $output->write($jUnitReport->__toString());

        if ($jUnitReport->hasFailures()) {
            return 1;
        }

        return 0;
    }
}
