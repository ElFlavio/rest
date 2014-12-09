<?php

namespace RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\RestBundle\Entity\User;

class UserController extends Controller
{
    public function indexAction($id)
    {  
        $user = $this->getDoctrine()->getRepository('RestBundle:User')->find($id);
        if (!$user) 
        {
			$response = new Response();
			$response->setContent(json_encode(array('status'=>404,
			'message'=>'not found'
			)));
			$response->setStatusCode(404);
			$response->headers->set('Content-Type', 'application/json');
			return $response;
        }    
        if ($user->getRole() == 'normal')
        {
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
        else
        {
	        $response = new Response();
	        $response->setContent(json_encode(array('status'=>401,
	        'message'=>'unauthorized'
	        )));
			$response->setStatusCode(401);
	        $response->headers->set('Content-Type', 'application/json');
	        return $response;
		}
    }
    public function addAction()
    {
    	if ($request->getMethod() == 'POST')
    	{
	        $response = new Response();
	        $response->setContent(json_encode(array('status'=>401,
	        'message'=>'unauthorized'
	        )));
			$response->setStatusCode(401);
	        $response->headers->set('Content-Type', 'application/json');
	        return $response;
  		}
    }
}