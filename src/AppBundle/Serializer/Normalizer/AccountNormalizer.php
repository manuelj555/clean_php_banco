<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace AppBundle\Serializer\Normalizer;

use Manuel\LocalBank\Account\Account;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\scalar;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class AccountNormalizer implements NormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    /**
     * @param Account $account
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($account, $format = null, array $context = array())
    {
        return [
            'id' => $account->getAccountId()->getId(),
            'client' => $this->serializer->normalize($account->getClient(), $format, $context),
            'balance' => [
                'amount' => $account->getBalance()->getAmount(),
                'currency' => $account->getBalance()->getCurrency()->getType(),
            ],
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Account;
    }
}