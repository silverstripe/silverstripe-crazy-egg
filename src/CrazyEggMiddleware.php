<?php

namespace SilverStripe\CrazyEgg;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\View\ViewableData;

class CrazyEggMiddleware implements HTTPMiddleware
{
    /**
     * @var bool
     */
    protected static $installed = false;

    /**
     * @var ViewableData
     */
    protected $tagProvider;

    /**
     * @param ViewableData $tagProvider
     */
    public function setTagProvider(ViewableData $tagProvider)
    {
        $this->tagProvider = $tagProvider;
    }

    public function process(HTTPRequest $request, callable $delegate)
    {
        /** @var HTTPResponse $response */
        $response = $delegate($request);

        $mime = $response->getHeader('Content-Type');

        if (!$mime || strpos($mime, 'text/html') !== false) {
            $tags = $this->tagProvider->forTemplate();

            if ($tags && !static::$installed) {
                $content = $response->getBody();
                $content = preg_replace("/(<\\/head[^>]*>)/i", $tags . "\\1", $content);
                $response->setBody($content);

                static::$installed = true;
            }
        }

        return $response;
    }
}
