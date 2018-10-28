<?php

namespace Tests\Feature;

use App\Download;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloadTest extends TestCase
{
    use RefreshDatabase;

    // Router tests
    /**
     * Index page
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * List is empty
     *
     * @return void
     */
    public function testListEmpty()
    {
        $response = $this->get('/list');
        $response->assertStatus(200);
        $response->assertSeeText('Sorry, no downloads yet');
    }

    /**
     * List is not empty
     *
     * @return void
     */
    public function testListNotEmpty()
    {
        $download = factory(Download::class)->make();
        $download->save();
        $response = $this->get('/list');
        $response->assertStatus(200);
        $response->assertDontSeeText('Sorry, no downloads yet');
    }

    /**
     * Download errors
     *
     * @return void
     */
    public function testGet404()
    {
        $response = $this->get('/get');
        $response->assertStatus(404);
        $response = $this->get('/get/1000');
        $response->assertStatus(404);
    }

    /**
     * Download OK
     *
     * @return void
     */
    public function testGetOk()
    {
        Storage::put('test.txt', '1');
        $download = factory(Download::class)->make();
        $download->save();
        $response = $this->get(sprintf('/get/%d', $download->id));
        $response->assertStatus(200);
        Storage::delete('test.txt');
    }

    /**
     * POST adds new download
     *
     * @return void
     */
    public function testAdd()
    {
        $response = $this->get('/list');
        $response->assertStatus(200);
        $response->assertSeeText('Sorry, no downloads yet');
        $response = $this->post('/', [ 'download-me' => 'https://google.com' ]);
        $response->assertStatus(200);
        $response = $this->get('/list');
        $response->assertStatus(200);
        $response->assertDontSeeText('Sorry, no downloads yet');
    }
}
