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
        $ResourceHints = [
            'google' => [
                'resource' => 'https://www.googletagmanager.com/gtag/js?id=G-E35X2T4CP3&l=dataLayer&cx=c',
                'type'     => 'preconnect',
                'as' => 'script',
            ],
            'hotjar-scripts' => [
                'resource' => 'https://script.hotjar.com/modules.b738078c6419b4df4360.js',
                'type'     => 'preconnect',
                'as' => 'script',
            ]
        ];

        foreach ($ResourceHints as $resource) {
            $this->pageConfig->addRemotePageAsset(
                $resource['resource'],
                'link_rel',
                [
                    'attributes' => ['rel' => $resource['type'] ,'as' => $resource['as'] ]
                ]
            );
        }

        return $this;
    }
}