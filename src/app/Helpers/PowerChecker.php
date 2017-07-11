<?php

namespace App\Helpers;

use App\Limitation;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PowerChecker
{
    public function isLimited(Request $request, $entity)
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Package $userPackage */
        $userPackage = $user->store->profile->package;
//echo $user->numberOf($entity);
//        echo $userPackage->getLimitation($entity);exit;
        if ($userPackage->getLimitation($entity) <= $user->numberOf($entity)) {
            $request->session()->flash('fail', 'You have used all available ' . $entity . ' space.');
            return new Limitation();
        } else {
            return false;
        }
    }

    public function isLimitedUser(User $user)
    {
        /** @var Package $userPackage */
        $userPackage = $user->store->profile->package;
        return $userPackage->name == Package::LOWEST || $userPackage->name == Package::LIGHT;
    }

}