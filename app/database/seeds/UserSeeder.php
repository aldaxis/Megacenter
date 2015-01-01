<?php

class UserSeeder extends Seeder {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('verify::prefix', '');
	}

	public function run()
	{
		// Bring to local scope
		$prefix = $this->prefix;
        
        //Clear tables
        DB::table($prefix.'permissions')->delete();
        DB::table($prefix.'roles')->delete();
        DB::table($prefix.'users')->delete();
        
        // Create a new Role
        $role = new Toddish\Verify\Models\Role;
        $role->name = Config::get('verify::super_admin');
        $role->level = 10;
        $role->save();
        
        // Create a new User
        $user = new Toddish\Verify\Models\User;
        $user->username = 'admin';
        $user->name = 'Administrador';
        $user->email = 'adm@megacenterprodutos.com.br';
        $user->password = 'adm123';
        $user->verified = 1;
        $user->save();
        
        // Assign the Role to the User
        $user->roles()->sync(array($role->id));

	}
}