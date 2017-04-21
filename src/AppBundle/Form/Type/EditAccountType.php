<?php
/**
 * User: manuel
 * Date: 21-04-2017
 */

namespace AppBundle\Form\Type;

use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountRequest;
use Manuel\LocalBank\Application\Service\EditAccount\EditAccountRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EditAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class);
        $builder->add('address', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditAccountRequest::class,
        ]);
    }
}