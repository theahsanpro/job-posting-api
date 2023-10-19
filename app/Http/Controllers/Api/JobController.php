<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function GetJobs()
    {
        $jobs = Job::all();

        if($jobs->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'jobs' => $jobs
            ], 200);
        } else {
            return response()->json($data = [
                'status' => 404,
                'message' => "No Records Found"
            ], 404);
        }
    }

    public function GetJob($id)
    {
        $job = Job::find($id);

        if($job) {
            return response()->json($data = [
                'status' => 200,
                'jobs' => $job
            ], 200);
        } else {
            return response()->json($data = [
                'status' => 404,
                'jobs' => "No Record Found"
            ], 404);
        }
    }

    public function PostJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'salary' => 'required|digits:5',
            'company' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $jobs = Job::create([
                'title' => $request->title,
                'description' => $request->description,
                'salary' => $request->salary,
                'company' => $request->company,
                'postedAt' => Carbon::now()
            ]);

            if($jobs){
                return response()->json([
                    'status' => 200,
                    'message' => "Job Posted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }
        }
    }

    public function UpdateJob(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'salary' => 'required|digits:5',
            'company' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $job = Job::find($id);

            if($job){
                $job->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'salary' => $request->salary,
                    'company' => $request->company,
                ]);
                
                return response()->json([
                    'status' => 200,
                    'message' => "Job Updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Job Found!"
                ], 404);
            }
        } 
    }

    public function DeleteJob($id)
    {
        $job = Job::Find($id);

        if($job) {
            $job->delete();
            return response()->json([
                'status' => 200,
                'message' => "Job Deleted Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Job Found!"
            ], 404);
        }
    }
}
