<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitCheckout;
use App\Models\Category;
use App\Models\Brands;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth, View,DB;

class BaseController extends Controller
{


    /**
     * Ecommerce-CMS
     *
     * Copyright (C) 2014 - 2015  Tihomir Blazhev.
     *
     * LICENSE
     *
     * Ecommerce-cms is released with dual licensing, using the GPL v3 (license-gpl3.txt) and the MIT license (license-mit.txt).
     * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
     * Please see the corresponding license file for details of these licenses.
     * You are free to use, modify and distribute this software, but all copyright information must remain.
     *
     * @package     ecommerce-cms
     * @copyright   Copyright (c) 2014 through 2015, Tihomir Blazhev
     * @license     http://opensource.org/licenses/MIT  MIT License
     * @version     1.0.0
     * @author      Tihomir Blazhev <raylight75@gmail.com>
     */

    /**
     *
     * Base Class
     *
     * @package ecommerce-cms
     * @category Base Class
     * @author Tihomir Blazhev <raylight75@gmail.com>
     * @link https://raylight75@bitbucket.org/raylight75/ecommerce-cms.git
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $data = Product::prepareGlobalData();
        View::share($data);
    }

    /**
     * Show the home page to the user.
     *
     * @return Response
     */
    public function index()
    {
        $data['brands'] = Brands::all();
        $data['latest'] = Product::orderBy('product_id', 'desc')->take('6')->get();
        $data['products'] = Product::getProducts();
        return view('frontend.body', $data);
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }

    public function contacts()
    {
        return view('frontend.contacts');
    }

    /**
     * Pass data to checkout view
     * @return View
     */
    public function checkoutOne()
    {
        $countries = Country::all();
        $payments = Payment::all();
        $shippings = Shipping::all();
        return view('frontend.checkoutOne', compact('countries','payments','shippings'));
    }

    /**
     * Store checkout first step data to Session
     * @param Request $request
     * @return View
     */
    public function checkoutStore(SubmitCheckout $request)
    {
        $input = $request->all();
        $request->session()->put($input);
        return redirect('checkout/show');
    }

    public function checkoutTwo(Request $request)
    {
        $vat = Country::where('name',$request->session()->get('country'))->first();
        $data['vat'] = $vat->vat;
        $data['payments'] = Payment::findOrFail($request->session()->get('payment'));
        $data['shippings'] = Shipping::findOrFail($request->session()->get('delivery'));
        $data['customer'] = $request->session()->all();
        return view('frontend.checkoutTwo', $data);
    }

    /**
     * @param $slug
     * @param $parent
     * @return View
     */
    public function filter(Request $request,$slug, $parent)
    {
        $data = Product::prepareFilter($parent);
        $data['banner'] = Category::whereIn('cat_id',$request->input('categ'))->first();
        $data['properties'] = Product::getAll($parent);
        $data['products'] = Product::pagination($parent);
        if ($request->ajax()) {
            return response()->json(view('frontend.ajax-products', $data)->render());
        }else{
            return view('frontend.filter_view', $data);
        }

    }

    /**
     * @param $slug
     * @param $parent
     * @return View
     */
    public function product($slug, $id)
    {
        $data['latest'] = Product::orderBy('product_id', 'desc')->take('6')->get();
        $data['products'] = Product::getProducts();
        $data['item'] = Product::with('category', 'size', 'color')->findOrFail($id);
        return view('frontend.product_page', $data);
    }

    /**
     * @param $slug
     * @param $parent
     * @return View
     */
    public function frame($id)
    {
        $data['item'] = Product::with('category', 'size', 'color')->find($id);
        return view('frontend.frame', $data);
    }

    /**
     * @param $parent
     * @return \Illuminate\Http\JsonResponse|View
     */
    public function search(Request $request,$parent)
    {
        $search = $request->input('search');
        $data = Product::prepareFilter($parent);
        $data['banner'] = Category::where('cat_id',$request->input('categ'))->first();
        $data['properties'] = Product::getAll($parent);
        $data['products'] = Product::where('name', 'like', '%' . $search . '%')
            ->orderBy('name')
            ->paginate(6);
        if ($request->ajax()) {
            return response()->json(view('frontend.ajax-products', $data)->render());
        }else{
            return view('frontend.filter_view', $data);
        }
    }

    public function userLogin()
    {
        return view('frontend.login');
    }

    public function welcome()
    {
        //redirect trait AuthenticatesUsers getLogout()
        $user = Auth::user()->name;
        Session::flash('flash_message', 'You have been successfully Logged In!');
        return view('messages.welcome')->with('user',$user);
    }
}