<?php

declare(strict_types=1);

namespace App\Api\Model;

use ApiPlatform\Metadata\ApiProperty;
use RZ\Roadiz\CoreBundle\Api\Model\NodesSourcesHeadInterface;
use RZ\Roadiz\CoreBundle\Entity\NodesSources;
use RZ\TreeWalker\WalkerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

final class CommonContent
{
    #[ApiProperty(identifier: true)]
    public string $id = 'unique';

    #[Groups(['common_content'])]
    public ?NodesSources $home = null;

    #[Groups(['common_content'])]
    #[ApiProperty(
        identifier: false,
        genId: false,
    )]
    public ?WalkerInterface $errorPage = null;

    #[Groups(['common_content'])]
    #[ApiProperty(
        identifier: false,
        genId: false,
    )]
    public ?NodesSourcesHeadInterface $head = null;

    #[Groups(['common_content'])]
    #[ApiProperty(
        identifier: false,
        genId: false,
    )]
    public ?array $menus = null;

    #[Groups(['common_content'])]
    #[ApiProperty(
        identifier: false,
        genId: false,
    )]
    public ?array $footers = null;

    #[Groups(['common_content_urls'])]
    #[ApiProperty(
        identifier: false,
        openapiContext: [
            'description' => 'List of global external URLs for the website (*_url settings).',
            'example' => [
                'first_url' => 'https://example.com',
                'second_url' => 'https://another-example.com',
            ],
        ],
        genId: false,
    )]
    public ?array $urls = null;

    #[Groups(['common_content_colors'])]
    #[ApiProperty(
        identifier: false,
        openapiContext: [
            'description' => 'List of global colors for the website (*_color settings).',
            'example' => [
                'first_color' => '#00ff00',
                'second_color' => '#ff0000',
            ],
        ],
        genId: false,
    )]
    public ?array $colors = null;
}
