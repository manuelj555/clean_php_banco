<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace AppBundle\Serializer\Normalizer;

use Manuel\LocalBank\Account\Client\Client;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\scalar;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class ClientNormalizer implements NormalizerInterface
{
    /**
     * @param Client $client
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($client, $format = null, array $context = array())
    {
        return [
            'id' => $client->getId()->getId(),
            'email' => $client->getEmail()->getEmail(),
            'address' => $client->getAddress()->getAddress(),
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Client;
    }
}