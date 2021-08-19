<?php

namespace App\Models;

use App\Common\Config\MyConfig;
use App\Common\Helper\MyHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends Authenticatable
{
    protected $controller;
    protected $fillable = [];
    function __construct(array $attributes = array(), $controller)
    {
        parent::__construct($attributes);
        $this->controller = $controller;
    }

    public function listKeyValue($key, $value)
    {
        $items = $this->get();
        return array_column(MyHelper::convertStdClassToArray($items), $value, $key);
    }

    public function listAll($pageParams = [])
    {
        $query = $this->applySearch($this, $pageParams['search']);
        $query = $this->applyFilter($query, $pageParams['filters']);
        $query = $this->applySort($query, $pageParams['sort']);
        $items = $query->paginate($pageParams['pagination']['itemsPerPage']);
        return $items;
    }

    public function countFilters($pageParams)
    {
        $query = $this->applySearch($this, $pageParams['search']);
        $query = $this->applyFilter($query, $pageParams['filters']);
        $filterNames = MyConfig::getItemDataForController($this->controller, 'filter');
        $result = [];
        foreach ($filterNames as $field) {
            $data = $pageParams['filterData'][$field];
            $result[$field] = [];
            $keys = array_keys($data);
            foreach ($keys as $key) {
                if ($key !== 'all') {
                    $cloneQuery = clone $query;
                    $result[$field][$key] = $cloneQuery->where($field, $key)->count();
                }
            }
        }
        return $result;
    }

    protected function applySearch($query, $searchParams)
    {
        $field = $searchParams['field'];
        $value = trim($searchParams['value']);
        if ($value !== '') {
            if ($this->isFieldBelongTo($field, 'search')) {
                if ($field !== 'all') {
                    $query = $query->where($field, 'like', '%' . $value . '%');
                } else {
                    $itemData = MyConfig::getItemDataForController($this->controller, 'search');
                    array_shift($itemData);
                    $query = $query->where(function ($query) use ($itemData, $value) {
                        foreach ($itemData as $field)
                            $query->orWhere($field, "like", "%" . $value . "%");
                    });
                }
            }
        }
        return $query;
    }

    private function applyFilter($query, $filterParams)
    {
        foreach ($filterParams as $field => $value) {
            if ($this->isFieldBelongTo($field, 'filter')) {
                if (in_array($field, ['created_at_start', 'created_at_end'])) {
                    if (strpos($field, 'start') !== false) {
                        //start
                        $query = $query->where('created_at', '>=', $value);
                    } else {
                        //end
                        $query = $query->where('created_at', '<=', $value);
                    }
                } else if ($value !== 'all') {
                    $query = $query->where($field, $value);
                }
            }
        }
        return $query;
    }

    protected function applySort($query, $sortParams)
    {
        $field = $sortParams['field'];
        $value = trim($sortParams['value']);
        if ($this->isFieldBelongTo($field, 'sort') && in_array($value, ['asc', 'desc'])) {
            $query = $query->orderBy($field, $value);
        }
        return $query;
    }

    protected function isFieldBelongTo($field, $itemName)
    {
        $itemData = MyConfig::getItemDataForController($this->controller, $itemName);
        return in_array($field, $itemData);
    }

    public function updateFieldById($id, $field, $value)
    {
        return $this->where('id', $id)->update([$field => $value]);
    }

    public function insert($item)
    {
        return $this->create($item);
    }
}
