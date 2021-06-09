<?php


namespace App\Controller;

use App\Repository\InvoiceRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    private InvoiceRepository $invoiceRepository;
    private ParameterBagInterface $parameterBag;

    private Dompdf $dompdf;

    /**
     * InvoiceController constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(InvoiceRepository $invoiceRepository, ParameterBagInterface $parameterBag)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->parameterBag = $parameterBag;
        $this->dompdf = new Dompdf();
    }


    /**
     * @Route("/invoice/generate-pdf/{invoiceId}", name="inventory_generate_pdf", requirements={"invoiceId"="\d+"})
     */
    public function generatePdfInvoice(int $invoiceId): void
    {
        $invoice = $this->invoiceRepository->find($invoiceId);


        $html = $this->renderView('Invoice/Invoice-detail.html.twig', [
            'invoice' => $invoice,
        ]);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4');
        $this->dompdf->render();

        $this->dompdf->stream($this->parameterBag->get('kernel.project_dir'). '/public/pdf/' . $invoice->getVs() . '.pdf',
            ['Attachment' => false]
        );
    }

    /**
     * @Route("/invoice/generate-html/{invoiceId}", name="inventory_generate_html", requirements={"invoiceId"="\d+"})
     */
    public function generateHtmlInvoice(int $invoiceId): Response
    {
        $invoice = $this->invoiceRepository->find($invoiceId);


        return $this->render('Invoice/Invoice-detail.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}