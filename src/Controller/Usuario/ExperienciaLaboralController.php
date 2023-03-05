<?php

namespace App\Controller\Usuario;

use App\Entity\ExperienciaProfesional;
use App\Entity\Perfil;
use App\Form\MiperfilType;
use App\Form\Usuario\ExperienciaLaboralType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienciaLaboralController extends AbstractController
{
    #[Route('/usuario/perfil/experiencialaboral', name: 'usuario_perfil_experiencia_laboral_lista')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $arPerfil = $em->getRepository(Perfil::class)->find(1);
        $arExperienciaProfecionales = $em->getRepository(ExperienciaProfesional::class)->Lista();
        return $this->render('usuario/perfil/experiencialaboral/lista.html.twig', [
            'arPerfil' => $arPerfil,
            'arExperienciaProfecionales' => $arExperienciaProfecionales
        ]);
    }

    #[Route('/usuario/perfil/experiencialaboral/nuevo/{codigoExperienciaLaboral}', name: 'usuario_perfil_experiencia_laboral_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em, $codigoExperienciaLaboral): Response
    {
        $arExperienciaProfecional = $em->getRepository(ExperienciaProfesional::class)->find($codigoExperienciaLaboral);
        $arPerfil = $em->getRepository(Perfil::class)->find(1);

        $form = $this->createForm(ExperienciaLaboralType::class, $arExperienciaProfecional);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('btnGuardar')->isClicked()) {
                $arExperienciaProfecional = $form->getData();
                $em->persist($arExperienciaProfecional);
                $em->flush();
                return $this->redirect($this->generateUrl('usuario_perfil_experiencia_laboral_lista'));
            }
        }

        return $this->render('usuario/perfil/experiencialaboral/nuevo.html.twig', [
            'form' => $form->createView(),
            'arPerfil' => $arPerfil
        ]);
    }
}
