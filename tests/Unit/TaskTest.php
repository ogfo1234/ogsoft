<?php

namespace Tests\Unit;

use App\Classes\Date;
use App\Classes\Task;
use App\Classes\WorkingTime;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_correct_calculations_for_task_due_date()
    {
        // Basic time calculation
        $task1 = new Task(
            'Task 1',
            new Date('2024-07-29 10:30:00'),
            12 * 60,
            new WorkingTime('08:00', '16:00'),
            true
        );

        $this->assertEquals('2024-07-30 14:30:00', $task1->getEndDate()->format('Y-m-d H:i:s'));

        $task2 = new Task(
            'Task 2',
            new Date('2024-08-27 08:00:00'),
            32 * 60,
            new WorkingTime('08:00', '16:00'),
            true
        );

        $this->assertEquals('2024-09-02 16:00:00', $task2->getEndDate()->format('Y-m-d H:i:s'));

        $task3 = new Task(
            'Task 3',
            new Date('2024-08-27 08:00:00'),
            24 * 60,
            new WorkingTime('08:00', '16:00'),
            false
        );

        $this->assertEquals('2024-08-29 16:00:00', $task3->getEndDate()->format('Y-m-d H:i:s'));
    }
}
