<?php


namespace App\Controller;

use App\Repository\InvoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    private InvoiceRepository $invoiceRepository;

    /**
     * InvoiceController constructor.
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }


    /**
     * @Route("/inventory/generate-pdf/{invoiceId}", name="inventory_generate_pdf", requirements={"invoiceId"="\d+"})
     */
    public function generatePdfInvoice(int $invoiceId):Response
    {
        $invoice = $this->invoiceRepository->find($invoiceId);


        return $this->render('Invoice/Invoice-detail.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}