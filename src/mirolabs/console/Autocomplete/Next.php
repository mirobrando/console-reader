<?php

namespace mirolabs\console\Autocomplete;


use mirolabs\console\AutocompleteCommand;
use mirolabs\console\Output\Style;
use mirolabs\console\OutputInterface;

class Next implements AutocompleteCommand
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var array;
     */
    private $hints;

    /**
     * @param OutputInterface $output
     * @param $hints
     */
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
        $this->clearHint($hintMessage);
        if($hintMessage != '') {
            $hint = $this->getHint($result, $hintIndex);
            $hintMessage = substr($hint, strlen($result));
            $this->output->writeStyle($hintMessage, new Style('black', 'white'));
        }

        return $result;
    }

    private function clearHint($hintMessage)
    {
        for($i=0; $i<strlen($hintMessage); $i++) {
            $this->output->write("\033[1D");
        }
        $this->output->write("\033[K");
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