<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\PropertySearch;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PaginatorInterface $paginatorInterface
    ) {
        parent::__construct($registry, Car::class);
    }


    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function ByCars(int $page){
        $data = $this->createQueryBuilder('c');
        $cars = $this->paginatorInterface->paginate($data, $page, 6);
        return $cars;


    }
 

    public function findBySearch(PropertySearch $search, $page, $limit)
    {

        $data = $this->createQueryBuilder('c');


       if ($search->getKilometerMin()) {
           $data = $data
               ->andWhere('c.kilometer >= :kilometer')
               ->setParameter('kilometer', $search->getKilometerMin());
       }

       if ($search->getKilometerMax()) {
           $data = $data
               ->andWhere('c.kilometer <= :kilometer2')
               ->setParameter('kilometer2', $search->getKilometerMax());
       }

        if ($search->getPriceMin()) {
            $data = $data
                ->andWhere('c.price >= :price')
                ->setParameter('price', $search->getPriceMin());
        }
        if ($search->getPriceMax()) {
            $data = $data
                ->andWhere('c.price <= :price2')
                ->setParameter('price2', $search->getPriceMax());
        }

        if ($search->getYearMin()) {
            $data = $data
                ->andWhere('c.year >= :year')
                ->setParameter('year', DateTime::createFromFormat('d-m-Y', '01-01-'.$search->getYearMin()));
        }

        if ($search->getYearMax()) {
            $data = $data
                ->andWhere('c.year <= :year2')
                ->setParameter('year2', DateTime::createFromFormat('d-m-Y', '31-12-'.$search->getYearMax()));
        }

        if ($search->getSortBy() === 'kilometerMin') {
            $data = $data
            ->orderBy('c.kilometer', 'ASC');
        }

        if ($search->getSortBy() === 'kilometerMax') {
            $data = $data
            ->orderBy('c.kilometer', 'DESC');
        }

        if ($search->getSortBy() === 'priceMin') {
            $data = $data
            ->orderBy('c.price', 'ASC');
        }

        if ($search->getSortBy() === 'priceMax') {
            $data = $data
            ->orderBy('c.price', 'DESC');
        }

        if ($search->getSortBy() === 'yearMin') {
            $data = $data
            ->orderBy('c.year', 'ASC');
        }

        if ($search->getSortBy() === 'yearMax') {
            $data = $data
            ->orderBy('c.year', 'DESC');
        }

        $data = $data
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return $data;
    }

    /**
     * cette method permet de calculer le nombre de résultat selon les recherches éffectuées
     *
     * @param PropertySearch $search
     * @return mixed
     */
    public function getTotalAnnonces(PropertySearch $search)
    {
        $data =  $this->createQueryBuilder('c')
                    ->select('COUNT(c)');


        if ($search->getKilometerMin()) {
           $data = $data
               ->andWhere('c.kilometer >= :kilometer')
               ->setParameter('kilometer', $search->getKilometerMin());
        }
             
        if ($search->getKilometerMax()) {
           $data = $data
               ->andWhere('c.kilometer <= :kilometer2')
               ->setParameter('kilometer2', $search->getKilometerMax());
        }
             
        if ($search->getPriceMin()) {
            $data = $data
                ->andWhere('c.price >= :price')
                ->setParameter('price', $search->getPriceMin());
        }
        if ($search->getPriceMax()) {
            $data = $data
                ->andWhere('c.price <= :price2')
                ->setParameter('price2', $search->getPriceMax());
        }
             
        if ($search->getYearMin()) {
            $data = $data
                ->andWhere('c.year >= :year')
                ->setParameter('year', DateTime::createFromFormat('d-m-Y', '01-01-'.$search->getYearMin()));
        }
             
        if ($search->getYearMax()) {
            $data = $data
                ->andWhere('c.year <= :year2')
                ->setParameter('year2', DateTime::createFromFormat('d-m-Y', '31-12-'.$search->getYearMax()));
        }



        return $data->getQuery()->getSingleScalarResult();
    }

    



//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
