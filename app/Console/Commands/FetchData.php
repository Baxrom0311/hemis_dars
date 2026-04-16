<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\HemisService;
use Illuminate\Console\Command;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from Hemis API and store it in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hemisService = new HemisService();
        $teachers = $hemisService->teachers()->data->items;
        $rooms = $hemisService->auditoriums()->data->items;
        $groups = $hemisService->groups()->data->items;
        $subjects = $hemisService->subjects();

        foreach ($teachers as $teacher) {
            $existingTeacher = Teacher::find($teacher->id);

            echo "department_id: " . $teacher->department->id . "\n";
            echo "department_name: " . $teacher->department->name . "\n";
            if (!$existingTeacher) {
                Teacher::create([
                    'id' => $teacher->id,
                    'name' => $teacher->full_name,
                    'department_id' => $teacher->department->id,
                    'department_name' => $teacher->department->name,
                ]);
            } else {
                $existingTeacher->update([
                    'name' => $teacher->full_name,
                    'department_id' => $teacher->department->id,
                    'department_name' => $teacher->department->name,
                ]);

            }
        }

        $this->info('Teachers data fetched and updated successfully.');
        foreach ($groups as $group) {
            $existingGroup = Group::find($group->id);

            if (!$existingGroup) {
                Group::create([
                    'id' => $group->id,
                    'name' => $group->name,
                ]);
            } else {
                $existingGroup->update([
                    'name' => $group->name,
                ]);
            }

        }
        $this->info('Groups data fetched and updated successfully.');
        foreach ($rooms as $room) {
            $existingRoom = Room::find($room->code);

            if (!$existingRoom) {
                Room::create([
                    'id' => $room->code,
                    'name' => $room->name,
                ]);
            } else {
                $existingRoom->update([
                    'name' => $room->name,
                ]);
            }
        }
        $this->info('Rooms data fetched and updated successfully.');

        foreach ($subjects as $subject) {
            $existingSubject = Subject::find($subject->id);

            if (!$existingSubject) {
                Subject::create([
                    'id' => $subject->id,
                    'name' => $subject->name,
                ]);
            } else {
                $existingSubject->update([
                    'name' => $subject->name,
                ]);
            }
        }
    }
}
