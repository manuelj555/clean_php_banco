<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace Manuel\Serialization\Serializer\Normalizer\Account;

use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountRequest;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class CreateAccountRequestDenormalizer implements DenormalizerInterface
{

    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $request = new CreateAccountRequest(
            $data['client']['email'] ?? '',
            $data['client']['address'] ?? '',
            $data['balance']['amount'] ?? 0
        );

        return $request;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === CreateAccountRequest::class;
    }
}