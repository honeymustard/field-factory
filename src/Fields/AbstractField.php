<?php

namespace Honeymustard\FieldFactory\Fields;

use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Translator;
use Honeymustard\FieldFactory\Abilities\Mergable;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all fields.
 */
abstract class AbstractField
{
    use Mergable;

    private $type = '';
    private $args = [];
    private $translator = null;

    /**
     * Construct a new field.
     *
     * @param string $type   The type of the field.
     * @param string[] $args A list of field arguments.
     */
    public function __construct($type, $args)
    {
        $this->type = $type;
        $this->args = $args;
        $this->translator = new Translator(new FieldDictionary());
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    final protected function getDefaultArgs()
    {
        return [
            'key'       => '',
            'type'      => $this->getType(),
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
     * Get the default arguments from the concrete field.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [];
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
        Maps::require('key', $args);
        Maps::require('name', $args);

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
     * Get the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Convert field to an array.
     *
     * @return string[]
     */
    final public function toArray()
    {
        return $this->parse([
            $this->getDefaultArgs(),
            $this->getFieldArgs(),
            $this->getArgs(),
        ]);
    }
}
