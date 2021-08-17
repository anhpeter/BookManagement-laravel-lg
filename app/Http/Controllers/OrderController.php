<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Common\Helper\Message;
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
        $item = $this->getItemFromRequest($request);
        $affected = $this->mainModel->where('id', $id)->update($item);
        $this->sendMail();
        return $this->handleSaveResult($affected);
    }

    public function getItemFromRequest(Request $request)
    {
        $item = [
            'status' => $request->input('status'),
            'shipping_method' => $request->input('shipping_method'),
            'payment_method' => $request->input('payment_method'),
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
        $this->pageParams = [
            'pagination' => [
                'itemsPerPage' => 5,
                'pageRange' => 3,
            ],
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
        ];
    }
    public function runValidate(Request $request, $id = null)
    {

        $rules = [
            'status' => 'required',
            'shipping_method' => 'required',
            'payment_method' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $field = 'status';
        $this->mainModel->updateFieldById($id, $field, $request->input('status'));
        return redirect()->back()->with(['message' => sprintf(Message::$fieldUpdated, ucfirst($field))]);
    }

    public function sendMail()
    {
        $to_name = 'Webfullstack';
        $to_email = 'webfullstack99@gmail.com';
        $data = array(
            'name' => 'Peter Anh',
            'body' => 'A test mail'
        );

        Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Laravel Test Mail');
            $message->from('peteranh99.test@gmail.com', 'Test Mail');
        });
    }
}
