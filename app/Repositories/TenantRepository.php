<?php

namespace App\Repositories;

use App\Models\Tenant;
use Illuminate\Support\Collection;
use Redis;

class TenantRepository
{
    public function all()
    {
        $keys = Redis::keys('jincor_auth_tenant*');

        $list = new Collection();

        foreach ($keys as $key) {
            $tenant = json_decode(Redis::get($key));
            $ttl = Redis::ttl($key);
            $list->push([
                'id' => $key,
                'login' => $tenant->login,
                'email' => $tenant->email,
                'ttl' => $ttl,
            ]);
        }

        return $list;
    }

    public function findWithoutFail($id)
    {
        $data = Redis::get($id);

        $tenant = json_decode($data);

        return $tenant;
    }

    public function delete($id)
    {
        Redis::del($id);
    }
}
