<?php declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Product;
use App\Contracts\Repositories\ProductRepositoryInterface;
use CodeCoz\AimAdmin\Contracts\Service\CrudBoard\CrudGridLoaderInterface;
use CodeCoz\AimAdmin\Repository\AbstractAimAdminRepository;

class ProductRepository extends AbstractAimAdminRepository implements ProductRepositoryInterface, CrudGridLoaderInterface
{
    public function getModelFqcn(): string
    {
        return Product::class;
    }

    public function getGridQuery(): ?Builder
    {
        return Product::query()->orderBy('created_at', 'desc');
    }

    public function applyFilterQuery(Builder $query, array $filters): Builder
    {

        if (isset($filters['name'])) {
            $query->whereLike('products.name', $filters['name']);
            unset($filters['name']);
        }

        if (isset($filters['description'])) {
            $query->whereLike('products.description', $filters['description']);
            unset($filters['description']);
        }

        return parent::applyFilterQuery($query, $filters);
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        return Product::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }
}
