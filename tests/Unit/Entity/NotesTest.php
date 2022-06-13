<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Notes;
use App\Entity\Society;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

// Notes Entity Unit test
class NotesTest extends KernelTestCase
{
    private Notes $note;

    protected function setUp(): void
    {
        parent::setUp();
        $this->note = new Notes();
    }

    // test if set date is a success
    public function testSetDate(): void
    {
        $value = new \DateTime("2022-12-06");
        $response = $this->note->setDate($value);
        $getDate = $this->note->getDate();
        self::assertInstanceOf(Notes::class, $response);
        self::assertEquals($value, $getDate);
    }

    // test if set amount is a success
    public function testSetAmount(): void
    {
        $value = 10.50;
        $response = $this->note->setAmount($value);
        $getAmount = $this->note->getAmount();
        self::assertInstanceOf(Notes::class, $response);
        self::assertEquals($value, $getAmount);
    }

    // test if set valid type is a success
    public function testSetValidType(): void
    {
        $value = "essence";
        $response = $this->note->setType($value);
        $getType = $this->note->getType();
        self::assertInstanceOf(Notes::class, $response);
        self::assertEquals($value, $getType);
    }

    // test if set invalid type failed
    public function testSetInValidType(): void
    {
        // (1) boot the Symfony kernel
        self::bootKernel();

        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();
        $value = "test";
        $response = $this->note->setType($value);
        $violations = $container->get('validator')->validate($this->note);
        self::assertCount(1, $violations);
    }

    // test if set date is a success
    public function testSetRegistrationDate(): void
    {
        $value = new \DateTime("2022-12-06");
        $response = $this->note->setRegistrationDate($value);
        $getRegistrationDate = $this->note->getRegistrationDate();
        self::assertInstanceOf(Notes::class, $response);
        self::assertEquals($value, $getRegistrationDate);
    }

    // test if set society is a success
    public function testGetSociety(): void
    {
        $value = new Society();
        $response = $this->note->setSociety($value);
        $getSociety = $this->note->getSociety();
        self::assertInstanceOf(Notes::class, $response);
        self::assertEquals($value, $getSociety);
    }
}
