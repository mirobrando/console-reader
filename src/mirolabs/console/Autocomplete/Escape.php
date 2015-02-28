<?php

namespace mirolabs\console\Autocomplete;

use mirolabs\console\AutocompleteCommand;
use mirolabs\console\OutputInterface;

class Escape implements AutocompleteCommand
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
        if($hintMessage != '') {
            for($i = 0; $i < mb_strlen($hintMessage, "utf-8"); $i++) {
                $this->output->write("\033[1D");
            }
            $this->output->write("\033[K");
            $hintIndex = 0;
            $hintMessage = '';
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