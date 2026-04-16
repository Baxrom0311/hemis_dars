<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\HemisService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $service = new HemisService();
        $page = 1;
        $limit = 50;
        $query = 'limit=' . $limit;
        $selectedGroup = 0;
        $selectedAuditorium = 0;
        $selectedTeacher = 0;
        $selectedSubject = 0;
        $selectedLessonPair = 0;
        $selectedDepartment = 0;
        $lessonPairs = [
            ['id' => 11, 'name' => '8:30-9:50'],
            ['id' => 12, 'name' => '10:00-11:20'],
            ['id' => 13, 'name' => '11:30-12:50'],
            ['id' => 14, 'name' => '13:30-14:50'],
            ['id' => 15, 'name' => '15:00-16:20'],
            ['id' => 16, 'name' => '16:30-17:50']
        ];

        if ($request->has('start_date') && $request->has('end_date')) {
            $start = strtotime($request->start_date);
            $end = strtotime($request->end_date);
        } else {
            $start = strtotime('today');
            $end = strtotime('today');
        }
        $query .= '&lesson_date_from=' . $start . '&lesson_date_to=' . $end;

        if ($request->has('group_id') and $request->group_id != 0) {
            $query .= '&_group=' . $request->group_id;
            $selectedGroup = $request->group_id;
        }
        if ($request->has('auditorium_id') and $request->auditorium_id != 0) {
            $query .= '&_auditorium=' . $request->auditorium_id;
            $selectedAuditorium = $request->auditorium_id;
        }
        if ($request->has('teacher_id') and $request->teacher_id != 0) {
            $query .= '&_employee=' . $request->teacher_id;
            $selectedTeacher = $request->teacher_id;
        }
        if ($request->has('subject_id') and $request->subject_id != 0) {
            $query .= '&_subject=' . $request->subject_id;
            $selectedSubject = $request->subject_id;
        }
        if ($request->has('lesson_pair') and $request->lesson_pair != 0) {
            $query .= '&_lesson_pair=' . $request->lesson_pair;
            $selectedLessonPair = $request->lesson_pair;
        }
        try {
            $pageDate=$service->jadval($query."&page=".$page)->data;
            $items = $pageDate->items;
            $pagination = $pageDate->pagination;
        }catch (\Exception $e){
            return view('error');
        }

        if ($request->has('department_id') and $request->department_id != 0) {
            $departmentItems=[];
            $selectedDepartment = $request->department_id;
            $currentFilteredItems = collect($items)->filter(function ($item) use ($request) {
                try {
                    return $item->department->id == $request->department_id;
                }catch (\Exception $e){
                    return false;
                }
            });
            $departmentItems = array_merge($departmentItems, $currentFilteredItems->toArray());
            while ($pagination->pageCount > $page and count($departmentItems) < 50) {
                $page++;
                $pageDate=$service->jadval($query."&page=".$page)->data;
                $filteredItems = collect($pageDate->items)->filter(function ($item) use ($request) {
                    try {
                        return $item->department->id == $request->department_id;
                    }catch (\Exception $e){
                        return false;
                    }
                });
                $departmentItems = array_merge($departmentItems, $filteredItems->toArray());
            }
            $items = $departmentItems;
        }

        $groups = Group::all();
        $auditoriums = Room::all();
        $teachers = Teacher::all()->keyBy('id');
        $subjects = Subject::all();
        $departments = collect($teachers)->map(function ($item){
            return (object)['id'=>$item->department_id, 'name'=>$item->department_name];
        })->unique('id')->values();
        $startDate = date('Y-m-d', $start);
        $endDate = date('Y-m-d', $end);
        $lessonPairs =collect($lessonPairs)->map(function ($item){
            return (object)$item;
        });


        return view('welcome', compact(
            'items',
            'groups',
            'startDate',
            'endDate',
            'auditoriums',
            'selectedGroup',
            'selectedAuditorium',
            'selectedTeacher',
            'teachers',
            'selectedSubject',
            'subjects',
            'lessonPairs',
            'selectedLessonPair',
            'departments',
            'selectedDepartment'
        ));
    }
}
