<?php

namespace App\Repository;

use App\Entity\ExperienciaProfesional;
use App\Entity\Perfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PerfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perfil::class);
    }

    public function hojaVida($codigoUsuario)
    {
        $arPerfil = $this->createQueryBuilder('e')
            ->select('e.id')
            ->addSelect('e.nombre1')
            ->addSelect('e.nombre2')
            ->addSelect('e.apellido1')
            ->addSelect('e.apellido2')
            ->addSelect('e.correo')
            ->orderBy('e.id', 'ASC')
            ->where("e.id = {$codigoUsuario}")
            ->getQuery()
            ->getSingleResult();


        $arExperienciaProfecionales = $this->_em->getRepository(ExperienciaProfesional::class)->lista();

        return (object)[
            'arPerfil' => (object)$arPerfil,
            'arExperienciaProfecionales' => $arExperienciaProfecionales
        ];


    }
}
