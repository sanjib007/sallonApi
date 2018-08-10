<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;


trait ApiResponse
{
  //  use ProvidesConvenienceMethods;
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {

        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        $transformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginate($collection);
      //  $collection = $this->transformData($collection['data'], $transformer);
        $collection = $this->cacheResponse($collection);
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {

        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);
        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function sortData(Collection $collection, $transformer)
    {
        if (app('request')->has('sort_by')) {
            $attribute = $transformer::originalAttribute(app('request')->sort_by);
            $collection = $collection->sortBy($attribute);
        }
        return $collection;
    }

    protected function transformData($data, $tranformer)
    {
        return new $tranformer($data);
    }

    protected function filterData(Collection $collection, $tranformer)
    {
        foreach (app('request')->query() as $query => $values) {
            $attribute = $tranformer::originalAttribute($query);
            if (isset($attribute, $values)) {
                $collection = $collection->where($attribute, $values);
            }
        }
        return $collection;
    }

    protected function paginate(Collection $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];
        app('validator')->validate(app('request')->all(), $rules);

        //Validator::validate(app('request')->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        if (app('request')->has('per_page')) {
            $perPage = (int)app('request')->per_page;
        }
        $result = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($result, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        $paginated->appends(app('request')->all());
        return $paginated;
    }

    public function cacheResponse($data)
    {

        $url = app('request')->url();
        $queryParam = app('request')->query();
        ksort($queryParam);

        $queryString = http_build_query($queryParam);

        $fullUrl = "{$url}?{$queryString}";
        return Cache::remember($fullUrl, 30 / 60, function () use ($data) {
            return $data;
        });

    }

}