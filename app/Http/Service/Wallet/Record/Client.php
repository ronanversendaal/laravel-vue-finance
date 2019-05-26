<?php
namespace App\Http\Service\Wallet\Record;

use App\Http\Service\Wallet\Client as BaseClient;

class Client extends BaseClient
{
    public function getRecords()
    {
        return $this->request('records');
    }

    public function getRecord($id)
    {
        return $this->request('record/'.$id);
    }

    public function createRecords(array $validated)
    {
        return $this->request('records-bulk', 'POST', json_encode($validated['records']), ['Content-Type' => 'application/json']);
    }

    public function updateRecord($id, array $validated)
    {
        return $this->request('record/'.$id, 'PUT', json_encode($validated), ['Content-Type' => 'application/json']);
    }

    public function deleteRecord($id)
    {
        return $this->request('record/'.$id,  'DELETE');
    }
}
