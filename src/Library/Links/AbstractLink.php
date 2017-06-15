<?php

namespace Honeymustard\FieldFactory\Library\Links;

use Honeymustard\FieldFactory\Utils;

/**
 * Abstract base class for links.
 */
abstract class AbstractLink
{
    protected $type = '';
    protected $title = '';
    protected $anchor = '';
    protected $style = '';
    protected $postID = -1;
    protected $externalUrl = '';
    protected $archiveType = '';
    protected $docID = -1;
    protected $email = '';
    protected $trigger = '';

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
                return 'mailto:' . $this->getEmail();
            case 'trigger':
                return = $this->getTriggerUrl();
        }

        return '';
    }

    /**
     * If link is an internal link.
     *
     * @return bool
     */
    public function isInternal()
    {
        return $this->getType() === 'internal';
    }

    /**
     * If link is an external link.
     *
     * @return bool
     */
    public function isExternal()
    {
        return $this->getType() === 'external';
    }

    /**
     * If link is a document link.
     *
     * @return bool
     */
    public function isDocument()
    {
        return $this->getType() === 'document';
    }

    /**
     * If link is an archive link.
     *
     * @return bool
     */
    public function isArchive()
    {
        return $this->getType() === 'archive';
    }

    /**
     * If link is a trigger link.
     *
     * @return bool
     */
    public function isTrigger()
    {
        return $this->getType() === 'trigger';
    }

    /**
     * Get the link title.
     *
     * @return string
     */
    public function getTitle()
    {
        if (!empty($this->title)) {
            return $this->title;
        }

        /* fallback to post title */
        if ($this->isInternal()) {
            return get_the_title($this->getPostID());
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
        return get_post_type_archive_link($this->getArchiveType();
    }

    /**
     * Get the internal url.
     *
     * @return string
     */
    public function getInternalUrl()
    {
        $url = get_the_permalink($this->getPostID);
        return Utils\URL::appendAnchor($url, $this->getAnchor());
    }

    /**
     * Get the external url.
     *
     * @return string
     */
    public function getExternalUrl()
    {
        return $this->externalUrl;
    }

    /**
     * Get the document url.
     *
     * @return string
     */
    public function getDocumentUrl()
    {
        return wp_get_attachment_url($this->getDocumentID());
    }

    /**
     * Get the trigger url.
     *
     * @return string
     */
    public function getTriggerUrl()
    {
        return '#'.$this->getTrigger();
    }

    /**
     * Get link type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the document ID.
     *
     * @return int
     */
    public function getDocumentID()
    {
        return $this->docID;
    }

    /**
     * Get link anchor without pound sign.
     *
     * @return string
     */
    public function getAnchor()
    {
        return Utils\URL::filterAnchor($this->anchor);
    }

    /**
     * Get the internal post id.
     *
     * @return int
     */
    public function getPostID()
    {
        if ($this->isInternal()) {
            return $this->postID;
        }

        trigger_error('only internal links have post id\'s', E_USER_WARNING);
        return -1;
    }

    /**
     * Get link style.
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Get the email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the trigger.
     *
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * Get the archive type.
     *
     * @return string
     */
    public function getArchiveType()
    {
        return $this->archiveType;
    }

    /**
     * Get the class prefix.
     *
     * @return string
     */
    public function getClassPrefix()
    {
        return 'link--';
    }

    /**
     * Get class string associated with this link.
     *
     * @return string
     */
    public function getClasses()
    {
        $prefix = $this->getClassPrefx();
        $classes = [];

        if ($this->getType()) {
            $classes[] = $prefix . $this->getType();
        }

        if (!empty($this->getAnchor())) {
            $classes[] = $prefix . 'anchor';
        }

        return implode($temp, ' ');
    }
}
