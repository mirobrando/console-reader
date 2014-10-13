<?php

namespace mirolabs\console\Autocomplete;


use mirolabs\console\AutocompleteCommand;

class Next implements AutocompleteCommand
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
        $hint = $this->getHint($result, $hintIndex);
        $this->clearHint($hintMessage);
        $hintMessage = substr($hint, strlen($result));
        fwrite($this->output, sprintf("\033[30;47m%s\033[39;49m",$hintMessage));

        return $result;
    }

    private function clearHint($hintMessage)
    {
        for($i=0; $i<strlen($hintMessage); $i++) {
            fwrite($this->output, "\033[1D");
        }
        fwrite($this->output, "\033[K");
    }

    public function getHint($result, &$hintIndex)
    {
        if($result == '')  {
            if(count($this->hints) > $hintIndex +1) {
                $hintIndex ++;
            }
            return $this->hints[$hintIndex];
        }

        for ($i = $hintIndex +1 ; $i< count($this->hints); $i++) {
            $pattern = '/^' . $result . '/';
            if (@preg_match($pattern, $this->hints[$i])) {
                $hintIndex = $i;
                return $this->hints[$i];
            }
        }

        return $this->hints[$hintIndex];
    }


    /**
     * @return bool
     */
    public function isEnd()
    {
        return false;
    }

} 