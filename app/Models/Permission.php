<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermissions;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Http\Resources\Admin\Permission\PermissionCollection;

class Permission extends SpatiePermissions
{
	use HasFactory;

	public static function defaultPermissions()
	{
	    return [
	        'take_balance',
	        'show_balance',
	        'edit_balance',
	        'create_balance',
	        'delete_balance',
	    ];
	}
}
