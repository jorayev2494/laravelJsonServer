<?php


namespace App\Http\Controllers\Traits;

/**
 * This is Response Trait
 */
trait MobileResponseTrait
{
    public $status = 0;
    public $data;
    public $message = "";

    /**
     * This method Response Json API
     *
     * @param object $data
     * @param integer $status
     * @param string $message
     * @return void
     */
    public function mobileResponseApi($data, int $status = 200, string $message = "")
    {

        try {
            $this->status     =  $status;
            $this->data       =  $data;
            $this->message    =  $message == "" && $status == 200 ? "success" : $message;
        } catch (\Throwable $th) {
            $this->status     =  500;
            $this->data       =  null;
            $this->message    =  $th->getMessage();
        }

        return response()->json(["status" => $this->status, "data" => $this->data, "message" => $this->message], $this->status);
    }

}

