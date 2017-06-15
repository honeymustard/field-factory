<?php

namespace Honeymustard\FieldFactory\Utils;

use Honeymustard\FieldFactory\Dictionaries;

/**
 * Controls translation of field arguments.
 */
class Translator
{
    private $dictionary = null;

    /**
     * Contruct a new translator.
     *
     * @param AbstractDictionary $dictionary
     */
    public function __construct(Dictionaries\AbstractDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Translate a given alias in a list.
     *
     * @param string $alias  A key alias.
     * @param string $name   Original acf key name.
     * @param string[] $args A list of field values.
     *
     * @return string[] translated list.
     */
    public function replace($alias, $name, $args)
    {
        if (isset($args[$alias])) {
            $data = $args[$alias];
            unset($args[$alias]);
            $args[$name] = $data;
        }

        return $args;
    }

    /**
     * Translate all arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[] Translated list.
     */
    public function translate($args)
    {
        $keys = $this->getDictionary()->getMap();

        foreach ($keys as $k => $v) {
            $args = $this->replace($k, $v, $args);
        }

        return $args;
    }

    /**
     * Get the dictionary.
     *
     * @return AbstractDictionary
     */
    public function getDictionary()
    {
        $this->dictionary;
    }
}
