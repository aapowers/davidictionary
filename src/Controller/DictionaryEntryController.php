<?php

namespace App\Controller;

use App\Entity\DictionaryEntry;
use App\Manager\DictionaryEntryManager;
use App\Form\DictionaryEntryFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DictionaryEntryController extends AbstractController
{
    /**
     * @var DictionaryEntryManager
     */
    private $dictionaryEntryManager;

    public function __construct(
        DictionaryEntryManager $dictionaryEntryManager
    ) {
        $this->dictionaryEntryManager = $dictionaryEntryManager;
    }

    /**
     * @Route(name="create", path="/create")
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(DictionaryEntryFormType::class, new DictionaryEntry('', ''));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dictionaryEntry = $form->getData();

            $this->dictionaryEntryManager->createDictionaryEntry($dictionaryEntry);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('form/create.html.twig', [
            'dictionaryEntryForm' => $form->createView(),
        ]);
    }
}

