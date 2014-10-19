<?php

namespace mirolabs\console\Output;


class Style
{

    private static $textColors = [
        'black' => 30,
        'red' => 31,
        'green' => 32,
        'yellow' => 33,
        'blue' => 34,
        'magenta' => 35,
        'cyan' => 36,
        'white' => 37
    ];

    private static $backgroundColour = [
        'black' => 40,
        'red' => 41,
        'green' => 42,
        'yellow' => 43,
        'blue' => 44,
        'magenta' => 45,
        'cyan' => 46,
        'white' => 47
    ];

    private static $styles = [
        'bold' => 1,
        'underscore' => 4,
        'reverse' => 7,
        'conceal' => 8
    ];

    /**
     * @var int
     */
    private $color = 0;

    /**
     * @var int
     */
    private $background = 0;

    /**
     * @var int
     */
    private $style = 0;

    /**
     * @param string $color
     * @param string $background
     * @param string $style
     */
    public function __construct($color = '', $background = '', $style= '')
    {
        $this->setColor($color);
        $this->setBackground($background);
        $this->setStyle($style);
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        if (array_key_exists($color, self::$textColors)) {
            $this->color = self::$textColors[$color];
        }
    }

    /**
     * @param string $background
     */
    public function setBackground($background)
    {
        if (array_key_exists($background, self::$backgroundColour)) {
            $this->background = self::$backgroundColour[$background];
        }
    }

    /**
     * @param string $style
     */
    public function setStyle($style)
    {
        if (array_key_exists($style, self::$styles)) {
            $this->style = self::$styles[$style];
        }
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        $result = [];
        if ($this->color != 0) {
            $result[] = $this->color;
        }

        if ($this->background != 0) {
            $result[] = $this->background;
        }

        if ($this->style != 0) {
            $result[] = $this->style;
        }

        return implode(';', $result);
    }
} 