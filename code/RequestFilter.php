<?php

namespace SilverStripe\CrazyEgg;

use DataModel;
use Session;
use SS_HTTPRequest;
use SS_HTTPResponse;
use ViewableData;

class RequestFilter implements \RequestFilter
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
     * @inheritdoc
     *
     * @param SS_HTTPRequest $request
     * @param SS_HTTPResponse $response
     * @param DataModel $model
     *
     * @return bool
     */
    public function postRequest(SS_HTTPRequest $request, SS_HTTPResponse $response, DataModel $model)
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
     * @inheritdoc
     *
     * @param SS_HTTPRequest $request
     * @param Session $session
     * @param DataModel $model
     *
     * @return bool
     */
    public function preRequest(SS_HTTPRequest $request, Session $session, DataModel $model)
    {
        // TODO: segregate this interface
    }
}
