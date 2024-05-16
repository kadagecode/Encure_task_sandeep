<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('student.index');
});

//Index for the create student data
Route::get('index' , [StudentController::class , 'index'])->name('student.index');


//view for the create student data
Route::get('create' , [StudentController::class , 'create'])->name('student.create');

//store for the create student data
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

//student edit view registration

Route::get('student/edit/{id}' , [StudentController::class , 'edit'])->name('students.edit');


//student data updated

Route::put('student/update/{id}', [StudentController::class, 'update'])->name('students.update');

//student book data
Route::delete('student/destroy/{id}' , [StudentController::class , 'destroy'])->name('students.destroy');

//multiple delete data
Route::delete('/students/deleteMultiple', [StudentController::class, 'deleteMultiple'])->name('students.deleteMultiple');
