<?php

namespace mirolabs\console\Autocomplete;


use mirolabs\console\AutocompleteCommand;
use mirolabs\console\Output\Style;
use mirolabs\console\OutputInterface;

class Tab implements AutocompleteCommand
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
        if ($hintMessage == '') {
            $hint = $this->getHint($result, $hintIndex);
            if ($hint != '') {
                $hintMessage = mb_substr($hint, mb_strlen($result, "utf-8"), null, "utf-8");
                $this->output->writeStyle($hintMessage, new Style('black', 'white', ''));
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