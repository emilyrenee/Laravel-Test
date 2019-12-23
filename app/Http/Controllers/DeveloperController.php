<?php

namespace App\Http\Controllers;

use Image;
use App\Rules\FullName;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmailJob;
use App\Http\Controllers\Controller;
use App\Repositories\DeveloperRepository;

class DeveloperController extends Controller
{
    private $developerRepo;

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developerRepo = $developerRepository;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'avatar' => 'mimes:jpeg,png',
            'personal_site' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'timezone' => 'required_if:is_local,false',
            'team_ids' => 'nullable|array'
        ]);

        $fileNameToStore = $this->handleUpload($request);
        $validatedData = array_merge($validatedData, ['avatar' => $fileNameToStore]);

        $developer = $this->developerRepo->create($validatedData);
         
        if ($request->get('team_ids')) {
            foreach ($request->get('team_ids') as $team_id) {
                $this->developerRepo->assignTeam(['id' => $developer->id, 'team_id' => $team_id]);
            }
        }

        dispatch(new ProcessEmailJob($developer->id))->onQueue('high');

        return redirect('/developers');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => ['required', 'string', 'max:255', new FullName],
            'avatar' => 'mimes:jpeg,png',
            'email' => 'required|email|max:255',
            'personal_site' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'team_ids' => 'nullable|array'
        ]);

        $developer = $this->developerRepo->update($validatedData);

        if ($request->get('team_ids')) {
            foreach ($request->get('team_ids') as $team_id) {
                $this->developerRepo->assignTeam(['id' => $developer->id, 'team_id' => $team_id]);
            }
        }

        return redirect('/developers');
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $this->developerRepo->delete($validatedData);

        return redirect('/developers');
    }

    public function assignTeam(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'team_ids' => 'required|array'
        ]);

        $id = $request->get('id');
        $team_ids = $request->get('team_ids');

        foreach ($team_ids as $team_id) {
            $this->authorize('assignTeam');
            $this->developerRepo->assignTeam([
                'id' => $id,
                'team_id' => $team_id
            ]);
        }

        return redirect('/developers');
    }

    private function getFileName($avatarFile)
    {
        $filenameWithExt = $avatarFile->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        return $filename;
    }

    public function handleUpload(Request $request)
    {
        $fileNameToStore = 'noimage.jpg'; // default

        if ($request->hasFile('avatar')) {
            // get the file, name, extension, and create file name to store
            $avatarFile = $request->file('avatar');
            $filename = $this->getFileName($avatarFile);
            $extension = $avatarFile->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // names for all the sizes
            $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;
            $mediumthumbnail = $filename . '_medium_' . time() . '.' . $extension;
            $largethumbnail = $filename . '_large_' . time() . '.' . $extension;

            // upload image and three thumbnails
            $avatarFile->storeAs('public/avatars', $fileNameToStore);
            $avatarFile->storeAs('public/avatars/thumbnail', $smallthumbnail);
            $avatarFile->storeAs('public/avatars/thumbnail', $mediumthumbnail);
            $avatarFile->storeAs('public/avatars/thumbnail', $largethumbnail);

            // create small thumbnail
            $smallthumbnailpath = public_path('storage/avatars/thumbnail/' . $smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 93);

            // create medium thumbnail
            $mediumthumbnailpath = public_path('storage/avatars/thumbnail/' . $mediumthumbnail);
            $this->createThumbnail($mediumthumbnailpath, 300, 185);

            // create large thumbnail
            $largethumbnailpath = public_path('storage/avatars/thumbnail/' . $largethumbnail);
            $this->createThumbnail($largethumbnailpath, 550, 340);
        }

        return $fileNameToStore;
    }


    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param int $width
     * @param int $height
     */
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($path);
    }
}
