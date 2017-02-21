<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository('AppBundle:Employee')->findBy(['isRemoved' => 'false']);

        return $this->render('@App/employee/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm('AppBundle\Form\EmployeeType', $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employee_index', array('id' => $employee->getId()));
        }

        return $this->render('@App/employee/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     */
    public function editAction(Request $request, Employee $employee)
    {
        $originalAddresses = new ArrayCollection();
        foreach ($employee->getAddresses() as $address) {
            $originalAddresses->add($address);
        }
        $originalPhones = new ArrayCollection();
        foreach ($employee->getPhones() as $address) {
            $originalPhones->add($address);
        }
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('AppBundle\Form\EmployeeType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($originalAddresses as $address) {
                if (false === $employee->getAddresses()->contains($address)) {
                    $employee->getAddresses()->removeElement($address);
                    $this->getDoctrine()->getManager()->remove($address);
                }
            }
            foreach ($originalPhones as $phone) {
                if (false === $employee->getPhones()->contains($phone)) {
                    $employee->getAddresses()->removeElement($phone);
                    $this->getDoctrine()->getManager()->remove($phone);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employee_edit', array('id' => $employee->getId()));
        }

        return $this->render('@App/employee/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     */
    public function deleteAction(Employee $employee)
    {
        $em = $this->getDoctrine()->getManager();
        $employee->setIsRemoved(true);
        $em->flush();

        return $this->redirectToRoute('employee_index');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employee $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employee_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
