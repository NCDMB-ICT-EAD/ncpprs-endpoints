<?php

namespace App\Repositories;


use App\Handlers\DataNotFound;
use App\Interfaces\IRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Handlers\RecordCreationUnsuccessful;
use App\Handlers\CodeGenerationErrorException;

abstract class BaseRepository implements IRepository
{
    protected $model;
    protected $relations = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function parse(array $data): array;

    public function all()
    {
        try {
            return $this->model->with($this->relations)->latest()->get();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching collection: ' . $e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $record = $this->model->with($this->relations)->find($id);
            if (!$record) {
                throw new DataNotFound();
            }
            return $record;
        } catch (\Exception $e) {
            throw new \Exception('Error fetching record: ' . $e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $record = $this->model->create($this->parse($data));

                if (!$record) {
                    throw new RecordCreationUnsuccessful("Main record creation failed.");
                }

                foreach ($this->relations as $relation) {
                    if (method_exists($record, $relation)) {
                        $record->{$relation}()->createMany($data[$relation]);
                    } else {
                        \Log::info("Relation '{$relation}' does not exist on the model.");
                        throw new \Exception("Relation '{$relation}' does not exist on the model.");
                    }
                }

                return $record;
            });
        } catch (\Exception $e) {
            throw new \Exception('Error creating record: ' . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $record = $this->model->findOrFail($id);

                if (!$record->update($this->parse($data))) {
                    throw new \Exception("Failed to update the main record.");
                }

                foreach ($this->relations as $relation) {
                    if (method_exists($record, $relation)) {
                        $relationModel = $record->{$relation}();
                        $relationModel->delete();
                        $relationModel->createMany($data[$relation]);
                    } else {
                        throw new \Exception("Relation '{$relation}' does not exist on the model.");
                    }
                }

                return $record;
            });
        } catch (\Exception $e) {
            throw new \Exception('Error updating record: ' . $e->getMessage());
        }
    }

    public function destroy($id): bool
    {
        try {
            return DB::transaction(function () use ($id) {
                $resource = $this->model->findOrFail($id);

                foreach ($this->relations as $relation) {
                    if (method_exists($resource, $relation)) {
                        $resource->{$relation}()->delete();
                    } else {
                        throw new \Exception("Relation '{$relation}' does not exist on the model.");
                    }
                }

                if (!$resource->delete()) {
                    throw new \Exception("Failed to delete the main record.");
                }

                return true;
            });
        } catch (\Exception $e) {
            throw new \Exception('Error deleting record: ' . $e->getMessage());
        }
    }

    public function generate($column, $prefix): string
    {
        try {
            // Generate a random code with prefix
            $code = $prefix . random_int(10000, 99999);

            // Check if the code already exists in the specified column
            $record = $this->model->where($column, $code)->first();

            // If the code exists, recursively call the generate method to generate a new code
            if ($record) {
                return $this->generate($column, $prefix);
            }

            // If the code does not exist, return it
            return $code;
        } catch (QueryException $e) {
            throw new CodeGenerationErrorException('Error trying to generate code from this model!', 0, $e);
        } catch (\Exception $e) {
            throw new \Exception('Error generating code for this record: ' . $e->getMessage());
        }
    }

    public function getRecordByColumn(string $column, mixed $value, string $operator = '=')
    {
        try {
            $record = $this->model->where($column, $operator, $value)->first();

            if (!$record) {
                throw new DataNotFound();
            }

            return $record;
        } catch (\Exception $e) {
            throw new \Exception('Error fetching record: ' . $e->getMessage());
        }
    }

    public function getCollectionByColumn(string $column, mixed $value, string $operator = '=')
    {
        try {
            return $this->model->where($column, $operator, $value)->latest()->get();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching collection: ' . $e->getMessage());
        }
    }
}
