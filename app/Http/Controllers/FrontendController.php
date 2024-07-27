<?php

namespace App\Http\Controllers;

use App\Services\FrontendService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    protected $frontend;

    public function __construct(FrontendService $frontend)
    {
        $this->frontend = $frontend;
    }
    public function index()
    {
        try {
            $job_list = $this->frontend->getJobList();
            return response()->json(['job_list' => $job_list], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function getCompanyList()
    {
        try {
            $company_list = $this->frontend->getCompanyList();
            return response()->json(['company_list' => $company_list], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function getSingleJob($id)
    {
        try {
            $single_job = $this->frontend->getSingleJob($id);
            return response()->json(['single_job' => $single_job], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function SearchJob(Request $request)
    {
        try {
            $search_job = $this->frontend->searchJob($request->all());
            return response()->json(['search_job' => $search_job], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 500]);
        }
    }

    public function wishList(Request $request)
    {
        try {
            $wish_list = $this->frontend->wishList($request->all());
            return response()->json(['message' => 'Job Added to wishlist'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
