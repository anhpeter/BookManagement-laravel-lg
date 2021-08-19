<?php

namespace App\Common\Helper;

use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public function handlePicture($base64, $uploadFolder, $oldPicName = null)
    {
        $uploadedFileName = null;
        if (MyHelper::isBase64($base64)) {
            $uploadedFileName = $this->uploadPicture($base64, $uploadFolder);
            $this->deletePictureIfExist($uploadFolder, $oldPicName);
        }
        return $uploadedFileName;
    }

    public function uploadPicture($base64, $uploadFolder)
    {
        if (MyHelper::isBase64($base64)) {
            $data = substr($base64, strpos($base64, ',') + 1);
            $data = base64_decode($data);
            $filename = $this->getRandomPictureFilename();
            Storage::disk('public')->put($this->getFilePath($uploadFolder, $filename), $data);
            return $filename;
        }
        return null;
    }

    public function getRandomPictureFilename()
    {
        $arr = range('0', '9');
        shuffle($arr);
        $filename = join('', $arr) . '.jpg';
        return $filename;
    }

    public function deletePictureIfExist($folder, $filename)
    {
        if ($filename) {
            $filepath = $this->getFilePath($folder, $filename);
            if (Storage::disk('public')->exists($filepath)) {
                Storage::disk('public')->delete($filepath);
            }
        }
    }

    public function getFilePath($folder, $filename)
    {
        return $folder . '/' . $filename;
    }
}