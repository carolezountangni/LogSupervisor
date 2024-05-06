<?php

// namespace carolezountangni\LogSupervisor\Repositories;

namespace App\Repositories;

use App\Traits\Repository;
use carolezountangni\LaravelLogSupervisor\Models\Activity;

class ActivityRepository
{
    use Repository;

    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;


    /**
     * Constructor
     */
    public function __construct()
    {
        // setup the model
        $this->model = app(Activity::class);
    }

    /**
     * Check if exists
     */
    public function ifExist($id)
    {
        return $this->find($id);
    }

    /**
     * Get an element
     */
    public function get($id)
    {
        return $this->findOrFail($id);
    }

    /**
     * To store model
     */
    public function makeStore($data): Activity
    {
        $activity = new Activity($data);
        $activity->save();
        return $activity;
    }

    /**
     * To update model
     */
    public function makeUpdate($id, $data): Activity
    {
        $activity = Activity::findOrFail($id);
        $activity->update($data);
        return $activity;
    }

    /**
     * To delete model
     */
    public function makeDestroy($id)
    {
        return $this->findOrFail($id)->delete();
    }

    /**
     * To get all latest
     */
    public function getlatest()
    {
        return $this->latest()->get();
    }
}
