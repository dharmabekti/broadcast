<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\RecipientModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Home extends BaseController
{
    private $recipientM, $msgM;
    public function __construct()
    {
        $this->recipientM = new RecipientModel();
        $this->msgM = new MessageModel();
    }

    public function index()
    {
        $data = [
            'title' => "Recipients",
            'recipients' => $this->recipientM->getData(),
        ];
        return view('recipients/index', $data);
    }

    public function saveRecipient()
    {
        $id = $this->request->getVar('id');
        if ($this->recipientM->save([
            'id' => $id,
            'name' => $this->request->getVar('fullname'),
            'number' => $this->request->getVar('phone'),
            'country_code' => $this->request->getVar('country_code'),
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

    public function importRecipient()
    {
        $file = $this->request->getFile("file");
        $ext = $file->getExtension();
        if ($ext == "xls")
            $reader = new Xls();
        else
            $reader = new Xlsx();

        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $key => $value) {
            if ($key == 0) continue;
            if ($value[1] != "" && $value[2] != "" && $value[3] != "") {
                $this->recipientM->save([
                    'name' => $value[1],
                    'country_code' => (string) $value[2],
                    'number' => (string) $value[3],
                ]);
            }
        }
        return json_encode([
            'status' => true,
            'type' => 'success',
            'message' => "Successfully imported data",
        ]);
    }

    public function deleteRecipient($id)
    {
        if ($this->recipientM->delete($id)) {
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

    public function sendMessage()
    {
        $id = $this->request->getVar('id');
        $resipient = $this->recipientM->getData($id);
        $getMsg = $this->msgM->getDataActive()->message;
        $setName = str_replace("{{fullname}}", $resipient->name, $getMsg);
        $msg = $setName;
        // print_r(htmlspecialchars($getMsg));
        // die;
        $res = $this->sendNotif($resipient->country_code . $resipient->number, $msg);
        return $res;
    }
}
