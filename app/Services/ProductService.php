<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;

final readonly class ProductService implements ProductServiceInterface

{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}
