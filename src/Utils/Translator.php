<?php

namespace Honeymustard\FieldFactory\Utils;

use Honeymustard\FieldFactory\Interfaces\DictionaryInterface;

/**
 * Controls translation of field arguments.
 */
class Translator
{
    private $dictionary = null;

    /**
     * Contruct a new translator.
     *
     * @param DictionaryInterface $dictionary A dictionary instance.
     */
    public function __construct(DictionaryInterface $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Replace an alias in a list.
     *
     * @param string   $alias An alias.
     * @param string   $name  The translation name.
     * @param string[] $args  A list of arguments.
     *
     * @return string[] Translated list.
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
     * @return DictionaryInterface
     */
    public function getDictionary()
    {
        return $this->dictionary;
    }
}
