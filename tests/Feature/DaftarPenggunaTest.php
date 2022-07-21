<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DaftarPenggunaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_buat_akun_baru(){
        // $this->expectException(ValidationException::class);
        // $this->expectNotToPerformAssertions();
        $this->withExceptionHandling();
        $response = $this->post('/simpanUser', [
            'name' => 'Psasasaasa',
            'email' => 'sasasasas@gmail.com',
            'password' => Hash::make('pur1asas'),
            'peran' => 'USER',
        ]);
        // $response->assertSessionHasErrors();
        // $mhs = User::all();
        // dd($mhs);
        // $response->assertOk(200);
        $response->assertStatus(200);
        // $this->assertCount(1, User::all());
    }
}

