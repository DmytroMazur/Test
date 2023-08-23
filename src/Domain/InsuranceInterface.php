<?php

namespace App\Domain;
use App\Domain\Model\Insurance;

interface InsuranceInterface
{
    public function builtXml(Insurance $insurance): string;
}