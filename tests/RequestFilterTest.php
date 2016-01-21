<?php

namespace SilverStripe\CrazyEgg\Tests;

use DataModel;
use DBField;
use SapphireTest;
use Session;
use SilverStripe\CrazyEgg\RequestFilter;
use SS_HTTPRequest;
use SS_HTTPResponse;
use ViewableData;

/**
 * @mixin PHPUnit_Framework_TestCase
 */
class RequestFilterTest extends SapphireTest
{
    /**
     * @dataProvider sampleResponses
     *
     * @param SS_HTTPResponse $response
     * @param bool $match
     */
    public function testScriptInsertion($response, $match)
    {
        $tag = DBField::create_field(
            "HTMLText",
            "<script>'use strict'</script>"
        );

        if ($match) {
            $this->assertRegExp(
                "#<script>'use strict'</script></head>#is",
                $this->checkFilterForResponse($response, $tag)->getBody()
            );
        } else {
            $this->assertNotRegExp(
                "#<script>'use strict'</script></head>#is",
                $this->checkFilterForResponse($response, $tag)->getBody()
            );
        }
    }

    /**
     * @return array
     */
    public function sampleResponses()
    {
        $responses = array();

        $responses[] = array(
            new SS_HTTPResponse("<html><head></head><body><p>regular response has script added</p></body></html>"),
            true
        );

        $responses[] = array(
            new SS_HTTPResponse("<p>fragment doesn't have script added</p>"),
            false
        );

        $response = new SS_HTTPResponse("<html><head></head><body><p>plain text response doesn't have script added</p></body></html>");
        $response->addHeader("Content-Type", "text/plain");

        $responses[] = array($response, false);

        return $responses;
    }

    /**
     * @param SS_HTTPResponse $response
     * @param ViewableData $tag
     *
     * @return SS_HTTPResponse
     */
    function checkFilterForResponse(SS_HTTPResponse $response, ViewableData $tag)
    {
        $request = new SS_HTTPRequest("GET", "/");
        $model = new DataModel();
        $session = new Session(array());

        $filter = new RequestFilter();
        $filter->setTagProvider($tag);

        $filter->preRequest($request, $session, $model);
        $filter->postRequest($request, $response, $model);

        return $response;
    }
}
