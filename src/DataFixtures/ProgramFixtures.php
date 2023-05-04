<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'La Casa de Papel',
            'category' => 'Action',
            'synopsis' => 'série action',
        ],
        [
            'title' => 'Narcos',
            'category' => 'Action',
            'synopsis' => 'série action',
        ],
        [
            'title' => 'Daredevil',
            'category' => 'Action',
            'synopsis' => 'série action',
        ],
        [
            'title' => 'Vikings',
            'category' => 'Action',
            'synopsis' => 'série action',
        ],
        [
            'title' => 'Les Simpson',
            'category' => 'Animation',
            'synopsis' => 'Salut Homer !',
        ],
        [
            'title' => 'Adventure Time',
            'category' => 'Animation',
            'synopsis' => 'série animation',
        ],
        [
            'title' => 'Stranger Things',
            'category' => 'Horreur',
            'synopsis' => 'série horreur',
        ]


    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $series) {

            $program = new Program();
            $program->setTitle($series['title']);
            $program->setSynopsis($series['synopsis']);
            $program->setCategory($this->getReference('category_' . $series['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
