<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/user/test", name="testRoleUser")
     */
    public function testRoleUserAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('exemples_roles/hello-world.html.twig');
    }

    /**
     * @Route("/admin/test", name="testRoleAdmin")
     */
    public function testRoleAdminAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Va modifier l'email de l'utilisateur connecté
        $user = $this->getUser()->setEmail('tutoFOSUserBundle@supinfo.com');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->render('exemples_roles/hello-world-admin.html.twig');
    }
}
