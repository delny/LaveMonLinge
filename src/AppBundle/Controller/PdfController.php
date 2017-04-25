<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PdfController extends Controller
{

    /**
     * @Route("/pdf/{idOrder}", name="app_order_pdf")
     */
    public function pdfAction($idOrder)
    {
        $userManager = $this->container->get('app.user_manager');
        $order = $userManager->getOrderById($idOrder);

        if (!$order || $this->getUser()!= $order->getUser())
        {
            return $this->redirectToRoute('homepage');
        }

        $html = $this->renderView( ':pdf:orderBill.html.twig', [
            'order' => $order,
            ]);

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('encoding', 'UTF-8');

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"'
            ]
        );
    }

    /**
     * @Route("/pdf/item/{idOrderItem}", name="app_orderitem_pdf")
     */
    public function itempdfAction($idOrderItem)
    {
        $orderManager = $this->get('app.order_manager');

        $orderItem = $orderManager->getOrderItemById($idOrderItem);
        $order= $orderItem->getOrderLaundry();

        if (!$order || $this->getUser()!= $order->getUser())
        {
            return $this->redirectToRoute('homepage');
        }


        $html = $this->renderView(':pdf:sacBill.html.twig',[
                'order' => $order,
                'item' => $orderItem,
                'countOrderItem' => $order->getOrderItems()->count(),
            ]);

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('encoding', 'UTF-8');

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"'
            ]
        );
    }
}