<?php

namespace Honeymustard\FieldFactory\Library;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Collections\CondsList;
use Honeymustard\FieldFactory\Conds\Cond;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Paths;
use Honeymustard\FieldFactory\Library\AbstractLibrary;

/**
 * A link field implementation.
 */
class CommonLink extends AbstractLibrary
{
    /**
     * Get the translations map.
     *
     * @return string[] A map of translation files.
     */
    protected function getTranslations()
    {
        return [
            'en_US' => Paths::resource('CommonLink.en.yml'),
            'nb_NO' => Paths::resource('CommonLink.no.yml'),
        ];
    }

    /**
     * Get the default arguments.
     *
     * @return string[] A list of arguments.
     */
    protected function getDefaultArgs()
    {
        return [
            'title' => true,
            'style' => false,
            'types' => ['none', 'internal', 'external'],
        ];
    }

    /**
     * Get the list of fields.
     *
     * @return AbstractField[]
     */
    protected function getFields()
    {
        return $this->filterFields([
            'type'     => new Fields\Radio($this->getType()),
            'title'    => new Fields\Text($this->getTitle()),
            'style'    => new Fields\Radio($this->getStyle()),
            'internal' => new Fields\PostObject($this->getInternal()),
            'external' => new Fields\URL($this->getExternal()),
            'document' => new Fields\PostObject($this->getDocument()),
            'email'    => new Fields\Email($this->getEmail()),
            'anchor'   => new Fields\Text($this->getAnchor()),
            'archive'  => new Fields\Select($this->getArchive()),
        ]);
    }

    /**
     * Filter the field list before merge.
     *
     * @param string[] $fields List of fields.
     *
     * @return string[] List of fields.
     */
    protected function filterFields($fields)
    {
        $args = $this->getSettings();

        if (!Maps::true('title', $args)) {
            unset($fields['title']);
        }

        if (!Maps::true('style', $args)) {
            unset($fields['style']);
        }

        return $fields;
    }

    /**
     * Get list of type choices.
     *
     * @return string[] A list of choices.
     */
    protected function getTypeChoices()
    {
        $args = $this->getSettings();

        $types = [
            'none'     => $this->localize('type.none'),
            'internal' => $this->localize('type.internal'),
            'external' => $this->localize('type.external'),
            'document' => $this->localize('type.document'),
            'email'    => $this->localize('type.email'),
            'archive'  => $this->localize('type.archive'),
        ];

        return array_intersect_key($types, array_flip($args['types']));
    }

    /**
     * Get the field key for link type.
     *
     * @return string
     */
    public function getTypeKey()
    {
        return $this->getKey('type');
    }

    /**
     * Get the link type arguments.
     *
     * @return string[]
     */
    protected function getType()
    {
        return [
            'key'     => $this->getTypeKey(),
            'label'   => $this->localize('field.type.label'),
            'name'    => $this->getName('type'),
            'instr'   => $this->localize('field.type.instr'),
            'choices' => $this->getTypeChoices(),
            'default' => 'none',
        ];
    }

    /**
     * Get link style field.
     *
     * @return string[]
     */
    protected function getStyle()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '!=', 'none'));

        return [
            'key'     => $this->getKey('style'),
            'label'   => $this->localize('field.style.label'),
            'name'    => $this->getName('style'),
            'instr'   => $this->localize('field.style.instr'),
            'choices' =>  [
                'regular' => $this->localize('misc.regular'),
                'button'  => $this->localize('misc.button'),
            ],
            'default' => 'regular',
            'conds'   => $conds,
        ];
    }

    /**
     * Get link title field.
     *
     * @return string[]
     */
    protected function getTitle()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '!=', 'none'));

        return [
            'key'       => $this->getKey('title'),
            'label'     => $this->localize('field.title.label'),
            'name'      => $this->getName('title'),
            'instr'     => $this->localize('field.title.instr'),
            'conds'     => $conds,
        ];
    }

    /**
     * Get post object field for documents.
     *
     * @return string[]
     */
    protected function getDocument()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'document'));

        return [
            'key'       => $this->getKey('doc'),
            'label'     => $this->localize('field.document.label'),
            'name'      => $this->getName('doc'),
            'instr'     => $this->localize('field.document.instr'),
            'conds'     => $conds,
            'post_type' => [
                '0' => 'attachment',
            ],
        ];
    }

    /**
     * Get post object field for email adress.
     *
     * @return string[]
     */
    protected function getEmail()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'email'));

        return [
            'key'   => $this->getKey('email'),
            'label' => $this->localize('field.email.label'),
            'name'  => $this->getName('email'),
            'instr' => $this->localize('field.email.instr'),
            'conds' => $conds,
        ];
    }

    /**
     * Get internal post object field.
     *
     * @return string[]
     */
    protected function getInternal()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'internal'));

        return [
            'key'       => $this->getKey('internal'),
            'label'     => $this->localize('field.internal.label'),
            'name'      => $this->getName('internal'),
            'instr'     => $this->localize('field.internal.instr'),
            'post_type' => ['post', 'page'],
            'conds'     => $conds,
        ];
    }

    /**
     * Get external link url field.
     *
     * @return string[]
     */
    protected function getExternal()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'external'));

        return [
            'key'   => $this->getKey('external'),
            'label' => $this->localize('field.external.label'),
            'name'  => $this->getName('external'),
            'instr' => $this->localize('field.external.instr'),
            'conds' => $conds,
        ];
    }

    /**
     * Get anchor field.
     *
     * @return string[]
     */
    protected function getAnchor()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'internal'));

        return [
            'key'       => $this->getKey('anchor'),
            'label'     => $this->localize('field.anchor.label'),
            'name'      => $this->getName('anchor'),
            'instr'     => $this->localize('field.anchor.instr'),
            'maxlength' => 50,
            'conds'     => $conds,
        ];
    }

    /**
     * Get archive choice field.
     *
     * @return string[]
     */
    protected function getArchive()
    {
        $conds = new CondsList();
        $conds->subjoin(new Cond($this->getTypeKey(), '==', 'archive'));

        return [
            'key'     => $this->getKey('archive'),
            'label'   => $this->localize('field.archive.label'),
            'name'    => $this->getName('archive'),
            'instr'   => $this->localize('field.archive.instr'),
            'conds'   => $conds,
            'choices' => ['post', 'page'],
        ];
    }
}
