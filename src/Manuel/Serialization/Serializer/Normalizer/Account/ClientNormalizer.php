<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace Manuel\Serialization\Serializer\Normalizer\Account;

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
        $data = [
            'id' => $client->getId()->getId(),
            'email' => $client->getEmail()->getEmail(),
            'address' => $client->getAddress()->getAddress(),
        ];

        if (isset($context['inherit']) and $context['inherit']){
            unset($data['id']);
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Client;
    }
}