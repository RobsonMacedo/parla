<?php
namespace App\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Base
{
    /**
     * @var
     */
    protected $model;

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function createFromRequest(Request $request)
    {
        is_null($id = $request->input('id'))
            ? ($model = new $this->model())
            : ($model = $this->model::find($id));
        $model->fill($request->all());

        $model->save();

        $this->saveTags($request, $model);

        return $model;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $model = is_null($id = isset($data['id']) ? $data['id'] : null)
            ? new $this->model()
            : $this->model::find($id);

        $model->fill($data);

        $model->save();

        $model->saveTags(collect($data), $model);

        return $model;
    }

    /**
     * @param array $search
     * @param array $attributes
     *
     * @return mixed
     */
    public function firstOrCreate(array $search, array $attributes = [])
    {
        return $this->model::firstOrCreate($search, $attributes);
    }

    /**
     * @param $abreviacao
     *
     * @return mixed
     */
    public function findByAbreviacao($abreviacao)
    {
        return $this->model::where('abreviacao', $abreviacao)->first();
    }

    /**
     * @param $user_id
     *
     * @return mixed
     */
    public function findById($user_id)
    {
        return $this->model::where('id', $user_id)->first();
    }

    public function maxId()
    {
        return $this->model::max('id');
    }

    /**
     * @return mixed
     */
    public function new()
    {
        return new $this->model();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->makeResultForSelect($this->model::all());
    }

    public function allOrderBy($field)
    {
        return $this->model::orderBy($field)->get();
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public function cleanString($string)
    {
        return str_replace(["\n"], [''], $string);
    }

    /**
     * @param Request $request
     * @param $model
     */
    protected function saveTags(Request $request, $model)
    {
        if ($request->has('tags')) {
            $model->syncTags($request->get('tags'));
        }
    }

    /**
     * @param $result
     * @param string $label
     * @param string $value
     *
     * @return mixed
     */
    protected function makeResultForSelect(
        $result,
        $label = 'nome',
        $value = 'id'
    ) {
        return $result->map(function ($row) use ($value, $label) {
            $row['text'] = empty($row->text) ? $row[$label] : $row->text;

            $row['value'] = $row[$value];

            return $row;
        });
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->new();
    }

    protected function qualifyColumn($name)
    {
        return $this->model()->qualifyColumn($name);
    }

    protected function makeQueryByAnyColumnName(
        $type,
        $name,
        $arguments,
        $query = null
    ) {
        if (!$query) {
            $query = $this->model::query();
        }

        $columnName = snake_case(Str::after($name, $type));

        return $query->where($this->qualifyColumn($columnName), $arguments);
    }

    protected function findByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName(
            'findBy',
            $name,
            $arguments
        )->first();
    }

    protected function filterByAnyColumnName($columns, $arguments)
    {
        $query = $this->newQuery();

        coollect((array) $columns)->each(function ($column) use (
            $query,
            $arguments
        ) {
            $this->makeQueryByAnyColumnName(
                'filterBy',
                $column,
                $arguments,
                $query
            );
        });

        return $this->applyFilter($query);
    }

    protected function getByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName(
            'getBy',
            $name,
            $arguments
        )->get();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (starts_with($name, 'findBy')) {
            return $result = $this->findByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'filterBy')) {
            return $result = $this->filterByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'getBy')) {
            return $result = $this->getByAnyColumnName($name, $arguments);
        }

        throw new \Exception('Method not found: ' . $name);
    }
}
