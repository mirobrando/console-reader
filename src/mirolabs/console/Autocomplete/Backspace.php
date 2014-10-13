<?php

namespace mirolabs\console\Autocomplete;

use mirolabs\console\AutocompleteCommand;

class Backspace implements AutocompleteCommand
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
        $len = strlen($result);

        if($hintMessage != '') {
            for($i=0; $i<strlen($hintMessage); $i++) {
                fwrite($this->output, "\033[1D");
            }
            fwrite($this->output, "\033[K");
            $hintIndex = 0;
            $hintMessage = '';
        } else if ($len > 0) {
            fwrite($this->output, "\033[1D");
            fwrite($this->output, "\033[K");
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