<?php

namespace AppBundle\Form;

use AppBundle\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
            ->add('lastName')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'male' => Employee::MALE_GENDER,
                    'female' => Employee::FEMALE_GENDER
                ],
            ])
            ->add('dateOfBirth', DateType::class)
            ->add('comment')
            ->add('addresses', CollectionType::class, [
                'entry_type' => AddressType::class,
                'allow_add'  => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('phones', CollectionType::class, [
                'entry_type' => PhoneType::class,
                'allow_add'  => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('salary')
            ->add('isActive');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Employee::class,
        ));
    }

    public function getName()
    {
        return 'app_bundle_employee_type';
    }
}
