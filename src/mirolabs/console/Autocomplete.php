<?php

namespace mirolabs\console;


use mirolabs\console\Autocomplete\Backspace;
use mirolabs\console\Autocomplete\Enter;
use mirolabs\console\Autocomplete\Escape;
use mirolabs\console\Autocomplete\Next;
use mirolabs\console\Autocomplete\Normal;
use mirolabs\console\Autocomplete\Previous;
use mirolabs\console\Autocomplete\Tab;

class Autocomplete
{

    const KEY_DEFAULT = 'default';
    const KEY_BACKSPACE = "\177";
    const KEY_ENTER = "\n";
    const KEY_TAB = "\t";
    const KEY_ESC = "\027";
    const KEY_OTHER = "\033";
    const KEY_UP = "up";
    const KEY_DOWN = "down";


    private $input;

    private $output;

    /**
     * @var array
     */
    private $hints;

    /**
     * @var string
     */
    private $result = '';

    /**
     * @var array
     */
    private $commands = [];

    private $hintIndex = 0;

    private $hintMessage = '';


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
     * @param array $hints
     */
    public function setHints($hints)
    {
        $this->hints = $hints;
        $this->setCommands();
    }


    /**
     * @return string
     * @throws \RuntimeException
     */
    public function getAnswer()
    {
        $sttyMode = shell_exec('stty -g');
        shell_exec('stty -icanon -echo');

        try {
            while (!feof($this->input)) {
                $char = fread($this->input, 1);
                $command = $this->getCommand($char);
                $this->result = $command->execute($this->result, $char, $this->hintIndex, $this->hintMessage);
                if ($command->isEnd()) {
                    break;
                }
            }
        } catch (\Exception $e) {
        }
        shell_exec(sprintf('stty %s', $sttyMode));

        return $this->result;
    }

    private function setCommands()
    {
        $this->commands[self::KEY_BACKSPACE] = new Backspace($this->output, $this->hints);
        $this->commands[self::KEY_ENTER] = new Enter($this->output, $this->hints);
        $this->commands[self::KEY_DEFAULT] = new Normal($this->output, $this->hints);
        $this->commands[self::KEY_TAB] = new Tab($this->output, $this->hints);
        $this->commands[self::KEY_ESC] = new Escape($this->output, $this->hints);
        $this->commands[self::KEY_UP] = new Next($this->output, $this->hints);
        $this->commands[self::KEY_DOWN] = new Previous($this->output, $this->hints);
    }

    /**
     * @param string char
     * @return AutocompleteCommand
     */
    private function getCommand($char)
    {

        if ($char == self::KEY_TAB && $this->hintMessage != '') {
            return $this->commands[self::KEY_UP];
        }

        if ($char == self::KEY_OTHER && $this->hintMessage != '') {
            $char .= fread($this->input, 2);
            if (isset($char[2]) && $char[2] == 'A') {
                return $this->commands[self::KEY_UP];
            }
            if (isset($char[2]) && $char[2] == 'B') {
                return $this->commands[self::KEY_DOWN];
            }
        }


        if (array_key_exists($char, $this->commands)) {
            return $this->commands[$char];
        }

        return $this->commands[self::KEY_DEFAULT];
    }

} 