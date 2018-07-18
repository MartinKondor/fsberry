<?php

namespace App\Controller;

use App\Entity\{ Friend, Action };
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{ Response, JsonResponse, Request };

class MessageController extends Controller
{
    /**
     * @Route("/messages", name="messages", methods={ "GET", "POST" })
     */
    public function messages()
    {
        $user = $this->getUser();

        return $this->render('users/messages.html.twig', [
            'contacts' => $this->getDoctrine()
                            ->getRepository(Friend::class)
                            ->findContacts($user->getUserId())
        ]);
    }

    /**
     * @Route("/messages/send/{toUserId}", name="send_message", methods={ "POST" })
     */
    public function sendMessage($toUserId, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $messageData = $request->request->all();

        $message = new Action();
        $message->setEntityId($toUserId)
            ->setUserId($user->getUserId())
            ->setToUserId($toUserId)
            ->setActionDate(new \DateTime())
            ->setEntityType('message')
            ->setActionType('message')
            ->setContent($messageData['message']);

        $em->persist($message);
        $em->flush();

        return new Response('success');
    }

    /**
     * @Route("/messages/get", name="get_messages", methods={ "POST" })
     */
    public function getMessages(Request $request)
    {
        // List messages from a specific user in json
        $user = $this->getUser();
        $messageData = $request->request->all();

        $messagesBetweenUsers = $this->getDoctrine()
                            ->getRepository(Action::class)
                            ->findMessages($user->getUserId(), $messageData['fromUserId']);

        return new JsonResponse([
            'messages' => $messagesBetweenUsers
        ]);
    }
}