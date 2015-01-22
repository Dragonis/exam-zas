<?php

namespace BDDTutorial\WojtekSasielaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BDDTutorial\WojtekSasielaBundle\Entity\Klient;
use BDDTutorial\WojtekSasielaBundle\Form\KlientType;

/**
 * Klient controller.
 *
 * @Route("/admin/klient")
 */
class KlientController extends Controller
{

    /**
     * Lists all Klient entities.
     *
     * @Route("/", name="admin_klient")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BDDTutorialWojtekSasielaBundle:Klient')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Klient entity.
     *
     * @Route("/", name="admin_klient_create")
     * @Method("POST")
     * @Template("BDDTutorialWojtekSasielaBundle:Klient:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Klient();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_klient_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Klient entity.
     *
     * @param Klient $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Klient $entity)
    {
        $form = $this->createForm(new KlientType(), $entity, array(
            'action' => $this->generateUrl('admin_klient_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Klient entity.
     *
     * @Route("/new", name="admin_klient_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Klient();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Klient entity.
     *
     * @Route("/{id}", name="admin_klient_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Klient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Klient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Klient entity.
     *
     * @Route("/{id}/edit", name="admin_klient_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Klient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Klient entity.');
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
    * Creates a form to edit a Klient entity.
    *
    * @param Klient $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Klient $entity)
    {
        $form = $this->createForm(new KlientType(), $entity, array(
            'action' => $this->generateUrl('admin_klient_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Klient entity.
     *
     * @Route("/{id}", name="admin_klient_update")
     * @Method("PUT")
     * @Template("BDDTutorialWojtekSasielaBundle:Klient:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Klient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Klient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_klient_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Klient entity.
     *
     * @Route("/{id}", name="admin_klient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BDDTutorialWojtekSasielaBundle:Klient')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Klient entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_klient'));
    }

    /**
     * Creates a form to delete a Klient entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_klient_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
