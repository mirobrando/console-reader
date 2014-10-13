<?php

namespace mirolabs\console;


class Simple implements ReaderInterface
{

    private $input;

    private $output;

    /**
     * @param $input
     * @param $output
     */
    public function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function getAnswer()
    {
        $result = fgets($this->input);
        if ($result === false) {
            throw new \RuntimeException('Aborted');
        }

        return trim($result);
    }

} 