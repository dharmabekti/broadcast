<?php

namespace App\Controllers;

use App\Models\MessageModel;

class Message extends BaseController
{
    private $msgM;
    public function __construct()
    {
        $this->msgM = new MessageModel();
    }

    public function index()
    {
        $data = [
            'title' => "Message",
            'msg' => $this->msgM->getData(),
        ];
        return view('messages/index', $data);
    }

    public function detail($id)
    {
        return json_encode($this->msgM->getData($id));
    }

    public function save()
    {
        $id = $this->request->getVar('id');
        if ($this->msgM->save([
            'id' => $id,
            'message' => $this->request->getVar('message'),
        ])) {
            return json_encode([
                'status' => true,
                'type' => 'success',
                'message' => $id == null ? "Successfully inserted data" : "Successfully updated data",
            ]);
        }
        return json_encode([
            'status' => false,
            'type' => 'error',
            'message' => $id == null ? "Failed to enter data!" : "Failed to updated data!",
        ]);
    }

    public function update($id)
    {
        $this->msgM->inactivatedAll();
        $status = $this->request->getVar('status');
        $new_status = $status == 0 ? 1 : 0;
        $status_msg = $status == 0 ? "activated" : "inactivated";
        if ($this->msgM->save([
            'id' => $id,
            'status' => $new_status
        ])) {
            return json_encode([
                'status' => true,
                'type' => 'success',
                'message' => "Successfully $status_msg message",
            ]);
        }
        return json_encode([
            'status' => false,
            'type' => 'error',
            'message' => "Failed to $status_msg message!",
        ]);
    }

    public function delete($id)
    {
        if ($this->msgM->delete($id)) {
            return json_encode([
                'status' => true,
                'type' => 'success',
                'message' => "Successfully deleted data",
            ]);
        }
        return json_encode([
            'status' => false,
            'type' => 'error',
            'message' => "Failed to delete data!",
        ]);
    }
}
