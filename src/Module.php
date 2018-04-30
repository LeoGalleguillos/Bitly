<?php
namespace LeoGalleguillos\Bitly;

use LeoGalleguillos\Bitly\Model\Factory as BitlyFactory;
use LeoGalleguillos\Bitly\Model\Service as BitlyService;
use LeoGalleguillos\Bitly\Model\Table as BitlyTable;
use LeoGalleguillos\Bitly\View\Helper as BitlyHelper;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                BitlyTable\Url::class => function ($serviceManager) {
                    return new BitlyTable\Url(
                        $serviceManager->get('bitly')
                    );
                },
            ],
        ];
    }
}
