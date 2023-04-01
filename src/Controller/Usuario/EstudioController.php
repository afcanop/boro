<?php

namespace App\Controller\Usuario;

use App\Entity\Estudio;
use App\Entity\ExperienciaProfesional;
use App\Entity\Perfil;
use App\Form\Usuario\EstudioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudioController  extends AbstractController
{
    #[Route('/usuario/perfil/estudio/lista', name: 'usuario_perfil_estudio_lista')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($request->request->get('btnEliminar')) {
                $codigo = $request->request->get('btnEliminar');
                $em->getRepository(Estudio::class)->eliminar($codigo);
            }
        }

        $arHojaVida = $em->getRepository(Perfil::class)->hojaVida($this->getUser()->getEmail());
        $arEstudios = $em->getRepository(Estudio::class)->Lista();

        return $this->render('usuario/estudio/lista.html.twig', [
            'arHojaVida' => $arHojaVida,
            'form' => $form->createView(),
            'arEstudios' => $arEstudios,
        ]);
    }

    #[Route('/usuario/perfil/estudio/nuevo/{codigoEstudio}', name: 'usuario_perfil_estudio_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em, $codigoEstudio): Response
    {
        $arExperienciaProfecional = $em->getRepository(ExperienciaProfesional::class)->find($codigoEstudio);
        $arEstudio = $em->getRepository(Estudio::class)->find(1);

        $form = $this->createForm(EstudioType::class, $arEstudio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('btnGuardar')->isClicked()) {
                $arEstudio = $form->getData();
                $em->persist($arEstudio);
                $em->flush();
                return $this->redirect($this->generateUrl('usuario_perfil_estudio_lista'));
            }
        }
        $arHojaVida = $em->getRepository(Perfil::class)->hojaVida($this->getUser()->getEmail());

        return $this->render('usuario/estudio/nuevo.html.twig', [
            'form' => $form->createView(),
            'arHojaVida' => $arHojaVida,

        ]);
    }
}