<?php

namespace Honeymustard\FieldFactory\Library\Links;

/**
 * Create a link by passing arguments.
 */
class DummyLink extends AbstractLink
{
    /**
     * Construct new link from arguments.
     *
     * @param string[] $args List of arguments.
     */
    public function __construct($args)
    {
        $this->title = Utils::getKey('title', $args);
        $this->style = Utils::getKey('style', $args);
        $this->type = Utils::getKey('type', $args);
        $this->int = Utils::getKey('internal', $args);
        $this->doc = Utils::getKey('document', $args);
        $this->email = Utils::getKey('email', $args);
        $this->ext = Utils::getKey('external', $args);
        $this->archive = Utils::getKey('archive', $args);
        $this->anchor = Utils::getKey('anchor', $args);
        $this->trigger = Utils::getKey('trigger', $args);
    }
}
