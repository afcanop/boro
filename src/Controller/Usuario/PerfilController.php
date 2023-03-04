<?php

namespace App\Controller\Usuario;

use App\Entity\Perfil;
use App\Form\MiperfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    #[Route('/usuario/miperfil', name: 'usuario_mi_perfil')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $arPerfil = $em->getRepository(Perfil::class)->find(1);

        $form = $this->createForm(MiperfilType::class, $arPerfil);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('btnGuardar')->isClicked()) {
                $arPerfil = $form->getData();
                $em->persist($arPerfil);
                $em->flush();
                //return $this->redirect($this->generateUrl('cartera_administracion_general_grupo_detalle', array('id' => $arRegistro->getCodigoGrupoPk())));
            }
        }

        return $this->render('perfil/index.html.twig', [
            'form' => $form->createView(),
            'arPerfil' => $arPerfil
        ]);
    }
}
