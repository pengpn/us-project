<?php
/**
 * 上传特性
 * @author pnpeng
 * @date 2018-03-26
 **/
namespace App\Traits;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadTrait
{
    private $path = 'uploads';

    /**
     * 上传文件，同时支持多种类文件（非批量）
     * 表单名与上传文件夹名、数据库字段名同步
     */
    public function uploadFile()
    {
        $file_path = [];
        $files = request()->files;
        if ($files->count() == 0) return;
        foreach ($files as $field => $file) {
            if (!$file) continue;
            if (!$file instanceof UploadedFile) {
                throw new InvalidArgumentException('上传的文件'.$field.'必须为UploadedFile实例');
            }
            //上传文件
            //上传路径
            $upload_path = $this->path . '/' . $field . '/' . date('Ym');
            //文件拓展名
            $extension = $file->getClientOriginalExtension();
            //组合文件名
            $file_name = uniqid() . rand(10000,99999) . '.' . $extension;
            //移动文件
            $file->move($upload_path, $file_name);
            $file_path[$field] = $upload_path . '/' . $file_name;
            // 删除原临时文件
            $this->deleteFile($field);
        }
        //更新文件路径
        $this->updateFilePath($file_path);
    }

    /**
     * 更新文件路径
     * @param $file_path
     */
    public function updateFilePath(array $file_path)
    {
        $this->fill($file_path)->save();
    }

    /**
     * 删除文件
     * @param $field
     */
    private function deleteFile($field)
    {
        if (!$this->$field) return;
        $unlink_path = $this->$field;
        if (file_exists($unlink_path)) {
            @unlink($unlink_path);
        }
    }
}