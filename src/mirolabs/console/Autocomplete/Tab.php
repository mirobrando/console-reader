<?php

namespace mirolabs\console\Autocomplete;


use mirolabs\console\AutocompleteCommand;

class Tab implements AutocompleteCommand
{
    private $output;

    /**
     * @var array;
     */
    private $hints;


    public function __construct($output, $hints)
    {
        $this->output = $output;
        $this->hints = $hints;
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
            $hint = $this->getHint($result, $hintIndex);
            if ($hint != '') {
                $hintMessage = substr($hint, strlen($result));
                fwrite($this->output, sprintf("\033[30;47m%s\033[39;49m",$hintMessage));
            }
        }

        return $result;
    }

    public function getHint($result, &$hintIndex)
    {
        if($result == '') {
            $hintIndex = 0;
            return $this->hints[0];
        }

        $i = 0;
        foreach ($this->hints as $hint) {
            $pattern = '/^' . $result . '/';
            if (@preg_match($pattern, $hint)) {
                $hintIndex = $i;
                return $hint;
            }
        }

        return '';
    }


    /**
     * @return bool
     */
    public function isEnd()
    {
        return false;
    }

} 