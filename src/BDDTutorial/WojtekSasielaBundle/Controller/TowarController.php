<?php

namespace BDDTutorial\WojtekSasielaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BDDTutorial\WojtekSasielaBundle\Entity\Towar;
use BDDTutorial\WojtekSasielaBundle\Form\TowarType;

/**
 * Towar controller.
 *
 * @Route("/admin/towar")
 */
class TowarController extends Controller
{

    /**
     * Lists all Towar entities.
     *
     * @Route("/", name="admin_towar")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BDDTutorialWojtekSasielaBundle:Towar')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Towar entity.
     *
     * @Route("/", name="admin_towar_create")
     * @Method("POST")
     * @Template("BDDTutorialWojtekSasielaBundle:Towar:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Towar();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_towar_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Towar entity.
     *
     * @param Towar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Towar $entity)
    {
        $form = $this->createForm(new TowarType(), $entity, array(
            'action' => $this->generateUrl('admin_towar_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Towar entity.
     *
     * @Route("/new", name="admin_towar_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Towar();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Towar entity.
     *
     * @Route("/{id}", name="admin_towar_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Towar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Towar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Towar entity.
     *
     * @Route("/{id}/edit", name="admin_towar_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Towar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Towar entity.');
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
    * Creates a form to edit a Towar entity.
    *
    * @param Towar $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Towar $entity)
    {
        $form = $this->createForm(new TowarType(), $entity, array(
            'action' => $this->generateUrl('admin_towar_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Towar entity.
     *
     * @Route("/{id}", name="admin_towar_update")
     * @Method("PUT")
     * @Template("BDDTutorialWojtekSasielaBundle:Towar:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Towar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Towar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_towar_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Towar entity.
     *
     * @Route("/{id}", name="admin_towar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Towar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Towar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_towar'));
    }

    /**
     * Creates a form to delete a Towar entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_towar_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
