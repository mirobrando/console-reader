<?php

namespace mirolabs\console\Autocomplete;

use mirolabs\console\AutocompleteCommand;
use mirolabs\console\OutputInterface;

class Backspace implements AutocompleteCommand
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface $output
     * @param $hints
     */
    public function __construct($output, $hints)
    {
        $this->output = $output;
    }

    /**
     * @param string $result
     * @param string $char
     * @param int $hintIndex
     * @param string $hintMessage
     * @return string
     */
    public function execute($result, $char, &$hintIndex, &$hintMessage)
    {
        $len = strlen($result);

        if($hintMessage != '') {
            for($i=0; $i<strlen($hintMessage); $i++) {
                $this->output->write("\033[1D");
            }
            $this->output->write("\033[K");
            $hintIndex = 0;
            $hintMessage = '';
        } else if ($len > 0) {
            $this->output->write("\033[1D");
            $this->output->write("\033[K");
            $result = substr($result, 0, $len-1);
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function isEnd()
    {
        return false;
    }

} 