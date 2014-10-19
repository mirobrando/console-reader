<?php

namespace mirolabs\console;


class Simple implements ReaderInterface
{

    private $input;

    /**
     * @param $input
     * @param OutputInterface $output
     */
    public function __construct($input, $output)
    {
        $this->input = $input;
    }

    /**
     * @param string $default
     * @return string
     * @throws \RuntimeException
     */
    public function getAnswer($default = '')
    {
        $result = fgets($this->input);
        if ($result === false) {
            if ($default == '') {
                throw new \RuntimeException('Aborted');
            }
            $result = $default;
        }

        return trim($result);
    }

} 