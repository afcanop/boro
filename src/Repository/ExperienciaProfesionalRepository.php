<?php

namespace App\Repository;

use App\Entity\ExperienciaProfesional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExperienciaProfesional>
 *
 * @method ExperienciaProfesional|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienciaProfesional|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienciaProfesional[]    findAll()
 * @method ExperienciaProfesional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienciaProfesionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienciaProfesional::class);
    }

    public function lista(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.id')
            ->addSelect('e.compania')
            ->addSelect('e.estadoActivo')
            ->addSelect('e.fechaDesde')
            ->addSelect('e.fechaHasta')
            ->addSelect('e.descripcionCargo')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function eliminar($codigoExperienciaLaboral)
    {
        if ($codigoExperienciaLaboral) {
            $arExperienciaLaboral = $this->_em->getRepository(ExperienciaProfesional::class)->find($codigoExperienciaLaboral);
            if ($arExperienciaLaboral){
                $this->_em->remove($arExperienciaLaboral);
                $this->_em->flush();
            }

        }
    }

}
