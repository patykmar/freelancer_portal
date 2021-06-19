<?php


namespace App\Controller;

use App\Repository\InvoiceRepository;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

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
     * @Route("/invoice/generate-pdf/{invoiceId}", name="inventory_generate_pdf", requirements={"invoiceId"="\d+"})
     * @throws MpdfException
     */
    public function generatePdfInvoice(int $invoiceId): void
    {
        $invoiceFromDb = $this->invoiceRepository->find($invoiceId);
        if (!$invoiceFromDb) {
            throw $this->createNotFoundException('The invoice does not exist!');
        }

        $sumTotalPriceIncMarginDiscountVat = 0;
        $sumTotalPriceIncMarginVat = 0;
        $showDiscount = false;
        $showVat = false;
        $today = new DateTime('now');
        $filename = $today->format('Ymdhis') . '_' . $invoiceFromDb->getVs() . '.pdf';
        $vatSum = array();

        foreach ($invoiceFromDb->getInvoiceItems() as $item) {
            $sumTotalPriceIncMarginDiscountVat += $item->getTotalPriceIncMarginDiscountVat();
            $sumTotalPriceIncMarginVat += $item->getTotalPriceIncMarginVat();
            if ($item->getDiscount() > 0) {
                $showDiscount = true;
            }
            if ($item->getVat()->getPercent() > 0) {
                $showVat = true;
            }
            if (!isset($vatSum[$item->getVat()->getPercent()])) {
                $vatSum[$item->getVat()->getPercent()] = 0;
            }
            $vatSum[$item->getVat()->getPercent()] += ($item->getPriceIncMarginDiscountMultiVat() - $item->getPriceIncMarginMinusDiscount());
        }

//        dump($sumTotalPriceIncMarginVat);
//        dd($sumTotalPriceIncMarginDiscountVat);

        $totalDiscount = $sumTotalPriceIncMarginVat - $sumTotalPriceIncMarginDiscountVat;

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $htmlBody = $this->renderView('Invoice/parts/01-cz_header.html.twig', [
            'invoice' => $invoiceFromDb,
        ]);

        $htmlBody .= $this->renderView('Invoice/parts/02-cz_supplier-and-subscriber-details.html.twig', [
            'invoice' => $invoiceFromDb,
        ]);

        $htmlBody .= $this->renderView('Invoice/parts/03-cz_invoice-details.html.twig', [
            'invoice' => $invoiceFromDb,
        ]);

        if (!$showVat) {
            // no vat
            $htmlBody .= $this->renderView('Invoice/parts/04a-cz_invoice-items-table.html.twig', [
                'invoice' => $invoiceFromDb,
                'show_discount' => $showDiscount
            ]);

            $htmlBody .= $this->renderView('Invoice/parts/05a-cz_invoice-summary.html.twig', [
                'total_price' => $sumTotalPriceIncMarginDiscountVat,
                'total_price_with_discount' => $sumTotalPriceIncMarginVat,
                'total_discount' => $totalDiscount,
                'total_price_minus_total_discount' => $sumTotalPriceIncMarginDiscountVat - $totalDiscount,
                'show_discount' => $showDiscount
            ]);
        } else {
            // show vat
            $htmlBody .= $this->renderView('Invoice/parts/04b-cz_invoice-items-table.html.twig', [
                'invoice' => $invoiceFromDb,
                'show_discount' => $showDiscount
            ]);

            $htmlBody .= $this->renderView('Invoice/parts/05b-cz_invoice-summary.html.twig', [
                'sum_total_price_inc_margin_discount_vat' => $sumTotalPriceIncMarginDiscountVat,
                'sum_total_price_inc_margin_vat' => $sumTotalPriceIncMarginVat,
                'total_discount' => $totalDiscount,
                'show_discount' => $showDiscount,
                'vat_sum' => $vatSum,
            ]);
        }


        $htmlFooter = $this->renderView('Invoice/footer.html.twig', [
            'invoice' => $invoiceFromDb,
        ]);

        $mpdf->WriteHTML($htmlBody);
        $mpdf->SetHTMLFooter($htmlFooter);

        /** For access to public folder use:
         * $this->dompdf->stream($this->parameterBag->get('kernel.project_dir'). '/public/pdf/' . $invoice->getVs() . '.pdf',
         * ['Attachment' => false] );
         * @link http://mpdf.github.io/reference/mpdf-functions/output.html
         */
        $mpdf->Output($filename, 'I');
        //TODO Jun 17 09:58:34 |CRITICA| REQUES Uncaught PHP Exception Symfony\Component\HttpKernel\Exception\ControllerDoesNotReturnResponseException: "The controller must return a "Symfony\Component\HttpFoundation\Response" object but it returned null. Did you forget to add a return statement somewhere in your controller?" at /mnt/c/Users/patykmar/www/symfony/fakturacni_system/src/Controller/InvoiceController.php line 112

    }

//    /**
//     * @Route("/invoice/generate-html/{invoiceId}", name="inventory_generate_html", requirements={"invoiceId"="\d+"})
//     */
//    public function generateHtmlInvoice(int $invoiceId): Response
//    {
//        $invoice = $this->invoiceRepository->find($invoiceId);
//        $totalPrice = 0;
//        $totalDiscount = 0;
//        $showDiscount = false;
//        $showVat = false;
//
//        foreach ($invoice->getInvoiceItems() as $item) {
//            $totalPrice += $item->getPriceTotal();
//            $totalDiscount += $item->getDiscountTotal();
//            if ($item->getDiscount() > 0) {
//                $showDiscount = true;
//            }
//            if ($item->getVat()->getPercent() > 0) {
//                $showVat = true;
//            }
//        }
//
//
//        $htmlBody = $this->renderView('Invoice/parts/01-cz_header.html.twig',[
//            'invoice' => $invoice,
//        ]);
//
//        $htmlBody .= $this->renderView('Invoice/parts/02-cz_supplier-and-subscriber-details.html.twig', [
//            'invoice' => $invoice,
//        ]);
//
//        $htmlBody .= $this->renderView('Invoice/parts/03-cz_invoice-details.html.twig', [
//            'invoice' => $invoice,
//        ]);
//
//        if (!$showVat){
//            $htmlBody .= $this->renderView('Invoice/parts/04a-cz_invoice-items-table.html.twig', [
//                'invoice' => $invoice,
//                'show_discount' => $showDiscount
//            ]);
//
//            $htmlBody .= $this->renderView('Invoice/parts/05a-cz_invoice-summary.html.twig', [
//                'total_price' => $totalPrice,
//                'total_discount' => $totalDiscount,
//                'total_price_minus_total_discount' => $totalPrice - $totalDiscount,
//                'show_discount' => $showDiscount
//            ]);
//        }else{
//            $htmlBody .= $this->renderView('Invoice/parts/04b-cz_invoice-items-table.html.twig', [
//                'invoice' => $invoice,
//                'show_discount' => $showDiscount
//            ]);
//
//            $htmlBody .= $this->renderView('Invoice/parts/05a-cz_invoice-summary.html.twig', [
//                'total_price' => $totalPrice,
//                'total_discount' => $totalDiscount,
//                'total_price_minus_total_discount' => $totalPrice - $totalDiscount,
//                'show_discount' => $showDiscount
//            ]);
//        }
//
//        return $this->($htmlBody);
//    }
}