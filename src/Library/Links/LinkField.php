<?php

namespace Honeymustard\FieldFactory\Library\Links;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Collections\CondsList;
use Honeymustard\FieldFactory\Conds\Cond;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Library\AbstractLibrary;

/**
 * A link field implementation.
 */
class LinkField extends AbstractLibrary
{
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
            'none'     => esc_html__('None', 'field-factory'),
            'internal' => esc_html__('Internal', 'field-factory'),
            'external' => esc_html__('External', 'field-factory'),
            'document' => esc_html__('Document', 'field-factory'),
            'email'    => esc_html__('E-mail', 'field-factory'),
            'archive'  => esc_html__('Archive', 'field-factory'),
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
            'label'   => esc_html__('Link', 'field-factory'),
            'name'    => $this->getName('type'),
            'instr'   => esc_html__('Select the type of link that you want.', 'field-factory'),
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
            'label'   => esc_html__('Link style', 'field-factory'),
            'name'    => $this->getName('style'),
            'instr'   => esc_html__('Select the type of appearance for this link.', 'field-factory'),
            'choices' =>  [
                'regular' => esc_html__('Regular', 'field-factory'),
                'button'  => esc_html__('Button', 'field-factory'),
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
            'label'     => esc_html__('Link title', 'field-factory'),
            'name'      => $this->getName('title'),
            'instr'     => esc_html__('Add a custom title.', 'field-factory'),
            'maxlength' => '',
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
            'label'     => esc_html__('Link to document', 'field-factory'),
            'name'      => $this->getName('doc'),
            'instr'     => esc_html__('Select a link to a document.', 'field-factory'),
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
            'label' => esc_html__('E-mail address', 'field-factory'),
            'name'  => $this->getName('email'),
            'instr' => esc_html__('Add a recipient e-mail address.', 'field-factory'),
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
            'label'     => esc_html__('Link to page', 'field-factory'),
            'name'      => $this->getName('internal'),
            'instr'     => esc_html__('Select an internal post link.', 'field-factory'),
            'post_type' => ['post', 'page'],
            'conds'     => $conds,
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
            'label'     => esc_html__('Link anchor', 'field-factory'),
            'name'      => $this->getName('anchor'),
            'instr'     => esc_html__('Add an anchor to a specific page section e.g. #section-name.', 'field-factory'),
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
            'label'   => esc_html__('Link to archive', 'field-factory'),
            'name'    => $this->getName('_archive'),
            'instr'   => esc_html__('Select a link to a post archive.', 'field-factory'),
            'conds'   => $conds,
            'choices' => ['post', 'page'],
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
            'label' => esc_html__('Link to page', 'field-factory'),
            'name'  => $this->getName('external'),
            'instr' => esc_html__('Add an external link. Must include http:// or https://.', 'field-factory'),
            'conds' => $conds,
        ];
    }
}
