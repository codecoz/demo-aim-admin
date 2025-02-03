<?php declare(strict_types=1);

namespace App\Contracts\Services;

interface ProductServiceInterface
{
    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}

