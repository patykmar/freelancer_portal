<?php


namespace App\Services;


use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\NonUniqueResultException;
use DateTime;
use Exception;


class InvoiceServices
{
    /** @const int INVOICE_VS_LEN how many numbers will have VS */
    public const INVOICE_VS_LEN = 6;

    private InvoiceRepository $invoiceRepository;

    /**
     * InvoiceServices constructor.
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }


    /**
     * @param bool $linear
     * @return string
     * @throws NonUniqueResultException
     * @throws Exception
     */
    public function calculateInvoiceVs(bool $linear = true): string
    {
        $today = new DateTime('now');
        $year = $today->format('Y');
        $nextInvoiceId = 0;

        do {
            $invalidOutput = false;
            // which generate method has been set
            if ($linear) {
                /** @var Invoice $lastInvoice */
                $lastInvoice = $this->invoiceRepository->getLastInvoice();

                // if last Invoice doesn't exist use random generator
                if (is_null($lastInvoice)) {
                    $returnVs = $this->nextInvoiceVsRandom($year);
                } else {
                    $nextInvoiceId += $lastInvoice->getId() + 1;
                    $returnVs = $this->nextInvoiceVsLinear($year, $nextInvoiceId);
                }
            } else {
                $returnVs = $this->nextInvoiceVsRandom($year);
            }

            // check if the generate VS is not in DB
            if (!is_null($this->invoiceRepository->findOneBy(['vs' => $returnVs]))) {
                $invalidOutput = true;
            }
        } while ($invalidOutput);

        return $returnVs;
    }

    /**
     * @param string $year
     * @param int $id
     * @return string
     */
    private function nextInvoiceVsLinear(string $year, int $id): string
    {
        return $year . str_pad($id, self::INVOICE_VS_LEN, "0", STR_PAD_LEFT);
    }

    /**
     * @param string $year
     * @return string
     * @throws Exception
     */
    private function nextInvoiceVsRandom(string $year): string
    {
        if (!(self::INVOICE_VS_LEN < 10)) {
            throw new Exception("Const INVOICE_VS_LEN must be greater than 10");
        }
        $randomMaxValue = str_pad('9', self::INVOICE_VS_LEN, '9', STR_PAD_LEFT);
        return $year . str_pad(rand(100, (int)$randomMaxValue), self::INVOICE_VS_LEN, "0", STR_PAD_LEFT);
    }
}