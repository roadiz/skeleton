<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\Migrations\Version\Comparator;
use Doctrine\Migrations\Version\Version;

class ProjectVersionComparator implements Comparator
{
    private function getClassname(Version $version): string
    {
        $tokens = explode('\\', (string) $version);

        return $tokens[count($tokens) - 1];
    }

    public function compare(Version $a, Version $b): int
    {
        $classA = $this->getClassname($a);
        $classB = $this->getClassname($b);

        /*
         * Only compare class-name timestamp
         */
        return $classA <=> $classB;
    }
}
