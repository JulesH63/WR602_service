<?php

namespace App\Controller;

use App\Service\GotenbergService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    private GotenbergService $gotenbergService;

    public function __construct(GotenbergService $gotenbergService)
    {
        $this->gotenbergService = $gotenbergService;
    }

    /**
     * @Route("/generate-pdf", name="generate_pdf", methods={"POST"})
     */
    public function generatePdf(Request $request): Response
    {
        $htmlContent = $request->getContent();
        $pdfContent = $this->gotenbergService->generatePdfFromHtml($htmlContent);
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }
}
