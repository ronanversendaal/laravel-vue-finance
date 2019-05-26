<?php
namespace App\Http\Service\Wallet\Category;

use App\Http\Service\Wallet\Client as BaseClient;

class Client extends BaseClient
{
    public function getCategories()
    {
        return $this->request('categories');
    }

    public function getCategory($id)
    {
        return $this->request('category/'.$id);
    }

    public function createCategory(array $validated)
    {
        return $this->request('category', 'POST', json_encode($validated), ['Content-Type' => 'application/json']);
    }

    public function updateCategory($id, array $validated)
    {
        return $this->request('category/'.$id, 'PUT', json_encode($validated), ['Content-Type' => 'application/json']);
    }

    public function deleteCategory($id)
    {
        return $this->request('category/'.$id,  'DELETE');
    }
}
