<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Client;
use App\Entity\Menu;
use App\Entity\Type;
use App\Entity\Commande;
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

        $manager->flush();
    }
}