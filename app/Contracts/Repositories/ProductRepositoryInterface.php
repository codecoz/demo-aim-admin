<?php declare(strict_types=1);

namespace App\Contracts\Repositories;

interface ProductRepositoryInterface
{
    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}
