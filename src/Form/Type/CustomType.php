<?php
declare(strict_types=1);
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', TextType::class, [
                'label' => 'Year',
            ])
            ->add('value01', TextType::class, [
                'label' => 'Value 01',
            ])
            ->add('value02', TextType::class, [
                'label' => 'Value 02',
            ])
            ->add('value03', TextType::class, [
                'label' => 'Value 03',
            ])
        ;
    }
}
