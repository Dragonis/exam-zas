<?php

namespace BDDTutorial\WojtekSasielaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BDDTutorial\WojtekSasielaBundle\Entity\Zamowienia;
use BDDTutorial\WojtekSasielaBundle\Form\ZamowieniaType;

/**
 * Zamowienia controller.
 *
 * @Route("/admin/zamowienia")
 */
class ZamowieniaController extends Controller
{

    /**
     * Lists all Zamowienia entities.
     *
     * @Route("/", name="admin_zamowienia")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BDDTutorialWojtekSasielaBundle:Zamowienia')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Zamowienia entity.
     *
     * @Route("/", name="admin_zamowienia_create")
     * @Method("POST")
     * @Template("BDDTutorialWojtekSasielaBundle:Zamowienia:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Zamowienia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_zamowienia_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Zamowienia entity.
     *
     * @param Zamowienia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Zamowienia $entity)
    {
        $form = $this->createForm(new ZamowieniaType(), $entity, array(
            'action' => $this->generateUrl('admin_zamowienia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Zamowienia entity.
     *
     * @Route("/new", name="admin_zamowienia_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Zamowienia();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Zamowienia entity.
     *
     * @Route("/{id}", name="admin_zamowienia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Zamowienia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zamowienia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Zamowienia entity.
     *
     * @Route("/{id}/edit", name="admin_zamowienia_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Zamowienia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zamowienia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Zamowienia entity.
    *
    * @param Zamowienia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Zamowienia $entity)
    {
        $form = $this->createForm(new ZamowieniaType(), $entity, array(
            'action' => $this->generateUrl('admin_zamowienia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Zamowienia entity.
     *
     * @Route("/{id}", name="admin_zamowienia_update")
     * @Method("PUT")
     * @Template("BDDTutorialWojtekSasielaBundle:Zamowienia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Zamowienia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zamowienia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_zamowienia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Zamowienia entity.
     *
     * @Route("/{id}", name="admin_zamowienia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Zamowienia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Zamowienia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_zamowienia'));
    }

    /**
     * Creates a form to delete a Zamowienia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_zamowienia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
