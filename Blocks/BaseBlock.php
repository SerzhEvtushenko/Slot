<?php
/*
 * This file is a part of Solve framework.
 *
 * @author Alexandr Viniychuk <alexandr.viniychuk@icloud.com>
 * @copyright 2009-2014, Alexandr Viniychuk
 * created: 05.01.14 10:16
 */

namespace Solve\Slot\Blocks;
use Solve\Slot\Compiler;


/**
 * Class BaseBlock
 * @package Solve\Slot
 *
 * Class BaseBlock describes basic block methods
 *
 * @version 1.0
 * @author Alexandr Viniychuk <alexandr.viniychuk@icloud.com>
 */
abstract class BaseBlock {

    /**
     * @var string parsed
     */
    protected $_token;

    protected $_params      = array();

    protected $_modifiers   = array();

    /**
     * @var Compiler
     */
    protected $_compiler;

    protected $_id;

    protected static $_idCounter = 0;

    public function __construct($token, $compiler) {
        $this->_token    = $token;
        $this->_compiler = $compiler;
        $this->_id       = ++self::$_idCounter;
        $this->_params   = $this->_compiler->parseSpacedArguments($token);
        if (strpos($this->_token, '|') !== false) {
            $modifiers = array();
            preg_match_all('#(\|[\w]+)+$#is', $token, $modifiers);
            if (!empty($modifiers[0])) {
                $this->_modifiers = explode('|', substr($modifiers[0][0], 1));
                array_pop($this->_params);
            }
        }
    }

    protected function hasModifier($modifier) {
        return in_array($modifier, $this->_modifiers);
    }

    public function processBlockStart() {
        return 'BaseBlock start';
    }

    public function processBlockEnd() {
        return 'BaseBlock end';
    }



} 