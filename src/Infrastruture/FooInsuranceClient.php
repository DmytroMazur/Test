<?php

namespace App\Infrastruture;

use App\Domain\InsuranceInterface;
use App\Domain\Model\Insurance;
use SimpleXMLElement;

class FooInsuranceClient implements InsuranceInterface
{
    private const FORMAT_DATE = 'Y/m/d';
    public function builtXml(Insurance $insurance): string
    {
        $fields = $this->mappingFields($insurance);

        $xml = new SimpleXMLElement(
            '<?xml version="1.0" encoding="utf-8"?><TarificacionThirdPartyRequest></TarificacionThirdPartyRequest>'
        );

        foreach ($fields as $key => $value) {
            $xml->addChild($key, $value);
        }

        return $xml->asXML();
    }

    private function mappingFields(Insurance $insurance): array
    {
        return [
            'CodDocumento' => $insurance->getDriverId()->getValue(),
            'EstadoCivil' => $insurance->getDriverCivilStatus()->getValue(),
            'HijosCarnet' => $insurance->getDriverChildren()->isDriverChildren() ? 'SI' : 'NO',
            'FecCarnet' => $insurance->getDriverLicenceDate()->getValue()->format(self::FORMAT_DATE),
            'FecNacimiento' => $insurance->getDriverBirthDate()?->getValue()->format(self::FORMAT_DATE)
        ];
    }
}