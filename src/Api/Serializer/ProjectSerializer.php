<?php

/*
 * This file is part of Vivo Group's Content Management System.
 * For the full copyright and license information, please view the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace App\Api\Serializer;

use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Project;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ProjectSerializer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @var AbstractItemNormalizer
     */
    private $decorated;

    public function __construct(NormalizerInterface $decorated) {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }

        $this->decorated = $decorated;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Project;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        if ($object instanceof Project) {
            $data['s3FileUrl'] = 'https://s3.com/'.$object->getId().'/'.sha1($object->getName());
        }

        return $this->decorated->normalize($object, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }
}
