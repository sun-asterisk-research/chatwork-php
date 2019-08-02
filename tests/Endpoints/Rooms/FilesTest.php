<?php

use SunAsterisk\Chatwork\Endpoints\Rooms\Files;

class FilesTest extends TestCase
{
    public function testGetFilesList()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/files', [
            'account_id' => 101,
        ])->andReturn(['response']);

        $files = new Files($api, 123);

        $this->assertEquals(['response'], $files->list([
            'account_id' => 101,
        ]));
    }

    public function testGetFileDetail()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/files/321', [
            'create_download_url' => true,
        ])->andReturn(['response']);

        $files = new Files($api, 123);

        $this->assertEquals(['response'], $files->detail(321, [
            'create_download_url' => true,
        ]));
    }
}
