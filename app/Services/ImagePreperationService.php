<?php

namespace App\Services;

use App\Models\TemporaryFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImagePreperationService
{
    /**
     * Creates a record of the temporary stored file.
     *
     * @param string $path
     * @param UploadedFile $temporaryFile
     * @return string
     * @throws \Exception
     */
    public static function temporarilyStoreFileUsingPath(
        string $path,
        UploadedFile $temporaryFile,
    ): string {
        try {
            $fileName = str_replace(' ', '_', $temporaryFile->getClientOriginalName());
            $folder = uniqid() . '_' . now()->timestamp;

            if ($temporaryFile->storeAs($path, $fileName, ['disk' => 'public'])) {
                TemporaryFile::create([
                    'folderName' => $folder,
                    'fileName' => $fileName,
                ]);

                return $fileName;
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return '';
    }

    /**
     * Removes the record of the temporary stored file and the file itself.
     *
     * @param string $fileName
     */
    public static function removeRecordAndFile(string $fileName): void
    {
        $user = Auth::user();

        $temporaryFile = TemporaryFile::where('fileName', $fileName)->first();

        if ($temporaryFile) {
            $temporaryFile->delete();
        }

        Storage::disk('public')->deleteDirectory('avatars/');
    }
}
