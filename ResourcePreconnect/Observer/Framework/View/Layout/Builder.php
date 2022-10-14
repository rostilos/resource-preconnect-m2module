<?php

namespace Perspective\ResourcePreconnect\Observer\Framework\View\Layout;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config as PageConfig;

class Builder implements ObserverInterface
{
    /** @var PageConfig $pageConfig */
    private $pageConfig;

    /**
     * Builder constructor.
     *
     * @param PageConfig  $pageConfig
     */
    public function __construct(
        PageConfig $pageConfig
    ) {
        $this->pageConfig  = $pageConfig;
    }

    /**
     * @param Observer $observer
     *
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $ResourcePreconnect = [
            'google' => [
                'resource' => 'https://www.google-analytics.com',
                'type'     => 'preconnect',
            ],
            'hs-analytics' => [
                'resource' => 'https://js-eu1.hs-analytics.net',
                'type'     => 'preconnect'
            ],
            'hotjar-scripts' => [
                'resource' => 'https://script.hotjar.com',
                'type'     => 'preconnect',
            ],
            'hotjar-static' => [
                'resource' => 'https://static.hotjar.com',
                'type'     => 'preconnect',
            ]
        ];

        foreach ($ResourcePreconnect as $resource) {
            $this->pageConfig->addRemotePageAsset(
                $resource['resource'],
                'link_rel',
                [
                    'attributes' => ['rel' => $resource['type'] ]
                ]
            );
        }

        return $this;
    }
}