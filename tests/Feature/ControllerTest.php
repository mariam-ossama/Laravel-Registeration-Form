<?php

namespace Tests\Feature;

use App\Http\Controllers\accountController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;

class ControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_submit() //to test submit function in the controller
    {
        $date=Carbon::create(2022, 12, 31)->format('Y-m-d');
        $data = ['name'=> 'admin' ,'username'=>'admin','email'=>'admin@gmail.com','date'=>$date, 'phone'=>'123456','address'=>'cairo','password'=>'admin555@'];
        $response = $this->post('/add', $data);
        $response->assertStatus(200);
    }
}
