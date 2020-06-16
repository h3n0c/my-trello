<?php

namespace App\DataFixtures;

use App\Entity\Board;
use App\Entity\BoardColumn;
use App\Entity\TaskColumn;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $boardData = $this->getData();

        $board = new Board();
        $board->setName($boardData['name']);

        $manager->persist($board);

        $columns = [];
        foreach ($boardData['columns'] as $columnData) {
            $column = new BoardColumn();
            $column->setName($columnData['name']);

            $board->addColumn($column);
            $manager->persist($column);

            foreach ($columnData['tasks'] as $taskData) {
                $task = new TaskColumn();
                $task->setName($taskData);

                $column->addTask($task);
                $manager->persist($task);
            }
        }


        $manager->flush();
    }

    private function getData()
    {
        return
            [
                "name"    => 'workshop',
                "columns" => [
                    [
                        "name"  => 'todo',
                        "tasks" => ['first task', 'second task', 'and third',]
                    ],
                    [
                        "name"  => 'in-progress',
                        "tasks" => ['first task',]
                    ],
                    [
                        "name"  => 'done',
                        "tasks" => ['first task']
                    ]
                ]
            ];
    }
}
