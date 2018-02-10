<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SdsData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Sdsdatum controller.
 *
 */
class SdsDataController extends Controller
{
    /**
     * Lists all sdsDatum entities.
     *
     */

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sdsDatas = $em->getRepository('AppBundle:SdsData')->findAll();

        return $this->render('sdsdata/index.html.twig', array(
            'sdsDatas' => $sdsDatas,
        ));
    }

    /**
     * Creates a new sdsDatum entity.
     *
     */
    public function newAction(Request $request)
    {
        $sdsDatum = new SdsData();
        $form = $this->createForm('AppBundle\Form\SdsDataType', $sdsDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $sdsDatum->getDirfilesds();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('pdf_dir'),
                $fileName
            );

            $sdsDatum->setDirfilesds($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($sdsDatum);
            $em->flush();

            return $this->redirectToRoute('sdsmount_show', array('idSds' => $sdsDatum->getIdsds()));
        }

        return $this->render('sdsdata/new.html.twig', array(
            'sdsDatum' => $sdsDatum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sdsDatum entity.
     *
     */
    public function showAction(SdsData $sdsDatum)
    {
        $deleteForm = $this->createDeleteForm($sdsDatum);

        return $this->render('sdsdata/show.html.twig', array(
            'sdsDatum' => $sdsDatum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sdsDatum entity.
     *
     */
    public function editAction(Request $request, SdsData $sdsDatum)
    {
        $deleteForm = $this->createDeleteForm($sdsDatum);
        $editForm = $this->createForm('AppBundle\Form\SdsDataType', $sdsDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sdsmount_edit', array('idSds' => $sdsDatum->getIdsds()));
        }

        return $this->render('sdsdata/edit.html.twig', array(
            'sdsDatum' => $sdsDatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function downloadAction(SdsData $sdsDatum){
        $file = $this->getDoctrine()->getRepository( 'AppBundle:SdsData' )->find($sdsDatum);
        $filename = $file->dirFileSds;

        return new BinaryFileResponse($this->getParameter('pdf_dir').'/'.$filename);
        //print_r($filename);
    }

    /**
     * Deletes a sdsDatum entity.
     *
     */
    public function deleteAction(Request $request, SdsData $sdsDatum)
    {
        $form = $this->createDeleteForm($sdsDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sdsDatum);
            $em->flush();
        }

        return $this->redirectToRoute('sdsmount_index');
    }

    /**
     * Creates a form to delete a sdsDatum entity.
     *
     * @param SdsData $sdsDatum The sdsDatum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SdsData $sdsDatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sdsmount_delete', array('idSds' => $sdsDatum->getIdsds())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
