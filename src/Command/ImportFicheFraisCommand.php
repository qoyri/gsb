<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\FicheFrais;
use App\Entity\User;
use App\Entity\Etat;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'app:import-fiche-frais', description: 'Imports fiche frais data from JSON file')]
class ImportFicheFraisCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Charger le fichier JSON contenant les fiches de frais
        $json = file_get_contents('public/FicheFrais.json');
        $data = json_decode($json, true);

        $etatMapping = [
            'RB' => 1, // Remboursé
            'CR' => 2, // Créé
            'VA' => 3, // Validé
            'CL' => 4,
        ];

        foreach ($data as $item) {
            // Rechercher l'utilisateur correspondant via son `idVisiteur`
            $user = $this->em->getRepository(User::class)->findOneBy(['oldId' => $item['idVisiteur']]);
            if (!$user) {
                $io->warning(sprintf('User with oldId "%s" not found. Skipping...', $item['idVisiteur']));
                continue;
            }

            // Rechercher l'état correspondant via le mappage
            if (isset($etatMapping[$item['idEtat']])) {
                $etat = $this->em->getRepository(Etat::class)->find($etatMapping[$item['idEtat']]);
            } else {
                $io->warning(sprintf('Etat with code "%s" not found in the mapping. Skipping...', $item['idEtat']));
                continue;
            }

            // Créer une nouvelle fiche de frais
            $ficheFrais = new FicheFrais();
            $ficheFrais->setVisitor($user);
            $ficheFrais->setEtat($etat);
            $ficheFrais->setNbJustificatifs($item['nbJustificatifs']);
            $ficheFrais->setMontantValid($item['montantValide']);

            $mois = \DateTime::createFromFormat('Ym', $item['mois']); // "202401"
            $ficheFrais->setMois($mois);

            $dateModif = \DateTime::createFromFormat('Y-m-d', $item['dateModif']);
            $ficheFrais->setDateModif($dateModif);

            $this->em->persist($ficheFrais);
        }

        // Synchroniser avec la base de données
        $this->em->flush();

        $io->success('Fiche frais data import completed.');

        return Command::SUCCESS;
    }
}
