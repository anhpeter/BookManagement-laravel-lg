<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Common\Helper\Message;
use App\Mail\OrderShipped;
use App\Models\Order as MainModel;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    function __construct()
    {
        parent::__construct('order', new MainModel());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setPageParams($request);
        $items = $this->mainModel->listAll($this->pageParams);
        $countFilters = $this->mainModel->countFilters($this->pageParams);
        return view(
            'pages/' . $this->controller . '/index',
            ['items' => $items, 'controller' => $this->controller, 'pageParams' => $this->pageParams, 'countFilters' => $countFilters]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Order();
        return view(
            'pages/' . $this->controller . '/form',
            array_merge(
                $this->getFormViewParams(),
                ['formType' => 'add', 'item' => $item]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->mainModel->find($id);
        return view('pages/' . $this->controller . '/show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->runValidate($request, $id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $item = $this->mainModel->find($id);
        $formItem = $this->getItemFromRequest($request);
        $affectedRows =  0;
        $message = null;
        if ($this->anyChange($item, $formItem)) {
            $status = $item['status'];
            $affectedRows = $item->update($formItem);
            if ($item->status != $status && $request->has('send-email')) {
                $this->sendMail($item);
                $message = sprintf(Message::$notificationMailSent, $this->controller . ' status changed');
            }
        }
        return $this->handleSaveResult($affectedRows, $message);
    }

    public function getItemFromRequest(Request $request)
    {
        $item = [
            'status' => $request->input('status'),
        ];
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->mainModel::find($id);
        $order->books()->detach();
        $order->delete();
        return redirect()->back()->with(['message' => Message::$deleted]);
    }

    // GET FORM VIEW PARAMS
    public function getFormViewParams()
    {
        return [
            'statusSelectData' => MyConfig::getSelectData('status', $this->controller),
        ];
    }

    // SET PAGE PARAMS
    protected function setPageParams(Request $request)
    {
        $this->pageParams = array_merge(
            $this->pageParams,
            [
                'sort' => [
                    'field' => trim($request->query('sort_field', 'created_at')),
                    'value' => trim($request->query('sort_value', 'desc')),
                ],
                'filters' => [
                    'status' => trim($request->query('status_filter', 'all')),
                    'shipping_method' => trim($request->query('shipping_method_filter', 'all')),
                    'payment_method' => trim($request->query('payment_method_filter', 'all')),
                ],
                'filterData' => [
                    'status' => MyConfig::getSelectData('status', $this->controller,),
                    'shipping_method' => MyConfig::getSelectData('shipping_method', $this->controller,),
                    'payment_method' => MyConfig::getSelectData('payment_method', $this->controller,),
                ],
                'search' => [
                    'field' => trim($request->query('search_field', 'all')),
                    'value' => trim($request->query('search_value', '')),
                ],
                'searchData' => MyConfig::getItemTemplateForController($this->controller, 'search'),
            ]
        );
    }
    public function runValidate(Request $request, $id = null)
    {

        $rules = [
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function sendMail($item)
    {
        $to_name = $item->user->profile->name;
        $to_email = $item->user->email;
        //$to_email = 'peteranh99@gmail.com';

        Mail::send('emails.order_status', ['order' => $item], function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject(MyConfig::getMailData()['name']);
            $message->from(MyConfig::getMailData()['username'], 'Order Status Notification');
        });
    }
}
