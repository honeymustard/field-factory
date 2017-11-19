<?php

namespace Honeymustard\FieldFactory\Assemblers;

use Honeymustard\FieldFactory\Abilities\AssemblyTrait;
use Honeymustard\FieldFactory\Interfaces\AssemblyInterface;
use Honeymustard\FieldFactory\Utils\URL;

/**
 * Assembly class for the CommonLink field.
 */
class CommonLink implements AssemblyInterface
{
    use AssemblyTrait;

    /**
     * Construct a new CommonLink assembler.
     *
     * @param string         $name The field name.
     * @param string|integer $type The ACF Field type.
     */
    public function __construct($name, $type = '')
    {
        $this->parse($name, $type);
    }

    /**
     * Assemble and return field as a data object.
     *
     * @param string         $name The field name.
     * @param string|integer $type The ACF field type.
     *
     * @return StdClass
     */
    public static function assemble($name, $type = '')
    {
        $link = new CommonLink($name, $type);
        return $link->getData();
    }

    /**
     * Get the link data.
     *
     * @return StdClass
     */
    public function getData()
    {
        $data = new \StdClass;
        $data->url = $this->getUrl();
        $data->title = $this->getTitle();
        $data->anchor = $this->getAnchor();

        return $data;
    }

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    protected function getFields()
    {
        return [
            'title',
            'style',
            'type',
            'internal',
            'external',
            'document',
            'email',
            'archive',
            'anchor',
        ];
    }

    /**
     * Get the complete url.
     *
     * @return string
     */
    public function getUrl()
    {
        switch ($this->getType()) {
            case 'internal':
                return $this->getInternalUrl();
            case 'external':
                return $this->getExternalUrl();
            case 'archive':
                return $this->getArchiveUrl();
            case 'document':
                return $this->getDocumentUrl();
            case 'email':
                return $this->getEmailUrl();
        }

        return '';
    }

    /**
     * If link is an internal link.
     *
     * @return boolean
     */
    public function isInternal()
    {
        return $this->getType() === 'internal';
    }

    /**
     * If link is an external link.
     *
     * @return boolean
     */
    public function isExternal()
    {
        return $this->getType() === 'external';
    }

    /**
     * If link is a document link.
     *
     * @return boolean
     */
    public function isDocument()
    {
        return $this->getType() === 'document';
    }

    /**
     * If link is an archive link.
     *
     * @return boolean
     */
    public function isArchive()
    {
        return $this->getType() === 'archive';
    }

    /**
     * If link is an email link.
     *
     * @return boolean
     */
    public function isEmail()
    {
        return $this->getType() === 'email';
    }

    /**
     * Get the link title.
     *
     * @return string
     */
    public function getTitle()
    {
        $title = $this->getField('title');
        if (!empty($title)) {
            return $title;
        }

        /* fallback to post title */
        if ($this->isInternal()) {
            return get_the_title($this->getInternal());
        }

        /* fallback to url as title */
        if ($this->isExternal()) {
            return $this->getUrl();
        }

        return '';
    }

    /**
     * Get the archive url.
     *
     * @return string
     */
    public function getArchiveUrl()
    {
        return get_post_type_archive_link($this->getArchive());
    }

    /**
     * Get the internal url.
     *
     * @return string
     */
    public function getInternalUrl()
    {
        $url = get_the_permalink($this->getInternal());
        return URL::appendAnchor($url, $this->getAnchor());
    }

    /**
     * Get the external url.
     *
     * @return string
     */
    public function getExternalUrl()
    {
        return $this->getField('external');
    }

    /**
     * Get the document url.
     *
     * @return string
     */
    public function getDocumentUrl()
    {
        return wp_get_attachment_url($this->getField('document'));
    }

    /**
     * Get the email url.
     *
     * @return string
     */
    public function getEmailUrl()
    {
        return 'mailto:'.$this->getEmail();
    }

    /**
     * Get link anchor without pound sign.
     *
     * @return string
     */
    public function getAnchor()
    {
        return URL::filterAnchor($this->getField('anchor'));
    }

    /**
     * Get the internal value.
     *
     * @return integer
     */
    public function getInternal()
    {
        if ($this->isInternal()) {
            return $this->getField('internal');
        }

        trigger_error('only internal links have post id\'s', E_USER_WARNING);
        return -1;
    }

    /**
     * Get link type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->getField('type');
    }

    /**
     * Get the style value.
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->getField('style');
    }

    /**
     * Get the email value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getField('email');
    }

    /**
     * Get the archive value.
     *
     * @return string
     */
    public function getArchive()
    {
        return $this->getField('archive');
    }

    /**
     * Get the class prefix.
     *
     * @return string
     */
    public function getClassPrefix()
    {
        return 'link__';
    }

    /**
     * Get class string associated with this link.
     *
     * @return string
     */
    public function getClasses()
    {
        $classes = [];
        $prefix = $this->getClassPrefix();

        $type = $this->getType();

        if ($type) {
            $classes[] = $prefix . $type;
        }

        if (!empty($this->getAnchor())) {
            $classes[] = $prefix . 'anchor';
        }

        return implode($classes, ' ');
    }
}
