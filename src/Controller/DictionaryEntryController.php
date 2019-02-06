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


/**
 * Class DictionaryEntryController
 * @package App\Controller
 */
class DictionaryEntryController extends AbstractController
{
    /**
     * @var DictionaryEntryManager
     */
    private $dictionaryEntryManager;

    /**
     * DictionaryEntryController constructor.
     * @param DictionaryEntryManager $dictionaryEntryManager
     */
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

    /**
     * @Route(name="dictionaryList", path="/list")
     *
     * @return Response
     */
    public function listAction()
    {
        return $this->render('list.html.twig', [
            'dictionaryList' => $this->dictionaryEntryManager->getAllDictionaryEntries(),
        ]);
    }

    /**
     * @Route(name="edit", path="/edit/{id}")
     * @param Request $request
     * @param $id
     *
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $originalDictionaryEntry = $this->dictionaryEntryManager->getDictionaryEntryById((int)$id);
        $form = $this->createForm(DictionaryEntryFormType::class, $originalDictionaryEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dictionaryEntry = $form->getData();
            $this->dictionaryEntryManager->updateDictionaryEntry($dictionaryEntry);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('form/create.html.twig', [
            'dictionaryEntryForm' => $form->createView(),
        ]);
    }
}

