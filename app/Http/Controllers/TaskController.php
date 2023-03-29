<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index() {
        return TaskResource::collection(Task::all());
    }

    public function assigneeUser(Task $task, User $user) {
        $task->assignedUsers()->attach($user->id);
        return 'success'; // TODO write success resource
    }
}
