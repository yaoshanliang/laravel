<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public function scopeWhereLayui($query, $request, $fields = array())
    {
        if (isset($request->search)) {
            $query->where(function ($query) use ($request, $fields) {
                foreach ($fields as $k => $v) {
                    if ($k == 0) {
                        $query->where($v, 'LIKE',  '%' . $request->search . '%');
                    } else {
                        $query->orWhere($v, 'LIKE',  '%' . $request->search . '%');
                    }
                }
            });
        }

        return $query;
    }

    public function scopeOrderByLayui($query, $request)
    {
        if (isset($request->order)) {
            $query->orderBy($request->field, $request->order);
        }

        return $query;
    }
}
