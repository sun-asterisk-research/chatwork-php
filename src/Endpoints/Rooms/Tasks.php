<?php

namespace SunAsterisk\Chatwork\Endpoints\Rooms;

use DateTime;

class Tasks extends Endpoint
{
    /**
     * Get tasks in room. Maximum 100 tasks.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-tasks
     */
    public function list(array $options = []): array
    {
        return $this->api->get("rooms/{$this->roomId}/tasks", $options);
    }

    /**
     * Create new task.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#POST-rooms-room_id-tasks
     *
     * @param  string $body
     * @param  int[] $assignees
     * @param  DateTime $limit
     * @return array
     */
    public function create(string $body, array $assignees, DateTime $limit = null): array
    {
        return $this->api->post("rooms/{$this->roomId}/tasks", [
            'body' => $body,
            'to_ids' => implode(',', $assignees),
            'limit' => $limit ? $limit->getTimestamp() : null,
        ]);
    }

    /**
     * Get task detail.
     *
     * @see http://developer.chatwork.com/vi/endpoint_rooms.html#GET-rooms-room_id-tasks-task_id
     */
    public function detail(int $taskId, array $options = []): array
    {
        return $this->api->get("rooms/{$this->roomId}/tasks/{$taskId}", $options);
    }
}
