<?php

namespace SilverStripe\CrazyEgg;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\RequestFilter as BaseRequestFilter;
use SilverStripe\Control\Session;
use SilverStripe\ORM\DataModel;
use SilverStripe\View\ViewableData;

class RequestFilter implements BaseRequestFilter
{
    /**
     * @var bool
     */
    private static $installed = false;

    /**
     * @var ViewableData
     */
    private $tagProvider;

    /**
     * @param ViewableData $tagProvider
     */
    public function setTagProvider(ViewableData $tagProvider)
    {
        $this->tagProvider = $tagProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function postRequest(HTTPRequest $request, HTTPResponse $response, DataModel $model)
    {
        $mime = $response->getHeader("Content-Type");

        if (!$mime || strpos($mime, "text/html") !== false) {
            $tags = $this->tagProvider->forTemplate();

            if ($tags && !static::$installed) {
                $content = $response->getBody();
                $content = preg_replace("/(<\\/head[^>]*>)/i", $tags . "\\1", $content);
                $response->setBody($content);

                static::$installed = true;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function preRequest(HTTPRequest $request, Session $session, DataModel $model)
    {
        // TODO: segregate this interface
    }
}
