<?php
/**
 * Created by PhpStorm.
 * 后台公用模型
 * User: test
 * Date: 2018/3/26
 * Time: 11:48
 */
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    /**
     * 重载fill方法
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        $totallyGuarded = $this->totallyGuarded();

        foreach ($this->fillableFromArray($attributes) as $key => $value) {
            if ($value instanceof UploadedFile) continue ;//忽略文件上传对象
            $key = $this->removeTableFromKey($key);

            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            } elseif ($totallyGuarded) {
                throw new MassAssignmentException($key);
            }
        }

        return $this;
    }
}
