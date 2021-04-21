<?php

namespace App\Services\Validation;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class CountRequestsPerMinute
 * @package App\Services
 */
class CountRequestsPerMinute
{
    /**
     * @var string
     */
    private $fileName;
    /**
     * @var int
     */
    private $countRequest;
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private $storage;

    /**
     * CountRequestsPerMinute constructor.
     * @param int $countRequest
     * @param string $fileName
     */
    public function __construct(int $countRequest = 5, string $fileName = 'limit.json')
    {
        $this->countRequest = $countRequest;
        $this->fileName = $fileName;
        $this->storage = Storage::disk('local');
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $data = $this->getFileData();
        $count = intval($data['count']);
        $currentDateTime = new \DateTime();
        $currentDateTime->setTime(
            $currentDateTime->format("H"),
            $currentDateTime->format("i"),
            00);
        $dateTime = new \DateTime($data['time']);

        if ($count >= $this->countRequest) {
            if ($currentDateTime == $dateTime) {
                Log::error(
                    'Request limit exceeded. Maximum number of requests per minute: ' . $this->countRequest
                );
                return false;
            }
            $count = 0;
        }
        $count++;
        $this->filePutData($currentDateTime, $count);

        return true;
    }

    /**
     * @return array|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getFileData(): array
    {
        if ($this->storage->exists($this->fileName)) {
            return json_decode($this->storage->get($this->fileName), true);
        } else {
            $data = ['count' => 0, 'time' => null];
            $this->storage->put($this->fileName, json_encode($data));
            return $data;
        }
    }

    /**
     * @param \DateTime $dateTime
     * @param int $count
     */
    private function filePutData(\DateTime $dateTime, int $count): void
    {
        if ($this->storage->exists($this->fileName)) {
            $data = ['count' => $count, 'time' => $dateTime->format('d-m-Y H:i')];
            $this->storage->put($this->fileName, json_encode($data));
        }
    }
}
