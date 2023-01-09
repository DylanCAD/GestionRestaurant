<?php

namespace App\DataFixtures;

use App\Entity\Accompagnement;
use Faker\Factory;
use App\Entity\Menu;
use App\Entity\Type;
use App\Entity\Client;
use App\Entity\Boisson;
use App\Entity\Commande;
use App\Entity\Sauce;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        
        $fichierTypeCsv=fopen(__DIR__."/type.csv","r");
        while (!feof($fichierTypeCsv)) {
            $lesTypes[]=fgetcsv($fichierTypeCsv);
        }
        fclose($fichierTypeCsv);
        
        foreach ($lesTypes as $value) {
            $type=new Type();
            $type   ->setId(intval($value[0]))
                    ->setGenretype($value[1]);
            $manager->persist($type);
            $this->addReference("type".$value[0],$type);
        }

        $fichierMenuCsv=fopen(__DIR__."/menu.csv","r");
        while (!feof($fichierMenuCsv)) {
            $lesMenus[]=fgetcsv($fichierMenuCsv);
        }
        fclose($fichierMenuCsv);
        
        
        foreach ($lesMenus as $value) {
            $menu=new Menu();
            $menu   ->setId(intval($value[0]))
                    ->setNomMenu($value[1])
                    ->setPrixMenu(intval($value[2]))
                    ->setImageMenu('')
                    ->setDescriptionMenu("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                    ->setType($this->getReference("type".$value[3]));
            $manager->persist($menu);
        }
        
        $fichierClientCsv=fopen(__DIR__."/client.csv","r");
        while (!feof($fichierClientCsv)) {
            $lesClients[]=fgetcsv($fichierClientCsv);
        }
        fclose($fichierClientCsv);
        
        foreach ($lesClients as $value) {
            $client=new Client();
            $client ->setId(intval($value[0]))
                    ->setNomCli($value[1])
                    ->setPrenomCli($value[2])
                    ->setRueCli($value[3])
                    ->setCpCli($value[4])
                    ->setVilleCli($value[5])
                    ->setTelCli($value[6]);
            $manager->persist($client);
            $this->addReference("client".$value[0],$client);
        }

        $fichierCommandeCsv=fopen(__DIR__."/commande.csv","r");
        while (!feof($fichierCommandeCsv)) {
            $lesCommandes[]=fgetcsv($fichierCommandeCsv);
        }
        fclose($fichierCommandeCsv);
        
        foreach ($lesCommandes as $value) {
            $commande=new Commande();
            $commande   ->setId(intval($value[0]))
                        ->setDateCom(new \DateTime($value[1]))
                        ->setClient($this->getReference("client".$value[2]));
            $manager->persist($commande);
        }

        $fichierBoissonCsv=fopen(__DIR__."/boisson.csv","r");
        while (!feof($fichierBoissonCsv)) {
            $lesBoissons[]=fgetcsv($fichierBoissonCsv);
        }
        fclose($fichierBoissonCsv);
        
        foreach ($lesBoissons as $value) {
            $boisson=new Boisson();
            $boisson   ->setId(intval($value[0]))
                        ->setNom($value[1])
                        ->setImage('')
                        ->setPrix(intval($value[2]));
            $manager->persist($boisson);
        }

        $fichierAccompagnementCsv=fopen(__DIR__."/accompagnement.csv","r");
        while (!feof($fichierAccompagnementCsv)) {
            $lesAccompagnements[]=fgetcsv($fichierAccompagnementCsv);
        }
        fclose($fichierAccompagnementCsv);
        
        foreach ($lesAccompagnements as $value) {
            $accompagnement=new Accompagnement();
            $accompagnement ->setId(intval($value[0]))
                            ->setNomAccompagnement($value[1])
                            ->setImageAccompagnement('')
                            ->setPrixAccompagnement(intval($value[2]));
            $manager->persist($accompagnement);
        }

        $fichierSauceCsv=fopen(__DIR__."/sauce.csv","r");
        while (!feof($fichierSauceCsv)) {
            $lesSauces[]=fgetcsv($fichierSauceCsv);
        }
        fclose($fichierSauceCsv);
        
        foreach ($lesSauces as $value) {
            $sauce=new Sauce();
            $sauce ->setId(intval($value[0]))
                            ->setNomSauce($value[1])
                            ->setImageSauce('')
                            ->setPrixSauce(intval($value[2]));
            $manager->persist($sauce);
        }

        $manager->flush();
    }
}