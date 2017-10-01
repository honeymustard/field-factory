<?php

namespace Honeymustard\FieldFactory\Utils;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\YamlFileLoader;

/**
 * Localization support for strings that uses Yaml.
 */
class Locale
{
    private $locale = '';
    private $translator = null;

    /**
     * Construct a new locale object.
     *
     * @param string $locale The default locale.
     */
    public function __construct($locale = '')
    {
        $this->locale = empty($locale) ? get_locale() : $locale;
        $this->translator = new Translator($this->locale);
        $this->translator->addLoader('yaml', new YamlFileLoader());
    }

    /**
     * Add translation resources.
     *
     * @param string[] $map A map with locale to path entries.
     *
     * @return void
     */
    public function addResources($map)
    {
        if (!empty($map)) {
            foreach ($map as $locale => $file) {
                $this->translator->addResource('yaml', $file, $locale);
            }
        }
    }

    /**
     * Translate a given string.
     *
     * @param string $string A string to be translated.
     *
     * @return string The translated string.
     */
    public function trans($string)
    {
        return $this->translator->trans($string);
    }
}
