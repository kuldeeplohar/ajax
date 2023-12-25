<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('file');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();

         $validator = Validator::make($request->all(), [
              'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
         ]);

         if ($validator->fails()) {

              $data['success'] = 0;
              $data['error'] = $validator->errors()->first('file');// Error response

         }else{
              if($request->file('file')) {

                   $file = $request->file('file');
                   $filename = time().'_'.$file->getClientOriginalName();

                   // File extension
                   $extension = $file->getClientOriginalExtension();

                   // File upload location
                   $location = 'files/';

                   // Upload file
                   $file->move($location,$filename);

                   // File path
                   $filepath = url('files/'.$filename);

                   // Response
                   $data['success'] = 1;
                   $data['message'] = 'Uploaded Successfully!';
                   $data['filepath'] = $filepath;
                   $data['extension'] = $extension;
              }else{
                   // Response
                   $data['success'] = 2;
                   $data['message'] = 'File not uploaded.';
              }
         }

         return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileUpload $fileUpload)
    {
        //
    }
}
