<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // Store student and address data
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone_number' => 'required|string|max:15|unique:students,phone_number',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
        ]);

        // Create the address associated with the student
        $address =Address::create([
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'student_id' => $student->id,
        ]);

        return response()->json([
            'message' => 'Student and address created successfully',
            'student' => $student,
            'address' => $address
        ], 201);
    }

    // Method to fetch all student data
    public function index()
    {
        $students = Student::with('address')->get();

        return response()->json($students);
    }
}
