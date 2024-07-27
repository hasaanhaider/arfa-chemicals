<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobs;
    public function __construct(JobService $jobs)
    {
        $this->jobs = $jobs;
    }


    public function index()
    {
        try {
            return response()->json($this->jobs->getJobs(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->jobs->createJob($request->all());
            return response()->json(['message' => 'Successfully created'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            return response()->json($this->jobs->editJob($id), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->jobs->updateJob($request->all());
            return response()->json(['message' => 'Successfully updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->jobs->delete($id);
            return response()->json(['message' => 'Successfully deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
