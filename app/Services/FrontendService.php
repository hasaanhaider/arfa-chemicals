<?php

namespace App\Services;

use App\Models\Job;
use App\Models\User;
use App\Models\WishList;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FrontendService
{


    public function getJobList()
    {
        $job_list = Job::with(['user', 'user.profile'])->get();
        return $job_list;
    }

    public function getCompanyList()
    {
        $company_list = User::with('profile')->withCount('jobs')->where('role_id', 3)->get();
        return $company_list;
    }

    public function getSingleJob($id)
    {
        $single_job = Job::with(['user', 'user.profile'])->where('id', $id)->first();
        return $single_job;
    }

    public function searchJob($data)
    {
        $query = Job::with(['user', 'user.profile'])
            ->where('title', 'like', '%' . $data['title'] . '%')
            ->where('category', 'like', '%' . $data['category'] . '%')
            ->where('location', 'like', '%' . $data['location'] . '%');

        if ($data['category']) {
            $query->where('category', $data['category']);
        }

        return $query->get();
    }

    public function wishList($data)
    {
        $validate = Validator::make($data, [
            'job_id' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->getMessageBag()]);
        }
        $user = User::find(Auth::user()->id); $user->wishList()->create(['job_id' => $data['job_id']]);
    }
}
