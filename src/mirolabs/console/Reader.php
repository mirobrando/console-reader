<?php

namespace mirolabs\console;


class Reader
{

    private static $stty;

    private $input;

    private $output;

    public function __construct()
    {
        $this->input = STDIN;
        $this->output = STDOUT;
    }



    /**
     * @param string $question
     * @param array $hints
     * @return string
     */
    public function getAnswer($question, $hints = [])
    {
        fwrite($this->output, $question . " ");

        if ($this->hasSttyAvailable() && is_array($hints) && count($hints) > 0) {
            $reader = new Autocomplete($this->input, $this->output);
            $reader->setHints($hints);
        } else {
            $reader = new Simple($this->input, $this->output);
        }

        return $reader->getAnswer();
    }



    private function hasSttyAvailable()
    {
        if (null !== self::$stty) {
            return self::$stty;
        }
        exec('stty 2>&1', $output, $exitcode);
        return self::$stty = $exitcode === 0;
    }


}
