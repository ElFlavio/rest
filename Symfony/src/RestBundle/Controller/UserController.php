<?php

namespace RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\RestBundle\Entity\User;

class UserController extends Controller
{
    public function indexAction($id)
    {  
            $user = $this->getDoctrine()->getRepository('RestBundle:User')->find($id);
        if (!$user) 
            {
            throw $this->createNotFoundException('Aucun produit trouvé pour cet id : '.$id);
            }    
        //var_dump($user);
        $response = new Response();
        $response->setContent(json_encode(array('id'=>$user->getId(),
        'lastname'=>$user->getLastname(),
        'firstname'=>$user->getFirstname(),
        'email'=>$user->getEmail(),
        'role'=>$user->getRole()
         )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}