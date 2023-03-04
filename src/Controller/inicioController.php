<?php

namespace App\Controller;

use App\Entity\Perfil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class inicioController extends AbstractController
{
    #[Route('/inicio', name: 'inicio')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $arPerfil = $em->getRepository(Perfil::class)->find(1);
        return $this->render('administracion/inicio.html.twig',[
            'arPerfil' => $arPerfil
        ]);
    }
}