<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobService
{
   /**
    * Handle user profile update.
    *
    * @param array $data
    * @return User
    * @throws ValidationException
    */
   public function getJobs()
   {
      return User::find(Auth::user()->id)->jobs;
   }
   public function createJob(array $data)
   {

      $this->validation($data);
      $user = User::find(Auth::user()->id);
      $user->jobs()->create($data);
   }

   public function editJob($id)
   {
      return User::find(Auth::user()->id)->jobs()->where('id', $id)->first();
   }
   public function updateJob(array $data)
   {
      $this->validation($data);
      $job = User::find(Auth::user()->id)->jobs()->find($data['id']);
      if (!$job) {
         throw ValidationException::withMessages(['error' => 'Job not found']);
      }
      $data['created_at'] = Carbon::parse($data['created_at']);
      $data['updated_at'] = Carbon::now();
      $job->update($data);
   }

   public function delete($id)
   {
      $job = User::find(Auth::id())->jobs()->find($id);
      if (!$job) {
         throw ValidationException::withMessages(['error' => 'Job not found']);
      }
      $job->delete();
   }

   protected function validation(array $data)
   {

      Validator::make($data, [
         'title' => 'required',
         'location' => 'required',
         'category' => 'required',
         'description' => 'required',
         'experience' => 'required',
         'salary_range' => 'required',
         'career_level' => 'required',
         'employment_type' => 'required',
      ])->validate();
   }
}
