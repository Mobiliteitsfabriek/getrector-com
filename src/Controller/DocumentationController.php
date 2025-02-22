<?php

declare(strict_types=1);

namespace Rector\Website\Controller;

use Rector\Website\Documentation\DocumentationMenuFactory;
use Rector\Website\Documentation\HTMLFromMarkdownFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DocumentationController extends AbstractController
{
    public function __construct(
        private readonly HTMLFromMarkdownFactory $htmlFromMarkdownFactory,
        private readonly DocumentationMenuFactory $documentationMenuFactory
    ) {
    }

    #[Route(path: 'documentation/{section}', name: 'documentation', defaults: [
        // if the section is empty, default to "introduction"
        'section' => 'introduction',
    ])]
    public function __invoke(string $section): Response
    {
        $sectionHtmlContents = $this->htmlFromMarkdownFactory->create(
            __DIR__ . '/../../data/docs/' . $section . '.md'
        );

        return $this->render('docs/section.twig', [
            'section_title' => $this->documentationMenuFactory->createSectionTitle($section),
            'section_html_contents' => $sectionHtmlContents,
            'documentations_sections_by_category' => $this->documentationMenuFactory->create(),
        ]);
    }
}
