<?php

namespace App\DataFixtures;

use Faker\Factory;

use App\Entity\Menu;
use App\Entity\Type;
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
                    ->setImageMenu('https://randomuser.me/api/portraits/'.".jpg")
                    ->setDescriptionMenu("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                    ->setType($this->getReference("type".$value[3]));
            $manager->persist($menu);
        }
        $manager->flush();
    }
}