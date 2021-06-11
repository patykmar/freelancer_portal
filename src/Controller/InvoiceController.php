<?php


namespace App\Controller;

use App\Repository\InvoiceRepository;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class InvoiceController extends AbstractController
{
    private InvoiceRepository $invoiceRepository;
    private ParameterBagInterface $parameterBag;


    /**
     * InvoiceController constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(InvoiceRepository $invoiceRepository, ParameterBagInterface $parameterBag)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->parameterBag = $parameterBag;
    }


    /**
     * @Route("/invoice/generate-pdf/{invoiceId}", name="inventory_generate_pdf", requirements={"invoiceId"="\d+"})
     * @throws MpdfException
     */
    public function generatePdfInvoice(int $invoiceId): void
    {
        $invoice = $this->invoiceRepository->find($invoiceId);
        $totalPrice = 0;
        $totalDiscount = 0;
        $today = new DateTime('now');
        $filename = $today->format('Ymdhis') . '_' . $invoice->getVs() . '.pdf';

        foreach ($invoice->getInvoiceItems() as $item) {
            $totalPrice += ($item->getPriceTotal() + $item->getMarginTotal());
            $totalDiscount += $item->getDiscountTotal();
        }

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);


        $htmlBody = $this->renderView('Invoice/Invoice-detail.html.twig', [
            'invoice' => $invoice,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
            'total_price-total_discount' => $totalPrice - $totalDiscount,
        ]);

        $htmlFooter = $this->renderView('Invoice/footer.html.twig', [
            'invoice' => $invoice,
        ]);

        $mpdf->WriteHTML($htmlBody);
        $mpdf->SetHTMLFooter($htmlFooter);

        /** @link http://mpdf.github.io/reference/mpdf-functions/output.html */
        $mpdf->Output($filename, 'I');

// Save files
//        $this->dompdf->stream($this->parameterBag->get('kernel.project_dir'). '/public/pdf/' . $invoice->getVs() . '.pdf',
//            ['Attachment' => false]
//        );
    }

    /**
     * @Route("/invoice/generate-html/{invoiceId}", name="inventory_generate_html", requirements={"invoiceId"="\d+"})
     */
    public function generateHtmlInvoice(int $invoiceId): Response
    {
        $invoice = $this->invoiceRepository->find($invoiceId);
        $totalPrice = 0;
        $totalDiscount = 0;


        foreach ($invoice->getInvoiceItems() as $item) {
            $totalPrice += ($item->getPriceTotal() + $item->getMarginTotal());
            $totalDiscount += $item->getDiscountTotal();
        }

        return $this->render('Invoice/Invoice-detail.html.twig', [
            'invoice' => $invoice,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
        ]);
    }
}