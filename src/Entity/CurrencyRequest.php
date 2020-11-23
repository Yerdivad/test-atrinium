<?php

namespace App\Entity;

use App\Repository\CurrencyRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRequestRepository::class)
 */
class CurrencyRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $origin_currency;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $target_currency;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $request_date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginCurrency(): ?string
    {
        return $this->origin_currency;
    }

    public function setOriginCurrency(string $origin_currency): self
    {
        $this->origin_currency = $origin_currency;

        return $this;
    }

    public function getTargetCurrency(): ?string
    {
        return $this->target_currency;
    }

    public function setTargetCurrency(string $target_currency): self
    {
        $this->target_currency = $target_currency;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->request_date;
    }

    public function setRequestDate(\DateTimeInterface $request_date): self
    {
        $this->request_date = $request_date;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
