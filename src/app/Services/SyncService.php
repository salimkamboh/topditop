<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SyncService
{
    public function syncMany(Collection $users)
    {
        $users->each(function (User $user) {
            try {
                $this->syncDashboardFromOrigin($user);
            } catch (\Exception $e) {
                $msg = $e->getMessage();
                $this->output("User $user->id $user->email failed to sync his store $user->store->id, $msg");
            }
        });
    }

    public function syncDashboardFromOrigin($user)
    {
        if (!$user instanceof User && is_int($user)) {
            throw new \Exception('Must pass User or a user\'s id');
        }

        if (! $user instanceof User) {
            $user = User::findOrFail($user);
        }

        $profile = $user->store->profile;
        $origin = $user->origin;
        $store = $user->store;

        $mappings = [
            'storename' => $origin->company,
            'owner' => $origin->getFullName(),
            'contact_mail' => $origin->email,
            'address' => $origin->getFullAddress(),
            'postal_code' => $origin->postal_code,
            'telephone_number' => $origin->phone,
            'store_latitude' => $store->latitude,
            'store_longitude' => $store->longitude
        ];



        DB::transaction(function () use ($user, $profile, $origin, $store, $mappings) {

            $this->output("STARTED handling $user->email ($user->id) store $store->id");

            foreach ($mappings as $key => $value) {
                if (! $profile->hasValueForField($key)) {
                    $profile->setField($key, $value );
                    $this->output("Synced $key");
                }
            }

            $this->output("FINISHED store $store->id");
            $this->output("====================");
        });
    }

    private function output(string $message)
    {
        print_r($message . PHP_EOL);
    }
}