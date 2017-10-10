<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace Manuel\Serialization\Serializer\Normalizer\Account;

use Manuel\LocalBank\Application\Service\EditAccount\EditAccountRequest;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EditAccountRequestDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $request = new EditAccountRequest(
            $data['client']['email'] ?? '',
            $data['client']['address'] ?? '',
            null
        );

        return $request;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === EditAccountRequest::class;
    }
}