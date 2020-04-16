<?php
declare(strict_types=1);
namespace App\Form;

use App\Form\Type\CustomType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class ReproducerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fieldNeedingTransformer', CollectionType::class, [
            'entry_type' => CustomType::class,
            'label' => 'MyCollection',
        ]);
        $builder->get('fieldNeedingTransformer')->addModelTransformer(new CallbackTransformer(
            function ($modelValues) {
                // you can also just return an empty array and see that six instead of two collection items are inside the formView and thus rendered
                // the following is sort of production/testing code from a real application so one can see the problem inside the rendered form

                $formValues = [];
                foreach ($modelValues as $row) {
                    if (!isset($formValues[$row['year']]['year'])) {
                        $formValues[$row['year']]['year'] = $row['year'];
                    }
                    $formValues[$row['year']]['value' . $row['month']] = $row['value'];
                }
                ksort($formValues);
                foreach ($formValues as &$row) {
                    foreach (['01','02','03'] as $month) {
                        if (!isset($row['value' . $month])) {
                            $row['value' . $month] = null;
                        }
                    }
                    ksort($row);
                }
                return array_values($formValues);
            },
            function ($submittedValues) {
                // not implemented as it is out of scope for this reproducer
                return $submittedValues;
            }
        ));
    }
}
