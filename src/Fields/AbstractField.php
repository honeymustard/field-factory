<?php

namespace Honeymustard\FieldFactory\Fields;

use Honeymustard\FieldFactory\Utils;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all fields.
 */
abstract class AbstractField
{
    private $name = '';
    private $translator = null;
    private $args = [];

    /**
     * Construct a new field.
     *
     * @param string $name   The name of the field.
     * @param string[] $args A list of field arguments.
     */
    public function __construct($name, $args)
    {
        $this->name = $name;
        $this->translator = new Utils\Translator(new FieldDictionary());
        $this->args = $this->parse($args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getDefaultArgs()
    {
        return [
            'key'       => '',
            'type'      => $this->getName(),
            'label'     => '',
            'name'      => '',
            'instr'     => '',
            'required'  => 0,
            'conds'     => 0,
            'wrapper'   => $this->getWrapArgs(),
            'placement' => 'top',
        ];
    }

    /**
     * Parse a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function parse($args)
    {
        $a = $this->getDefaultArgs();
        $b = $this->getFieldArgs();

        return $this->verify($this->merge($a, $this->merge($b, $args)));
    }

    /**
     * Merge a list of arguments
     *
     * @param string[] $a List of arguments.
     * @param string[] $b List of arguments.
     *
     * @return string[]
     */
    protected function merge($a, $b)
    {
        return array_merge($this->translate($a), $this->translate($b));
    }

    /**
     * Translate a list of arguments
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function translate($args)
    {
        return $this->getTranslator()->translate($args);
    }

    /**
     * Verify a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function verify($args)
    {
        Utils\Maps::require('key', $args);
        Utils\Maps::require('name', $args);

        return $args;
    }

    /**
     * Get the default wrapper arguments.
     *
     * @return string[]
     */
    protected function getWrapArgs()
    {
        return [
            'width' => '',
            'class' => '',
            'id'    => '',
        ];
    }

    /**
     * Get the translator.
     *
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }
}
