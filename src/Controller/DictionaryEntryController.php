<?php

namespace App\Controller;

use App\Entity\DictionaryEntry;
use App\Manager\DictionaryEntryManager;
use App\Form\DictionaryEntryFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
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
     * @Route(name="create", path="/admin/create")
     *
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function createAction(Request $request)
    {
        $dictionaryEntry = new DictionaryEntry('', '');
        $form = $this->createForm(DictionaryEntryFormType::class, $dictionaryEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dictionaryEntry = $this->dictionaryEntryManager->createDictionaryEntry($dictionaryEntry);

            return $this->render('dictionary_entry.html.twig', [
                'dictionaryEntry' => $dictionaryEntry,
            ]);
        }

        return $this->render('form/create.html.twig', [
            'dictionaryEntryForm' => $form->createView(),
        ]);
    }

    /**
     * @Route(name="dictionaryList", path="/admin/list")
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
     * @Route(name="edit", path="/admin/edit/{id}")
     * @param Request $request
     * @param $id
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function editAction(Request $request, $id)
    {
        $dictionaryEntry = $this->dictionaryEntryManager->getDictionaryEntryById((int)$id);
        $form = $this->createForm(DictionaryEntryFormType::class, $dictionaryEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dictionaryEntry = $this->dictionaryEntryManager->updateDictionaryEntry($dictionaryEntry);

            return $this->render('dictionary_entry.html.twig', [
                'dictionaryEntry' => $dictionaryEntry,
            ]);
        }

        return $this->render('form/create.html.twig', [
            'dictionaryEntryForm' => $form->createView(),
        ]);
    }

    /**
     * @Route(name="delete", path="/admin/delete/{id}")
     * @param Request $request
     * @param $id
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteAction(Request $request, $id)
    {
        $dictionaryEntry = $this->dictionaryEntryManager->getDictionaryEntryById((int)$id);
        $this->dictionaryEntryManager->deleteDictionaryEntry($dictionaryEntry);

        return $this->redirectToRoute('dictionaryList');
    }

    /**
     * @Route(name="search", path="/search")
     *
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function searchAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('searchTerm', SearchType::class)
            ->add('search', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $searchTerm = $form->getData();

            $dictionaryEntry = $this->dictionaryEntryManager->getDictionaryEntryByTerm($searchTerm['searchTerm']);

            return $this->redirectToRoute("view", ['id' => $dictionaryEntry->getId()]);
        }

        return $this->render('form/search.html.twig', [
            'searchForm' => $form->createView(),
        ]);
    }

    /**
     * @Route(name="view", path="/view/{id}")
     * @param Request $request
     * @param $id
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function viewAction(Request $request, $id)
    {
        $dictionaryEntry = $this->dictionaryEntryManager->getDictionaryEntryById((int)$id);

        return $this->render('dictionary_entry.html.twig', [
            'dictionaryEntry' => $dictionaryEntry,
        ]);
    }
}

