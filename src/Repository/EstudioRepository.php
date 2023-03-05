<?php

namespace App\Repository;

use App\Entity\Estudio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estudio>
 *
 * @method Estudio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudio[]    findAll()
 * @method Estudio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudio::class);
    }

    public function lista(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.id')
            ->addSelect('e.nombre')
            ->addSelect('e.estadoTerminado')
            ->addSelect('e.fechaDesde')
            ->addSelect('e.fechaHasta')
            ->addSelect('e.titulo')
            ->addSelect('e.institucion')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function eliminar($codigoEstudio)
    {
        if ($codigoEstudio) {
            $arEstudio = $this->_em->getRepository(Estudio::class)->find($codigoEstudio);
            if ($arEstudio){
                $this->_em->remove($arEstudio);
                $this->_em->flush();
            }

        }
    }
}
