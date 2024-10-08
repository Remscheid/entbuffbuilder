<?php

namespace App\Controller;

use App\Entity\Buffs;
use App\Repository\BuffsRepository;
use Doctrine\Common\Collections\Criteria;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    #[Route('/legends', name: 'app_legends')]
    public function legends(
        LoggerInterface $logger,
        BuffsRepository $buffsRepository,
        #[MapQueryParameter] ?string $q,
    ): Response {
        $logger->info('Calling route: legends');

        $selected = is_string($q) ? explode('|', $q) : [];

        $allBuffs = $this->getBuffsByServer('legends', $buffsRepository);

        $this->setAssignmentsIntoBuffs($selected, $allBuffs);

        $buffGroups = $this->getBuffsInGroups($allBuffs);

        return $this->render('main/legends.html.twig', [
            'pointsMax' => 20,
            'allBuffs' => $allBuffs,
            'buffGroups' => $buffGroups,
            'template' => '/tt Could you buff me with %Buffs%, please?',
        ]);
    }

    #[Route('/r3', name: 'app_r3')]
    #[Route('/restoration', name: 'app_restoration')]
    public function restoration(
        LoggerInterface $logger,
        BuffsRepository $buffsRepository,
        #[MapQueryParameter] ?string $q,
    ): Response {
        $logger->info('Calling route: restoration');

        $selected = is_string($q) ? explode('|', $q) : [];

        $allBuffs = $this->getBuffsByServer('restoration', $buffsRepository);

        $this->setAssignmentsIntoBuffs($selected, $allBuffs);

        $buffGroups = $this->getBuffsInGroups($allBuffs);

        return $this->render('main/restoration.html.twig', [
            'pointsMax' => 20,
            'allBuffs' => $allBuffs,
            'buffGroups' => $buffGroups,
            'template' => '/tt Could you buff me with %Buffs%, please?',
        ]);
    }

    #[Route('/resurgence', name: 'app_resurgence')]
    public function resurgence(
        LoggerInterface $logger,
        BuffsRepository $buffsRepository,
        #[MapQueryParameter] ?string $q,
    ): Response {
        $logger->info('Calling route: resurgence');

        $selected = is_string($q) ? explode('|', $q) : [];

        $allBuffs = $this->getBuffsByServer('resurgence', $buffsRepository);

        $this->setAssignmentsIntoBuffs($selected, $allBuffs);

        $buffGroups = $this->getBuffsInGroups($allBuffs);

        return $this->render('main/resurgence.html.twig', [
            'pointsMax' => 40,
            'allBuffs' => $allBuffs,
            'buffGroups' => $buffGroups,
            'template' => '/tt Could you buff me with %Buffs%, please?',
        ]);
    }

    /**
     * @param string $server
     * @param BuffsRepository $buffsRepository
     * @return array<Buffs>
     */
    private function getBuffsByServer(
        string $server,
        BuffsRepository $buffsRepository,
    ): array {
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('server', $server));

        return $buffsRepository->matching($criteria)->toArray();
    }

    /**
     * @param array<Buffs> $buffs
     * @return array
     */
    private function getBuffsInGroups(
        array $buffs,
    ): array {
        $buffGroups = [];

        foreach ($buffs as $buff) {
            $category = $buff->getCategory();
            if (!array_key_exists($category, $buffGroups)) {
                $buffGroups[$category] = [];
            }
            $buffGroups[$category][] = $buff;
        }

        return $buffGroups;
    }

    /**
     * @param array<string> $preselection
     * @param array<Buffs> $buffs
     * @return void
     */
    private function setAssignmentsIntoBuffs(array $preselection, array $buffs): void
    {
        if (count($preselection) !== count($buffs)) {
            return;
        }

        for ($i = 0; $i < count($preselection); $i++) {
            $assignments = intval($preselection[$i]);
            $buffs[$i]->setAssignments($assignments);
        }
    }
}
