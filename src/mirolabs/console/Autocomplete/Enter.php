<?php

namespace mirolabs\console\Autocomplete;


use mirolabs\console\AutocompleteCommand;

class Enter implements AutocompleteCommand
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
        $result .= $hintMessage;
        fwrite($this->output, $char);

        return $result;
    }

    /**
     * @return bool
     */
    public function isEnd()
    {
        return true;
    }
} 