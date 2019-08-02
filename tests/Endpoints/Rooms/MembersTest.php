<?php

use SunAsterisk\Chatwork\Endpoints\Rooms\Members;

class MembersTest extends TestCase
{
    public function testGetRoomMembers()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('get')->with('rooms/123/members')->andReturn(['response']);

        $members = new Members($api, 123);

        $this->assertEquals(['response'], $members->list());
    }

    public function testUpdateRoomMembers()
    {
        $api = $this->getAPIMock();
        $api->shouldReceive('put')->with('rooms/123/members', [
            'members_admin_ids' => '1,2,3',
            'members_member_ids' => '4,5',
            'members_readonly_ids' => '',
        ])->andReturn(['response']);

        $members = new Members($api, 123);

        $this->assertEquals(['response'], $members->update([
            'members_admin_ids' => [1, 2, 3],
            'members_member_ids' => [4, 5],
        ]));
    }
}
