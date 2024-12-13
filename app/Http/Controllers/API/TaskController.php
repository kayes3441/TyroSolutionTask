<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TaskAddUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use App\Traits\ResponseHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseHandler;
    public function __construct(
        private readonly TaskService $taskService,
        private readonly Task    $task,
    )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {

        $this->authorize('view', Task::class);
        $tasks = $this->task->with('assignTo')->get();
        return $this->sendResponse(result: TaskResource::collection($tasks),message: 'task retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskAddUpdateRequest $request): JsonResponse
    {
        $this->authorize('store', Task::class);
        $task = $this->task->create($request->all());
        return $this->sendResponse(new TaskResource($task),'Product Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id):JsonResponse
    {
        $this->authorize('view', Task::class);
        $task = $this->task->find($id);
        if (is_null($task)){
            return $this->sendError(error:'Task Not found');
        }
        return $this->sendResponse(new TaskResource($task),'Task Is available');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskAddUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(TaskAddUpdateRequest $request,int $id):JsonResponse
    {
        $this->authorize('update', Task::class);
        $task = $this->task->find($id);
        $task->update($request->all());
        return $this->sendResponse(new TaskResource($task),'Product Is Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id):JsonResponse
    {
        $this->authorize('delete', Task::class);
        $task = $this->task->find($id);
        $this->task->delete();
        return $this->sendResponse(new TaskResource($task),'Product Is Deleted');
    }
}
