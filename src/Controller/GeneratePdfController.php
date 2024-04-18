<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GotenbergService;

class GeneratePdfController extends AbstractController
{
    private GotenbergService $gotenbergService;
    public function __construct(GotenbergService $gotenbergService)
    {
        $this->gotenbergService = $gotenbergService;
    }

    /**
     * @Route("/generate-pdf", name="generate_pdf_generate", methods={"POST"})
     */
    public function generatePdf2(Request $request): Response
    {
        // Récupérer le contenu HTML de la requête
        $htmlContent = $request->getContent();

        // Envoyer le contenu HTML à Gotenberg pour générer le PDF
        $pdfContent = $this->gotenbergService->generatePdfFromHtml($htmlContent);

        // Créer une réponse avec le contenu PDF
        $response = new Response($pdfContent);

        // Définir les en-têtes de la réponse pour indiquer que c'est un fichier PDF
        $response->headers->set('Content-Type', 'application/pdf');

        return $response;
    }
}
