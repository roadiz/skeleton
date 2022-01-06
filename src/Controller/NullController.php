<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Do not serve nodes-sources from their Path or Path + .json.
 *
 * @package App\Controller
 */
final class NullController
{
    public function indexAction(): Response
    {
        throw new NotFoundHttpException('Website is headless');
    }
}
