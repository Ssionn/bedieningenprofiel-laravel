<?php

use App\Services\ImagePreperationService;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->temporaryFile = UploadedFile::fake()->image('avatar.jpg');
});

test('temporarilyStoreFileUsingPath creates a record of the temporary stored file', function () {
    $fileName = ImagePreperationService::temporarilyStoreFileUsingPath('avatars/', $this->temporaryFile);

    expect($fileName)->toBe($this->temporaryFile->getClientOriginalName());
});

test('removeRecordAndFile removes the record of the temporary stored file and the file itself', function () {
    $fileName = ImagePreperationService::temporarilyStoreFileUsingPath('avatars/', $this->temporaryFile);

    ImagePreperationService::removeRecordAndFile($fileName);

    expect($fileName)->toBe($this->temporaryFile->getClientOriginalName());
});
