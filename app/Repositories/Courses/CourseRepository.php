<?php

namespace App\Repositories\Courses;

use App\Helper\FileHelper;
use App\Models\Course\Course;
use App\Models\Image\Image;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Storage;
use DB;

use function Psy\info;

class CourseRepository extends EloquentRepository
{
    public function getModel()
    {
        return Course::class;
    }

    private function getModelString()
    {
        return 'App\Models\Course\Course';
    }

    public function update(array $data, $id)
    {
        try {
            DB::beginTransaction();
            $userLogin = auth()->user();
            $course = $this->findById($id);

            if (isset($data['isRemoveImage']) && $data['isRemoveImage']) {
                $imageCourse = Image::find($data['isRemoveImage']);
                $folderThumbnail = FileHelper::getStorePathThumbnail($userLogin->id, 'course', $id);
                $this->deleteImageFromDisk('public/' . $folderThumbnail, $imageCourse->url);
                $imageCourse->delete();
            }

            if (isset($data['images']) && !empty($data['images'])) {
                $this->saveImageToDB($data, $userLogin->id, $id, $this->getModelString(), true);
            }
            $update = $course->update($data);
            DB::commit();

            return $update;
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            DB::rollback();
            return false;
        }
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $userLogin = auth()->user();
            $data['created_by'] = $userLogin->id;
            $create = $this->_model->create($data);

            if (isset($data['images']) && !empty($data['images'])) {
                $this->saveImageToDB($data, $userLogin->id, $create->id, $this->getModelString());
            }
            DB::commit();

            return $create;
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            DB::rollback();
            return false;
        }
    }


    /**
     * Save image to database
     *
     * @param  mixed $data          - request from frontend
     * @param  mixed $userId        - The id of user handle
     * @param  mixed $objectID      - The id of the course save image
     * @param  mixed $objectModel   - The Model path
     * @param  mixed $isUpdate      - flag check update then delete old file.
     * @return mixed
     */
    private function saveImageToDB($data, $userId, $objectID, $objectModel, $isUpdate = false)
    {
        $file = $data['images'];
        $imageId = $data['imageID'] ?? false;
        $folderThumbnail = FileHelper::getStorePathThumbnail($userId, 'course', $objectID);
        $fileName = $file->getClientOriginalName();

        if ($isUpdate) {
            $course = $this->findById($objectID);
            if ($course->image) {
                $oldFileName = last(explode('/', $course->image->url));
                $this->deleteImageFromDisk('public/' . $folderThumbnail, $oldFileName);
            }
        }

        $pathSaved = $this->saveImageToDisk($file, 'public/' . $folderThumbnail, $fileName);
        return Image::updateOrCreate(
            [
                'id' => $imageId,
            ],
            [
                'url' => $fileName,
                'is_show' => true,
                'imageable_id' => $objectID,
                'imageable_type' => $objectModel,
            ]
        );
    }

    /**
     * Save file to custom disk
     *
     * @param  mixed $file          - The file want save to disk
     * @param  mixed $pathStorage   - Place save file
     * @param  mixed $fileName      - Name of the file
     * @return mixed
     */
    private function saveImageToDisk($file, string $pathStorage, string $fileName)
    {
        return Storage::disk(config('filesystems.default'))->putFileAs($pathStorage, $file, $fileName);
    }

    /**
     * Delete file from disk
     *
     * @param  mixed $pathStorage   - Place save file
     * @param  mixed $fileName      - Name of the file
     * @return void
     */
    private function deleteImageFromDisk(string $pathStorage, string $fileName)
    {
        return Storage::disk(config('filesystems.default'))->delete("$pathStorage/$fileName");
    }
}
