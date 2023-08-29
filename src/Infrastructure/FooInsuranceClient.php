<?php

namespace App\Infrastructure;

use App\Domain\InsuranceInterface;
use App\Domain\Model\Insurance;
use SimpleXMLElement;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FooInsuranceClient implements InsuranceInterface
{
    private const FORMAT_DATE = 'Y/m/d';
    private const FOLDER_NAME = 'foo-insurance';

    public function __construct(private readonly ParameterBagInterface $params)
    {}

    public function createXML(Insurance $insurance): string
    {
        $xmlContent = $this->builtXml($insurance);

        $directory = sprintf('%s/public/%s', $this->params->get('kernel.project_dir'), self::FOLDER_NAME);
        $filename = sprintf('insurance_%s.xml', time());
        $filePath =  sprintf('%s/%s', $directory, $filename);

        file_put_contents($filePath, $xmlContent);

        return $filename;
    }

    private function builtXml(Insurance $insurance): string
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
        $prevInsuranceExist = 'NO';

        if (
            (
                null !== $insurance->getPrevInsuranceExpirationDate() && $insurance->IsPrevInsuranceExist()
            ) && $insurance->getPrevInsuranceExpirationDate()->getValue()->format(self::FORMAT_DATE) > $insurance->getDriverLicenceDate()->getValue()->format(self::FORMAT_DATE)
        ) {
            $prevInsuranceExist = 'SI';
        }

        return [
            'CodDocumento' => $insurance->getDriverId()->getValue(),
            'EstadoCivil' => $insurance->getDriverCivilStatus()->getValue(),
            'HijosCarnet' => $insurance->getDriverChildren()->isDriverChildren() ? 'SI' : 'NO',
            'FecCarnet' => $insurance->getDriverLicenceDate()->getValue()->format(self::FORMAT_DATE),
            'FecNacimiento' => $insurance->getDriverBirthdate()?->getValue()->format(self::FORMAT_DATE),
            'SeguroEnVigor' => $prevInsuranceExist
        ];
    }
}
