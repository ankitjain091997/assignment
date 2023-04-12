<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // user or admin login
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|min:6'
        ]);

        $userData = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($userData)) {
            Session::put([
                'email' => $userData['email'],
                'password' => $userData['password']
            ]);
            request()->session();
            return redirect()->route('productList')->with('success', 'you are ' . Auth::user()->role);
        } else {
            request()->session()->flash('error', 'Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function productList()
    {
        // check if login is user or admin
        if (Auth::user()->role === 'user') {
            $products = Products::whereUserId(Auth::user()->id)->simplePaginate(5);
        } else {
            $products = Products::simplePaginate(5);
        }

        return view('index', compact('products', $products));
    }

    public function productCreate(Request $request)
    {
        return view('create');
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name'   => 'required|string',
            'price'  => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'Products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $input['user_id'] = Auth::user()->id;
        Products::create($input);

        return redirect()->route('productList')
            ->with('success', 'Product created successfully.');
    }

    public function productEdit($id)
    {
        $product = Products::findOrFail($id);

        return view('edit', compact('product', $product));
    }

    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string',
            'price'  => 'required|numeric',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Products::findOrFail($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'Products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $input['user_id'] = Auth::user()->id;
        $product->update($input);

        return redirect()->back()->with('success', 'Product successfully updated.');
    }

    public function productDelete($id)
    {
        $product = Products::findOrFail($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product successfully deleted.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
