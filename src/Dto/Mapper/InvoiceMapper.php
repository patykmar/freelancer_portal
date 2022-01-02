<?php

namespace App\Dto\Mapper;

use App\Dto\In\InvoiceDtoIn;
use App\Dto\Out\InvoiceDtoOut;
use App\Entity\Invoice;
use App\Repository\CompanyRepository;
use App\Repository\PaymentTypeRepository;
use App\Repository\UserRepository;
use DateTime;

class InvoiceMapper implements MapperInterface
{
    private CompanyRepository $companyRepository;
    private InvoiceItemMapper $invoiceItemMapper;
    private PaymentTypeRepository $paymentTypeRepository;
    private UserRepository $userRepository;

    /**
     * @param InvoiceItemMapper $invoiceItemMapper
     * @param CompanyRepository $companyRepository
     * @param PaymentTypeRepository $paymentTypeRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        InvoiceItemMapper     $invoiceItemMapper,
        CompanyRepository     $companyRepository,
        PaymentTypeRepository $paymentTypeRepository,
        UserRepository        $userRepository
    )
    {
        $this->invoiceItemMapper = $invoiceItemMapper;
        $this->companyRepository = $companyRepository;
        $this->paymentTypeRepository = $paymentTypeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param InvoiceDtoIn|object $dto
     * @return Invoice
     */
    public function toEntity(object $dto): Invoice
    {
        return $this->fullFillEntity(new Invoice(), $dto);
    }

    /**
     * For collection
     * @param Invoice|object $entity
     * @return InvoiceDtoOut
     */
    public function toDto(object $entity): InvoiceDtoOut
    {
        $invoiceDto = new InvoiceDtoOut();
        $invoiceDto->id = $entity->getId();
        $invoiceDto->name = $entity->getName();
        $invoiceDto->supplier['id'] = $entity->getSupplier()->getId();
        $invoiceDto->supplier['name'] = $entity->getSupplier()->getName();
        $invoiceDto->subscriber['id'] = $entity->getSubscriber()->getId();
        $invoiceDto->subscriber['name'] = $entity->getSubscriber()->getName();
        $invoiceDto->paymentType['id'] = $entity->getPaymentType()->getId();
        $invoiceDto->paymentType['name'] = $entity->getPaymentType()->getName();
        $invoiceDto->due = $entity->getDue();
        $invoiceDto->dueDate = date_timestamp_get($entity->getDueDate());
        $invoiceDto->paymentDate = is_null($entity->getPaymentDate()) ? null : date_timestamp_get($entity->getPaymentDate());
        $invoiceDto->invoiceCreated = date_timestamp_get($entity->getInvoiceCreated());
        $invoiceDto->userCreated['id'] = $entity->getUserCreated()->getId();
        $invoiceDto->userCreated['name'] = $entity->getUserCreated()->getId();
        $invoiceDto->vs = $entity->getVs();
        $invoiceDto->ks = $entity->getKs();

        return $invoiceDto;
    }

    /**
     * For item add invoiceItems
     * @param Invoice|object $invoice
     * @return InvoiceDtoOut
     */
    public function toDtoItem(Invoice $invoice): InvoiceDtoOut
    {
        $invoiceDto = $this->toDto($invoice);
        foreach ($invoice->getInvoiceItems() as $invoiceItem) {
            $invoiceDto->invoiceItems[] = $this->invoiceItemMapper->toDto($invoiceItem);
        }
        return $invoiceDto;
    }

    /**
     * @param Invoice|object $existingItem
     * @param InvoiceDtoIn|object $userData
     * @return Invoice
     */
    public function fullFillEntity(object $existingItem, object $userData): Invoice
    {
        $existingItem->setName($userData->name);
        $existingItem->setSupplier($this->companyRepository->find($userData->supplier));
        $existingItem->setSubscriber($this->companyRepository->find($userData->subscriber));
        $existingItem->setPaymentType($this->paymentTypeRepository->find($userData->paymentType));
        !is_null($userData->paymentDate) && $existingItem->setPaymentDate(new DateTime("@$userData->paymentDate"));
        $existingItem->setDue($userData->due);
        $existingItem->setUserCreated($this->userRepository->find($userData->userCreated));
        foreach ($userData->invoiceItems as $workInventoryDto) {
            $existingItem->addInvoiceItem(
                $this->invoiceItemMapper->toEntity(
                    $this->invoiceItemMapper->toDtoFromArray($workInventoryDto)
                ));
        }

        return $existingItem;
    }
}