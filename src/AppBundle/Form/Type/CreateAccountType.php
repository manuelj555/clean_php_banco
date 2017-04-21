<?php
/**
 * User: manuel
 * Date: 21-04-2017
 */

namespace AppBundle\Form\Type;

use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountRequest;
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
class CreateAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class);
        $builder->add('address', TextareaType::class);
        $builder->add('initialAmount', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateAccountRequest::class,
            'empty_data' => function ($form) {
                return $this->createData($form);
            },
        ]);
    }

    protected function createData(FormInterface $form)
    {
        return new CreateAccountRequest(
            $form['email']->getData(),
            $form['address']->getData(),
            $form['initialAmount']->getData()
        );
    }
}