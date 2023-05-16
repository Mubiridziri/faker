<?php

namespace Mubiridziri\Faker;

use Mubiridziri\Faker\DependencyInjection\FakerBundleExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FakerBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new FakerBundleExtension();
        }
        return $this->extension;
    }
}
