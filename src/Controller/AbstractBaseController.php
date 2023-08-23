<?php

namespace App\Controller;

use App\Application\Dto\InputParameterDTO;
use App\Application\UseCase\CreateInsuranceXML;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractBaseController extends AbstractController
{
    protected function __construct(
        protected readonly CreateInsuranceXML $createInsuranceXML,
        protected readonly ValidatorInterface $validator
    ) {}

    protected function parseRequestParameters(array $parameters): InputParameterDTO
    {
        return new InputParameterDTO(
            $parameters['driver_licenseDate'] ?? null,
            $parameters['driver_id'] ?? null,
            $parameters['driver_civilStatus'] ?? null,
            $parameters['driver_children'] ?? null,
            $parameters['driver_birthDate'] ?? null
        );
    }

    protected function formatValidationErrors(ConstraintViolationList $violations): string
    {
        $errors = [];

        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return json_encode([$errors]);
    }

    public abstract function showXML(Request $request): Response|JsonResponse;
}
