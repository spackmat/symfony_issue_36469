<?php
declare(strict_types=1);
namespace App\Controller;

use App\Form\ReproducerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReproducerController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="reproducer",
     *     methods={"GET", "POST"},
     * )
     */
    public function reproducerAction()
    {
        $data = [
            'fieldNeedingTransformer' => [
                [
                    "year" => "2019",
                    "month" => "01",
                    "value" => 201901,
                ],
                [
                    "year" => "2019",
                    "month" => "02",
                    "value" => 201902,
                ],
                [
                    "year" => "2019",
                    "month" => "03",
                    "value" => 201903,
                ],
                [
                    "year" => "2020",
                    "month" => "01",
                    "value" => 202001,
                ],
                [
                    "year" => "2020",
                    "month" => "02",
                    "value" => 202002,
                ],
                [
                    "year" => "2020",
                    "month" => "03",
                    "value" => 202003,
                ]
            ]
        ];

        $form = $this->createForm(ReproducerType::class, $data, [
            'action' => $this->generateUrl('reproducer'),
            'method' => 'POST',
        ]);

        return $this->render('reproducer.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}