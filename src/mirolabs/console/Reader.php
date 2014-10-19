<?php

namespace mirolabs\console;


use mirolabs\console\Output\StandardOutput;

class Reader
{

    private static $stty;

    /**
     * @var resource
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface|mixed $output
     */
    public function __construct($output = null)
    {
        $this->input = STDIN;
        if ($output instanceof OutputInterface) {
            $this->output = $output;
        } else {
            $this->output = new StandardOutput();
        }
    }



    /**
     * @param string $question
     * @param string $default
     * @param array $hints
     * @return string
     */
    public function getAnswer($question, $default = '', $hints = [])
    {
        $this->output->writeFormat($question, 'question');
        if (!empty($default)) {
            $this->output->writeFormat('[' . $default . ']', 'info');
        }
        $this->output->write(': ');

        if ($this->hasSttyAvailable() && is_array($hints) && count($hints) > 0) {
            $reader = new Autocomplete($this->input, $this->output);
            $reader->setHints($hints);
        } else {
            $reader = new Simple($this->input, $this->output);
        }

        return $reader->getAnswer($default);
    }



    private function hasSttyAvailable()
    {
        if (null !== self::$stty) {
            return self::$stty;
        }
        exec('stty 2>&1', $output, $exitcode);
        return self::$stty = $exitcode === 0;
    }


}
