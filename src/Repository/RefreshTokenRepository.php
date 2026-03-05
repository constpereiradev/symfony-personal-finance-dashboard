<?php

namespace App\Repository;

use App\Entity\RefreshToken;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefreshToken>
 */
class RefreshTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefreshToken::class);
    }

    public function store(array $data): RefreshToken
    {
        $refreshToken = new RefreshToken();
        $refreshToken->setUser($data['user']);
        $refreshToken->setToken($data['token']);
        $refreshToken->setExpiresAt($data['expires_at']);

        $this->getEntityManager()->persist($refreshToken);
        $this->getEntityManager()->flush();

        return $refreshToken;
    }

    public function findAllByUser(User $user): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.user = :user')
            ->setParameter('user', $user->getId())
            ->getQuery()
            ->getResult();
    }

    public function findOneByToken(string $token): ?RefreshToken
    {
        return $this->findOneBy(['token' => $token]);
    }

    public function delete(RefreshToken $refreshToken): void
    {
        $this->getEntityManager()->remove($refreshToken);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return RefreshToken[] Returns an array of RefreshToken objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RefreshToken
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
