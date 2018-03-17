<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\FileEntry;
use App\User;
use Auth;

class FileEntryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $thesis = $user->thesis->first();
        $file = $request->file('thesis_file');
        if ($file)
        {
            $allowed = array("application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            if(in_array($file->getClientMimeType(), $allowed))
            {
        		$extension = $file->getClientOriginalExtension();
        		Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        		$entry = new FileEntry;
        		$entry->thesis_id = $thesis->id;
        		$entry->filename = $file->getFilename().'.'.$extension;
        		$entry->mime = $file->getClientMimeType();
        		$entry->original_filename = $file->getClientOriginalName();
        		$entry->save();
         
        		return redirect('home')->with('success', 'Fail üles laetud!');
            }
            else
            {
                return redirect('home')->with('error', 'Faili formaat ei vasta nõuetele!');
            }
        }
        else 
        {
            return redirect('home')->with('error', 'Faili ei ole valitud!');
        }
    }
    
    public function get($filename){
        
        if (Storage::disk('local')->exists($filename))
        {
    		$fileentry = Fileentry::where('filename', '=', $filename)->firstOrFail();
    		$file_name_original = $fileentry->original_filename;
    		$file = Storage::disk('local')->get($fileentry->filename);
     
    		return (new Response($file, 200))
    		    ->header('Content-Type', $fileentry->mime)
    		    ->header('Content-disposition','attachment; filename="'. $file_name_original .'"');
        }
        else
        {
            return redirect('home');
        }
    }
}


//HOW TO GET THE LATEST FILEENTRY
// $thesis->fileentry->where('mime', '=', 'application/pdf')->last();