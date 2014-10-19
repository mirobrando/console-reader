<?php

namespace mirolabs\console\Autocomplete;

use mirolabs\console\AutocompleteCommand;
use mirolabs\console\OutputInterface;

class Normal implements AutocompleteCommand
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
        if ($hintMessage == '') {
            $this->output->write($char);
            return $result . $char;
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