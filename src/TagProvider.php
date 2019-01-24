<?php

namespace SilverStripe\CrazyEgg;

use SilverStripe\Core\Environment;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\ViewableData;

class TagProvider extends ViewableData
{
    /**
     * @var bool
     */
    private static $enabled = true;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        if (!Environment::getEnv('CRAZY_EGG_APP_KEY')
            || !Environment::getEnv('CRAZY_EGG_APP_SECRET')
            || !Environment::getEnv('CRAZY_EGG_ACCOUNT_NUMBER')
            || !$this->config()->get('enabled')
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return null|DBHTMLText
     */
    public function forTemplate()
    {
        if (!$this->isEnabled()) {
            return null;
        }

        $parts = str_split(Environment::getEnv('CRAZY_EGG_ACCOUNT_NUMBER'), 4);
        $accountNumber = $parts[0] . '/' . $parts[1];

        return $this->renderWith(
            'CrazyEggScriptTags',
            [
                'CrazyEggAccountNumber' => $accountNumber,
            ]
        );
    }
}
