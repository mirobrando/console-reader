<?php

namespace mirolabs\console\Autocomplete;

use mirolabs\console\AutocompleteCommand;

class Normal implements AutocompleteCommand
{
    private $output;


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
            fwrite($this->output, $char);
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