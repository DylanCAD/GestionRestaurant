<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\ORM\Query;
use App\Model\FiltreMenu;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Menu>
 *
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    public function add(Menu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Menu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

     /**
     * @return Menu[] Returns an array of Menu objects
     */

        public function listeMenusCompletePaginee(FiltreMenu $filtre=null): ?Query
        {
            $query= $this->createQueryBuilder('m')
            ->select('m')
            ->orderBy('m.id', 'ASC');
            if(!empty($filtre->nomMenu)){
                $query->andWhere('m.nomMenu like :nomcherche')
                ->setParameter('nomcherche', "%{$filtre->nomMenu}%");
            }
            if(!empty($filtre->type)){
                $query->andWhere('m.type = :typecherche')
                ->setParameter('typecherche', $filtre->type);
            }
        ;
        return $query->getQuery();
    }

//    public function findOneBySomeField($value): ?Menu
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
