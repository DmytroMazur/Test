<?php

namespace App\Domain;
use App\Domain\Model\Insurance;

interface InsuranceInterface
{
    public function createXML(Insurance $insurance): string;
}