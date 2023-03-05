<?php

namespace App\Controller\Usuario;

use App\Entity\ExperienciaProfesional;
use App\Entity\Perfil;
use App\Form\Usuario\ExperienciaLaboralType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienciaLaboralController extends AbstractController
{
    #[Route('/usuario/perfil/experiencialaboral/lista', name: 'usuario_perfil_experiencialaboral_lista')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createFormBuilder()
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($request->request->get('btnEliminar')) {
                $codigo = $request->request->get('btnEliminar');
                $em->getRepository(ExperienciaProfesional::class)->eliminar($codigo);
            }
        }
        $arHojaVida = $em->getRepository(Perfil::class)->hojaVida(1);
        $arExperienciaProfecionales = $em->getRepository(ExperienciaProfesional::class)->Lista();

        return $this->render('usuario/experiencialaboral/lista.html.twig', [
            'arHojaVida' => $arHojaVida,
            'form' => $form->createView(),
            'arExperienciaProfecionales' => $arExperienciaProfecionales,
        ]);
    }

    #[Route('/usuario/perfil/experiencialaboral/nuevo/{codigoExperienciaLaboral}', name: 'usuario_perfil_experiencialaboral_nuevo')]
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
                return $this->redirect($this->generateUrl('usuario_perfil_experiencialaboral_lista'));
            }
        }
        $arHojaVida = $em->getRepository(Perfil::class)->hojaVida(1);

        return $this->render('usuario/experiencialaboral/nuevo.html.twig', [
            'form' => $form->createView(),
            'arHojaVida' => $arHojaVida,

        ]);
    }
}
