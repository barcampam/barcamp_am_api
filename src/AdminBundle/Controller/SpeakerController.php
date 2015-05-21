<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AdminBundle\Entity\Speaker;
use AdminBundle\Form\SpeakerType;

/**
 * Speaker controller.
 *
 * @Route("/speaker")
 */
class SpeakerController extends Controller
{

    /**
     * Lists all Speaker entities.
     *
     * @Route("/", name="admin_speaker")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Speaker')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Speaker entity.
     *
     * @Route("/", name="admin_speaker_create")
     * @Method("POST")
     * @Template("AdminBundle:Speaker:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Speaker();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_speaker_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Speaker entity.
     *
     * @param Speaker $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Speaker $entity)
    {
        $form = $this->createForm(new SpeakerType(), $entity, array(
            'action' => $this->generateUrl('admin_speaker_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Speaker entity.
     *
     * @Route("/new", name="admin_speaker_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Speaker();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Speaker entity.
     *
     * @Route("/{id}", name="admin_speaker_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Speaker entity.
     *
     * @Route("/{id}/edit", name="admin_speaker_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
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
    * Creates a form to edit a Speaker entity.
    *
    * @param Speaker $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Speaker $entity)
    {
        $form = $this->createForm(new SpeakerType(), $entity, array(
            'action' => $this->generateUrl('admin_speaker_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Speaker entity.
     *
     * @Route("/{id}", name="admin_speaker_update")
     * @Method("PUT")
     * @Template("AdminBundle:Speaker:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_speaker_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Speaker entity.
     *
     * @Route("/{id}", name="admin_speaker_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Speaker')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Speaker entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_speaker'));
    }

    /**
     * Creates a form to delete a Speaker entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_speaker_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
